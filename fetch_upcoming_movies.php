<?php
session_start();
include '../db_connect.php';

$query = "SELECT id, title, poster, genre, release_date FROM upcoming_movies";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$movies = [];
while ($row = $result->fetch_assoc()) {
    $movies[] = $row;
}

echo json_encode($movies);

$conn->close();
?>