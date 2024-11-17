<?php
session_start();
include '../db_connect.php';

// Set headers to return JSON response
header('Content-Type: application/json');

// Check if 'id' and 'type' are provided in the URL
if (!isset($_GET['id']) || !isset($_GET['type'])) {
    echo json_encode(["error" => "Movie ID or type not provided"]);
    exit;
}

// Get the movie ID and type (recommended or upcoming)
$id = intval($_GET['id']);
$type = $_GET['type'];

// Determine the table to query based on type
$table = ($type === 'recommended') ? 'movies' : 'upcoming_movies';

// Prepare and execute the SQL query
try {
    $stmt = $conn->prepare("SELECT * FROM $table WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the movie is found
    if ($result->num_rows > 0) {
        $movie = $result->fetch_assoc();
        echo json_encode($movie); // Return movie details as JSON
    } else {
        echo json_encode(["error" => "Movie not found"]);
    }

    $stmt->close();
} catch (Exception $e) {
    echo json_encode(["error" => "An error occurred while fetching the movie details"]);
}

$conn->close();
?>
