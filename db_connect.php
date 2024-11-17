<?php
// Database credentials
$servername = "127.0.0.1";
$username = "root";
$password = ""; // Leave this empty if you haven’t set a MySQL password
$dbname = "ombs";
$port = 3307; // Since we changed MySQL to run on port 3307

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
