<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION["admin_id"])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Include the database connection file
require_once 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve order ID and status from the form
    $order_id = $_POST["order_id"];
    $status = $_POST["status"];

    // Prepare and execute the SQL update statement
    $sql = "UPDATE purchase_request SET status = ? WHERE id = ?";
    $stmt = $connection->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("si", $status, $order_id);
        if ($stmt->execute()) {
            // Status updated successfully
            echo "<script>alert('Status updated successfully');</script>";
            echo "<script>window.location.href = 'orders.php';</script>";
            exit();
        } else {
            // Error updating status
            echo "<script>alert('Error updating status: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        // Handle query preparation error
        echo "<script>alert('Error preparing statement: " . $connection->error . "');</script>";
    }
} else {
    // Redirect to the orders page if the form is not submitted
    header("Location: orders.php");
    exit();
}
?>
