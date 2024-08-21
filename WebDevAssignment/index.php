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
    <link rel="stylesheet" href="Styles/styles.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <title>NotKFC</title>
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

<section class="Intro-Section">
    <div class="text-withbuttons">
        <h1>IT'S <span>PRIME TIME</span> CHICKEN! @ NotKFC</h1>
        <h2>Get the NotChicken bucket for just <span>$13.99</span></h2>
        <h3>Order now at your nearest outlet!</h3>
        <?php
        // Check if the user is logged in
        if ($loggedIn) {
            // If logged in, link to menu.php
            echo '<a class="button" href="menu.php">Order Now!</a>';
        } else {
            // If not logged in, link to login.php
            echo '<a class="button" href="login.php">Login to Order</a>';
        }
        ?>
    </div>
    <div>
        <img class="sect1image" src="images/ChickenImage.png" alt="">
    </div>
</section>

<section id="deals" class="Deals-Section">
    <h2>Our Current Deals!</h2>
    <div class="deal">
        <div class="deal-info">
            <h3>Monday Madness</h3>
            <p>Enjoy 20% off on all NotKFC meals every Monday!</p>
            <img src="images/image4.png" alt="">
        </div>
        
    </div>
    
    <div class="deal">
        <div class="deal-info">
            <h3>NotFamily Feast</h3>
            <p>Get a family meal for 4 at just $29.99 on weekends!</p>
            <img src="images/image5.png" alt="">
        </div>
        
    </div>
    <div class="deal">
        <div class="deal-info">
            <h3>MidWeek Saver</h3>
            <p>Mid Week sale on every Wednesday for all NotKFC Meals</p>
            <img src="images/food5.png" alt="">
        </div>
        
    </div>
   
</section>

<section id="locations" class="Locations-Section">
    <h2>Our Locations</h2>
    <div class="location">
        <h3>NotKFC Grangegorman</h3>
        <p>123 Smithfield Way, Dublin</p>
    </div>
    <div class="location">
        <h3>NotKFC Cork Outlet</h3>
        <p>456 Elm Avenue, Flavortown, Co.Cork</p>
    </div>
</section>

<footer>
    <div class="footer-content">
        <p>&copy; 2024 NotKFC. Site Designed by Joshua Sunil Mathew C22419706</p>
        <ul class="footer-nav">
        </ul>
    </div>



</footer>
</body>
</html>
