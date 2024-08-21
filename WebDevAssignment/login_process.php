<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$database = "restaurant";

$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input values from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to fetch user from database
    $sql = "SELECT * FROM userdata WHERE Username='$username' AND Password='$password'";
    $result = $conn->query($sql);

    // Check if user exists
    if ($result->num_rows == 1) {
        // User exists, set session variables
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username; 
        
        // Redirect to menu.php
        header("Location: menu.php");
        exit;
    } else {
        // User doesn't exist or credentials are incorrect
        echo "Invalid username or password";
        header("Location: login.php");
    }
}

// Close the database connection
$conn->close();
?>
