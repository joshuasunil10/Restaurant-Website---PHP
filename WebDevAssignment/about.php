<?php
session_start(); // Start the session

// Check if the user is logged in
$loggedIn = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/about.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <title>About Us</title>
</head>
<body>
    <header>
        <nav>
            <ul class="navbar-left">
                <li><a href="index.php"><img class="logo" src="images/favicon.png" alt=""></a></li>
            </ul>
            <ul class="navbar-center">
                <li><a href="about.php">ABOUT</a></li>
                <li><a href="menu.php">MENU</a></li>
                <li><a href="checkout.php">BASKET</a></li>
            </ul>
            <ul class="navbar-right">
            <?php
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                echo "<li><a href='logout.php'>Logout</a></li>";
                echo "<li><p>Welcome," . $_SESSION["username"] . "</p></li>";
            } else {
                echo "<li><a href='login.php'>LOGIN/REGISTER</a></li>";
            }
            ?>
            </ul>
        </nav>
    </header>
    
    <div class="about-section">
        <h1>About Us</h1>
        <p>At NotKFC, We strive to provide delicious meals and excellent service to all our customers. Our team is passionate about food and dedicated to creating a memorable dining experience for you.</p>
        <p>Our Prime Time Chicken is renowned worldwide (available only at select hours of the day), and leaves you craving for more!</p>
        <p>Join us for a culinary adventure like no other!</p>

        <center>

        <img src="images/image1.jpeg" alt="" style='scale:50px;'>
        <img src="images/building.jpeg" alt="" style='scale:50px;'>
        <img src="images/DeliveryTruck.jpeg" alt="" style='scale:50px;'>
        <img src="images/favicon.png" alt="" style='scale:50px;'>


        </center>
        
        
    </div>



    <div class="contact-section">
        <h1>Contact</h1>
        <p>We'd love to hear your feedback!</p>
        <p>Contact NotKFCSupport at:</p>
        <ul>
            <li>Phone: <span>+09187 6252334</span></li>
            <li>Email: <span>support@notkfc.com</span></li>
        </ul>
    </div>

    <footer>
    <div class="footer-content">
        <p>&copy; 2024 NotKFC. Site Designed by Joshua Sunil Mathew C22419706</p>
        <ul class="footer-nav">
            <li><a href="#about">About Us</a></li>
            <li><a href="#terms">Terms of Service</a></li>
            <li><a href="#privacy">Privacy Policy</a></li>
            <li><a href="#contact">Contact Us</a></li>
        </ul>
    </div>



</footer>
</body>
</html>



