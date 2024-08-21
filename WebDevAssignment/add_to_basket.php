<?php
session_start(); 


if(isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];
    
    // Check if the user is logged in
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        
        
       
        if(!isset($_SESSION['basket'])) {
            $_SESSION['basket'] = array(); 
        }
        $_SESSION['basket'][] = $item_id; 
        
       
        echo "Item added to basket successfully!";
        
        
        echo "<pre>";
        print_r($_SESSION['basket']);
        echo "</pre>";
    } else {
        
        header("Location: login.php");
        exit;
    }
} else {

    echo "Error: Item ID not received.";
}
?>
