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
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/menu.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <title>Menu - NotKFC</title>
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

<section id="menu">
    
    <div class="menu-container">
        <h2>Menu</h2>
        <div class="menu-items">
            <?php
            // Fetch menu items from the database
            $menu_sql = "SELECT * FROM menu";
            $menu_result = $conn->query($menu_sql);
            if ($menu_result->num_rows > 0) {
                while ($menu_row = $menu_result->fetch_assoc()) {
                    echo "<div class='menu-item'>";
                    echo "<h3>" . $menu_row["name"] . "</h3>";
                    echo "<p class='description'>" . $menu_row["description"] . "</p>";
                    echo "<p class='price'>$" . $menu_row["price"] . "</p>";
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='menu_item_id' value='" . $menu_row["id"] . "'>";
                    echo "<input type='submit' name='add_to_basket' value='Add to Basket'>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "No items in the menu.";
            }
            ?>
        </div>
    </div>
</section>

<section id="basket">
    <div class="basket-container">
        <h2>Basket</h2>
        <div class="basket-items">
            <?php
  
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
                // Display 
                echo "<div class='total'><strong>Total:</strong> $" . number_format($total_price, 2) . "</div>";
                echo "<form method='post' action='checkout.php'>";
                echo "<input type='submit' name='clear_basket' value='Clear Basket'>";
                echo "<input type='submit' name='checkout.php' value='Proceed to Checkout'>";
                echo "</form>";
            } else {
                echo "Basket is empty.";
            }
            ?>
        </div>
    </div>
</section>


</body>
</html>

<?php
// Close database connection
$conn->close();
?>
