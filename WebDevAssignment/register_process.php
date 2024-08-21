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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $full_name = $_POST['full_name'];
    $address = $_POST['address'];
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Check if username already exists
    $check_username = "SELECT * FROM userdata WHERE Username='$user'";
    $result = $conn->query($check_username);

    if ($result->num_rows > 0) {
        echo "Username already exists. Please choose a different username.";
    } else {
        // Insert new user into database
        $sql = "INSERT INTO userdata (Fullname, Address, Username, Password) VALUES ('$full_name', '$address', '$user', '$pass')";
        if ($conn->query($sql) === TRUE) {
            // Registration successful
            $_SESSION['username'] = $user; // Set session variable for logged-in user
            header("Location: menu.php"); // Redirect to menu.php
            exit();
        } else {
            // if Registration failed
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}


$conn->close();
?>
