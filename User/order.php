<?php include('header.php') ?>
<?php

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Include the database connection file
require_once 'connection.php';

$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM users WHERE user_id = ?";

$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    exit("User details not found.");
}

$stmt->close();

$sql = "SELECT pr.id, pr.shoe_id, s.name AS shoe_name, pr.name, pr.address, pr.phone, pr.status, pr.payimg FROM purchase_request pr
        JOIN shoes s ON pr.shoe_id = s.shoe_id
        WHERE pr.user_id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .user-details {
            margin-bottom: 20px;
        }
        .user-details p {
            margin: 5px 0;
        }
        .order-status {
            border-top: 2px solid #ccc;
            padding-top: 20px;
        }
        .order-status h2 {
            margin-bottom: 10px;
        }
        .order-status table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-status th,
        .order-status td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .order-status th {
            background-color: #f2f2f2;
        }
        .order-status tr:hover {
            background-color: #f9f9f9;
        }
        .cancel-button {
            background-color: #f44336;
            color: white;
            padding: 6px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .cancel-button:hover {
            background-color: #d32f2f;
        }
        .view-image-link {
            display: inline-block;
            padding: 6px 12px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .view-image-link:hover {
            background-color: #0056b3;
    </style>
</head>
<body>
    <div class="container">
        <h1>My Orders</h1>
        <div class="user-details">
            <h2>My Details</h2>
            <p><strong>Name:</strong> <?php echo $user['username']; ?></p>
            <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        </div>
        <div class="order-status">
            <h2>Order Status</h2>
            <?php if (empty($orders)) : ?>
                <p>No orders found.</p>
            <?php else : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Shoe Name</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Payment Proof</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order) : ?>
                            <tr id="order-row-<?php echo $order['id']; ?>">
                                <td><?php echo $order['id']; ?></td>
                                <td><?php echo $order['shoe_name']; ?></td>
                                <td><?php echo $order['name']; ?></td>
                                <td><?php echo $order['address']; ?></td>
                                <td><?php echo $order['phone']; ?></td>
                                <td><?php echo $order['status']; ?></td>
                                <td>
                                    <?php if (!empty($order['payimg'])) : ?>
                                        <a href="view_image.php?order_id=<?php echo $order['id']; ?>" target="_blank">View Image</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($order['status'] != 'Accepted') : ?>
                                        <button class="cancel-button" onclick="cancelOrder(<?php echo $order['id']; ?>)">Cancel</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
    <script>
        function cancelOrder(orderId) {
            var status = document.getElementById("order-row-" + orderId).getElementsByTagName("td")[5].innerText;
            if (status !== "Accepted" && confirm("Are you sure you want to cancel this order?")) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "cancel_order.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        if (xhr.responseText.trim() == "Order cancelled successfully.") {
                            var row = document.getElementById("order-row-" + orderId);
                            row.parentNode.removeChild(row);
                        } else {
                            alert("Error: " + xhr.responseText);
                        }
                    }
                };
                xhr.send("order_id=" + orderId);
            }
        }
    </script>
</body>
</html>
<?php include('footer.php')?>
