<?php
session_start();

// Checking if the user is logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Checking if shoe ID is provided via GET
if (isset($_GET["shoe_id"])) {
    // Get the shoe ID from the URL
    $shoe_id = $_GET["shoe_id"];

    // Add the shoe to the cart
    addToCart($shoe_id);

    // Redirect back to the shoe details page with success message
    header("Location: shoe_details.php?shoe_id=$shoe_id&added=true");
    exit();
} else {
    // Shoe ID not provided via GET
    echo "Shoe ID not provided.";
    exit();
}

// Function to add an item to the cart
function addToCart($shoe_id) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    // If the shoe already exists in the cart, increment the quantity
    if (isset($_SESSION['cart'][$shoe_id])) {
        $_SESSION['cart'][$shoe_id]++;
    } else {
        $_SESSION['cart'][$shoe_id] = 1;
    }
}
?>
