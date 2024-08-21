<?php
session_start(); // Start the session

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "restaurant";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle adding item to basket
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add_to_basket"])) {
        $menu_item_id = $_POST["menu_item_id"];
        
        // Check if the item is already in the basket
        $check_sql = "SELECT * FROM basket WHERE menu_item_id = $menu_item_id";
        $check_result = $conn->query($check_sql);
        if ($check_result->num_rows > 0) {
            // If the item is already in the basket, increase the quantity
            $update_sql = "UPDATE basket SET quantity = quantity + 1 WHERE menu_item_id = $menu_item_id";
            $conn->query($update_sql);
        } else {
            // If the item is not in the basket, insert it with quantity 1
            $insert_sql = "INSERT INTO basket (menu_item_id) VALUES ($menu_item_id)";
            $conn->query($insert_sql);
        }
    }
    
    if (isset($_POST["clear_basket"])) {
        // SQL to delete all items from the basket
        $clear_sql = "DELETE FROM basket";
        $conn->query($clear_sql);

        // Reload the page or redirect the user to the same page
        header("Location: menu.php ");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/checkout.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <title>Menu - NotKFC</title>
    <link rel="stylesheet" href="Styles/checkout.css">
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

<div class="container">
    <!-- Basket Section -->
    <section id="basket">
        <div class="basket-container">
            <h2>Order Summary</h2>
            <div class="basket-items">
                <?php
                // Initialize total price variable
                $total_price = 0;

                // Fetch basket items from the database
                $basket_sql = "SELECT menu.name, menu.price, basket.quantity FROM basket INNER JOIN menu ON basket.menu_item_id = menu.id";
                $basket_result = $conn->query($basket_sql);
                if ($basket_result->num_rows > 0) {
                    while ($basket_row = $basket_result->fetch_assoc()) {
                        // Calculate subtotal for each item
                        $subtotal = $basket_row["price"] * $basket_row["quantity"];
                        // Add subtotal to total price
                        $total_price += $subtotal;

                        echo "<div class='basket-item'>";
                        echo "<h3>" . $basket_row["name"] . "</h3>";
                        echo "<p class='price'>$" . $basket_row["price"] . " x " . $basket_row["quantity"] . "</p>";
                        echo "</div>";
                    }
                    // Display total price
                    echo "<div class='total'><strong>Total:</strong> $" . number_format($total_price, 2) . "</div>";
                    echo "<form method='post' action='checkout.php'>";
                    
                    echo "</form>";
                } else {
                    echo "Your Basket is empty.";
                }
                ?>
                <a href="menu.php" class="return-to-menu">Return to Menu</a>
            </div>
        </div>
    </section>

    <!-- Payment Section -->
    <?php
// Check if basket is not empty before displaying payment section
if ($basket_result->num_rows > 0) {
    
    echo "<section id='payment' style='background-color: #fff; color: #fff; padding: 0px; border-radius: 10px; box-shadow: 1 4px 8px rgba(0, 0, 0, 0.1);'>";
    echo "<div class='payment-container'style='box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding:20px;'>";
    echo "<h2 style='font-size: 30px; color:black; font-weight: bold; margin-bottom: 20px;'>Enter your Payment Information.</h2>";
    echo "<form method='post' action='process_payment.php'>";
    echo "<div style='margin-bottom: 30px;'>";
    echo "<label for='card_name' style='color: black; margin-right: 10px;'>Cardholder Name: </label>";
    echo "<input type='text' id='card_name' name='card_name' required placeholder='Your Name' style='padding: 5px; border-radius: 5px; border: 1px solid #c43030;'>";
    echo "</div>";
    echo "<div style='margin-bottom: 30px;'>";
    echo "<label for='card_number' style='color: black; margin-right: 10px;'>Card Number:</label>";
    echo "<input type='text' id='card_number' name='card_number' placeholder='0000 0000 0000 0000' required style='padding: 5px; border-radius: 5px; border: 1px solid #c43030;'>";
    echo "</div>";
    echo "<div style='margin-bottom: 30px;'>";
    echo "<label for='expiry_date' style='color: black; margin-right: 10px;'>Expiry Date:</label>";
    echo "<input type='text' id='expiry_date' name='expiry_date' placeholder='MM/YY' required style='padding: 5px; border-radius: 5px; border: 1px solid #c43030;'>";
    echo "</div>";
    echo "<div style='margin-bottom: 15px;'>";
    echo "<label for='cvv' style='color: black; margin-right: 10px;'>CVV:</label>";
    echo "<input type='text' id='cvv' name='cvv' required placeholder='123' style='padding: 5px; border-radius: 5px; border: 1px solid #c43030;'>";
    echo "</div>";
    echo "<div>";
    echo "<input type='submit' name='submit_payment' value='Submit Payment' style='background-color: green; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s, color 0.3s;'>";
    echo "</div>";
    echo "</form>";
    echo "</div>";
    echo "</section>";
}
?>




</div>


</body>
</html>

<?php
// Close database connection
$conn->close();
?>
