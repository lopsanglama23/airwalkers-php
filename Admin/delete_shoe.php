<?php
// Start session to access session variables
session_start();

// Check if the shoe ID is provided and it's a valid number
if(isset($_GET['shoe_id']) && is_numeric($_GET['shoe_id'])) {
    // Include database connection
    require_once 'connection.php';

    // Get the shoe ID from the URL
    $shoe_id = $_GET['shoe_id'];

    // Prepare SQL statement to delete the shoe
    $sql = "DELETE FROM shoes WHERE shoe_id = $shoe_id";

    // Execute the delete query
    if ($connection->query($sql) === TRUE) {
        // Redirect to the shoe listing page with success message
        header('Location: list_shoes.php?msg=deleted');
        exit();
    } else {
        // Redirect to the shoe listing page with error message
        header('Location: list_shoes.php?msg=error');
        exit();
    }

    // Close connection
    $connection->close();
} else {
    // Redirect to the shoe listing page if no ID is provided
    header('Location: list_shoes.php');
    exit();
}
?>
