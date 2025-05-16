<?php
session_start();

// Check if the shoe ID is provided via POST
if(isset($_POST['shoe_id'])) {
    $shoe_id = $_POST['shoe_id'];
    
    // Check if the shoe exists in the cart
    if(isset($_SESSION['cart'][$shoe_id])) {
        // Remove the item from the cart
        unset($_SESSION['cart'][$shoe_id]);

        
            
            header("Location: mycart.php");
            exit();
        } else {
            
            echo "Error: Unable to remove item from cart.";
        }

    
}
 else {
    // If shoe ID is not provided via POST, display an error message
    echo "Error: Shoe ID not provided.";
}
?>

