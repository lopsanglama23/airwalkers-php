<?php

require_once 'connection.php';


if(isset($_POST['order_id'])) {
    
    $order_id = mysqli_real_escape_string($connection, $_POST['order_id']);

    // Prepare SQL statement to delete the order
    $sql = "DELETE FROM purchase_request WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $order_id);

    // Execute the statement
    if($stmt->execute()) {
        // Order successfully cancelled
        echo "Order cancelled successfully.";
    } else {
        // Error occurred while cancelling the order
        echo "Error cancelling order.";
    }

    // Close the statement
    $stmt->close();
} else {
    
    echo "Order ID not provided.";
}
?>
