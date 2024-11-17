<?php
include '../db_connect.php';
session_start();

$name = $_POST['name'];
$dob = $_POST['dob'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$checkEmailQuery = "SELECT * FROM users WHERE email = ?";
$checkStmt = $conn->prepare($checkEmailQuery);
$checkStmt->bind_param("s", $email);
$checkStmt->execute();
$result = $checkStmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['message'] = "This email is already registered. Please try logging in.";
    header("Location: ../index.php?error=signup");
    exit();
} else {
    // Proceed to insert if the email doesn't already exist
    $query = "INSERT INTO users (name, dob, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $name, $dob, $email, $password);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Successfully signed in!";
        $_SESSION['user_name'] = $name;
        header("Location: ../index.php?signup=success");
        exit();
    } else {
        $_SESSION['message'] = "Error: Could not sign up.";
        header("Location: ../index.php?error=signup");
        exit();
    }
}

$checkStmt->close();
$stmt->close();
$conn->close();
?>
