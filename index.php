<?php
session_start();

// Database connection
include 'db_connect.php';

$login_error = "";
$sign_in_success = "";

// Check if user is logged in
$is_logged_in = isset($_SESSION['user_name']);
$user_name = $is_logged_in ? $_SESSION['user_name'] : "";

// Handle success and error messages
if (isset($_GET['signup']) && $_GET['signup'] === "success") {
    $sign_in_success = "Successfully signed in!";
} elseif (isset($_GET['error']) && $_GET['error'] === "login") {
    $login_error = "Incorrect username or password.";
}

// Handle logout
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OMBS - Online Movie Booking System</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/login.js" defer></script>
    <script src="js/movie-list.js" defer></script>
    <script src="js/movie-list-upcoming.js" defer></script>
</head>
<body>

    <!-- Display success or error messages -->
    <?php if ($sign_in_success): ?>
        <p class="success-message"><?php echo $sign_in_success; ?></p>
    <?php elseif ($login_error): ?>
        <p class="error-message"><?php echo $login_error; ?></p>
    <?php endif; ?>

    <header>
        <h1>OMBS</h1>
        <div class="top-right">
            <?php if ($is_logged_in): ?>
                <span class="welcome-message">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                <form action="auth/logout.php" method="post" style="display: inline;">
                    <button type="submit" name="logout" id="logout-btn">Logout</button>
                </form>
            <?php else: ?>
                <button id="sign-in-btn">Sign In</button>
                <button id="login-btn">Login</button>
            <?php endif; ?>
        </div>
    </header>

    <main>
        <section id="movie-list">

            <div class="search-container">
                <input type="text" id="search-bar" placeholder="Search movies...">
            </div>

            <h2 id="recommended-header">Recommended Movies</h2>
            <div id="movies-container">
                <!-- Movie items will be displayed here -->
            </div>

            <h2 id="upcoming-header">Upcoming Movies</h2>
            <div id="upcoming-movies-container">
                <!-- Upcoming movies will be displayed here -->
            </div>
        </section>
    </main>

    <!-- Sign-In Form Popup -->
    <div id="signInForm" class="popup">
        <form id="signInPopupForm" method="post" action="auth/sign_in.php">
            <h3>Sign In</h3>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="sign-in-password" name="password" minlength="6" required>
            <small>Password must be at least 6 characters long.</small>

            <button type="submit">Sign In</button>
            <button type="button" onclick="closePopup('signInForm')">Cancel</button>
        </form>
    </div>

    <!-- Login Form Popup -->
    <div id="loginForm" class="popup">
        <form id="loginPopupForm" method="post" action="auth/log_in.php">
            <h3>Login</h3>
            <label for="login-name">Name:</label>
            <input type="text" id="login-name" name="name" required>

            <label for="login-password">Password:</label>
            <input type="password" id="login-password" name="password" required>

            <button type="submit">Login</button>
            <button type="button" onclick="closePopup('loginForm')">Cancel</button>
        </form>
        <?php if (isset($_GET['error'])): ?>
            <div id="login-error" style="color: red; margin-top: 10px;">Incorrect credentials</div>
        <?php endif; ?>
    </div>
    <script>
    document.getElementById("search-bar").addEventListener("input", function() {
        const query = this.value;
        document.getElementById("recommended-header").style.display = query ? "none" : "block";
        document.getElementById("upcoming-header").style.display = query ? "none" : "block";
    });
    </script>

<script src="js/movie-list.js"></script>
<script src="js/login.js"></script>
<script src="js/movie-list-upcoming.js"></script>
</body>
</html>


