<?php
session_start();
require_once 'connection.php';

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$shoe_id = $_GET['shoe_id'];

// Check if the shoe is already in the wishlist
$check_sql = "SELECT * FROM wishlist WHERE user_id = ? AND shoe_id = ?";
$check_stmt = $connection->prepare($check_sql);
$check_stmt->bind_param("ii", $user_id, $shoe_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows == 0) {
    // Insert the shoe into the wishlist
    $sql = "INSERT INTO wishlist (user_id, shoe_id) VALUES (?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ii", $user_id, $shoe_id);
    if ($stmt->execute()) {
        header("Location: wishlist.php?wishlist_added=true");
    } else {
        echo "Error adding to wishlist: " . $connection->error;
    }
    $stmt->close();
} else {
    header("Location: wishlist.php?wishlist_added=exists");
}

$connection->close();
?>
