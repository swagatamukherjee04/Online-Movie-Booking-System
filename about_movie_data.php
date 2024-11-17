<?php
session_start();
include 'db_connect.php';

header("Content-Type: application/json"); // Ensure JSON output only

// Check if the movie ID and type are provided
if (isset($_GET['id']) && isset($_GET['type'])) {
    $movieId = intval($_GET['id']);
    $movieType = $_GET['type']; // This will be either "recommended" or "upcoming"

    $response = array();

    // Query based on movie type
    if ($movieType === "recommended") {
        $movieQuery = "SELECT id, title, description, poster, release_date, genre, rating, duration, certification, cast, crew, language, specification, trailer_link FROM movies WHERE id = ?";
    } elseif ($movieType === "upcoming") {
        $movieQuery = "SELECT id, title, description, poster, release_date, genre, certification, cast, crew, language, specification, trailer_link FROM upcoming_movies WHERE id = ?";
    } else {
        echo json_encode(array("error" => "Invalid movie type"));
        exit;
    }

    $stmt = $conn->prepare($movieQuery);
    $stmt->bind_param("i", $movieId);
    $stmt->execute();
    $movieResult = $stmt->get_result();

    if ($movieResult->num_rows > 0) {
        $movie = $movieResult->fetch_assoc();

        $response = array(
            'id' => $movie['id'],
            'title' => $movie['title'],
            'description' => $movie['description'],
            'poster' => $movie['poster'],
            'release_date' => $movie['release_date'],
            'genre' => $movie['genre'],
            'certification' => $movie['certification'],
            'cast' => explode(",", $movie['cast']),
            'crew' => explode(",", $movie['crew']),
            'language' => $movie['language'],
            'specification' => $movie['specification'],
            'trailer_link' => $movie['trailer_link']
        );

        if ($movieType === "recommended") {
            $response['rating'] = $movie['rating'];
            $response['duration'] = $movie['duration'];
        }

        echo json_encode($response);
    } else {
        echo json_encode(array("error" => "Movie not found"));
    }
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(array("error" => "Movie ID or type not provided"));
}
?>
