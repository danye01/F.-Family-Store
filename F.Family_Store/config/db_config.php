<?php
// Database connection
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = "";     // Default password for XAMPP (empty)
$dbname = "pos_system_php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>