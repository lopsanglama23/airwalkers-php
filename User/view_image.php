<?php
require_once 'connection.php';

if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);

    // Retrieve image data from the database
    $sql = "SELECT payimg FROM purchase_request WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $stmt->bind_result($payimg);
    $stmt->fetch();
    $stmt->close();

    // If image data exists, send it as the HTTP response
    if ($payimg) {
        // Set appropriate content type header
        header("Content-type: image/jpeg"); // Assuming the images are JPEG, adjust if necessary
        // Output the image data
        echo $payimg;
        exit;
    }
}

// If image data is not found or the order ID is invalid, send a 404 response
header("HTTP/1.0 404 Not Found");
?>
