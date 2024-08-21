<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = " ";
$database = "restaurant";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username and password from form
$username = $_POST['username'];
$password = $_POST['password'];

// Query to check if the username and password exist in the database


$conn->close();
?>
