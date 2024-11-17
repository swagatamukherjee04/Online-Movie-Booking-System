<?php
include '../db_connect.php';
session_start();

$name = $_POST['name'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE name = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_name'] = $user['name'];
        header("Location: ../index.php");
        exit();
    } else {
        $_SESSION['message'] = "Incorrect password.";
        header("Location: ../index.php?error=login");
        exit();
    }
} else {
    $_SESSION['message'] = "No user found with that name.";
    header("Location: ../index.php?error=login");
    exit();
}

$stmt->close();
$conn->close();
?>

