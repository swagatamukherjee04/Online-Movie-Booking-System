<?php
session_start();
require_once '../db_connect.php';  // Connect to the database

if (!isset($_GET['movie_id'])) {
    echo json_encode(['error' => 'Movie ID is not provided']);
    exit();
}

$movie_id = $_GET['movie_id'];  // Get movie ID from URL parameter

// Fetch cinema halls and their showtimes for the specified movie
$query = "
    SELECT ch.name AS cinema_name, s.show_time, s.show_date
    FROM showtimes s
    JOIN cinema_halls ch ON s.cinema_hall_id = ch.id
    WHERE s.movie_id = ? AND s.show_date >= CURDATE()
    ORDER BY s.show_date, s.show_time
";

$stmt = $conn->prepare($query); // Use $conn from db_connect.php
$stmt->bind_param("i", $movie_id); // Bind the movie_id parameter
$stmt->execute();
$results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$cinemas = [];

// Organize data by cinema hall
foreach ($results as $row) {
    $cinemaName = $row['cinema_name'];
    
    if (!isset($cinemas[$cinemaName])) {
        $cinemas[$cinemaName] = [
            'name' => $cinemaName,
            'showtimes' => []
        ];
    }
    $cinemas[$cinemaName]['showtimes'][] = $row['show_time'];
}

// Send JSON response
echo json_encode(array_values($cinemas));
?>
