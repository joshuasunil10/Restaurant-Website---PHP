<?php
session_start(); 


if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}


$host = "localhost";
$username = "root";
$password = "";
$database = "restaurant";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $payment_info = array(
        'card_number' => $_POST['card_number'],
        'expiry_date' => $_POST['expiry_date'],
        'cvv' => $_POST['cvv']
    );


    $stmt = $conn->prepare("INSERT INTO payment_info (card_number, expiry_date, cvv) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $payment_info['card_number'], $payment_info['expiry_date'], $payment_info['cvv']);


    if ($stmt->execute()) {
        
        $clear_sql = "DELETE FROM basket";
        if ($conn->query($clear_sql)) {
            
            header("Location: payment_success.php");
            exit;
        } else {
            
            echo "Error clearing basket: " . $conn->error;
        }
    } else {
        
        echo "Error inserting payment information: " . $conn->error;
    }

 
    $stmt->close();
}


$conn->close();
?>
