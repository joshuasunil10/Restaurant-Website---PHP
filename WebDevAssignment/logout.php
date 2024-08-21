<?php

session_start();


$_SESSION = array();

// Destroy the session
session_destroy();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Clear the basket table
$sql = "DELETE FROM basket";
if ($conn->query($sql) === TRUE) {
    echo "Basket table cleared successfully";
} else {
    echo "Error clearing basket table: " . $conn->error;
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/logout.css"> <!-- Include your logout form styles here -->
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <title>Logout</title>
</head>
<body>
    <div class="logout-container">
        <h2>Logout Successful</h2>
        <p>You have been logged out.</p>
        <p>Returning to Homepage...</p>
    </div>

    <script>
        // Wait for 2 seconds before redirecting to index.php
        setTimeout(function() {
            window.location.href = 'index.php';
        }, 2000); // 2000 milliseconds = 2 seconds
        
    </script>
    
</body>
</html>
