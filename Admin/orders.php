<?php include('admin_menu.php')?>
<?php
session_start();
// Check if the admin is logged in
if (!isset($_SESSION["admin_id"])) {
    header('location:index.php?err=1');
    exit(); // Add exit to prevent further execution
}

// Include the database connection file
require_once 'connection.php';

$sql = "SELECT pr.id, pr.shoe_id, shoes.name AS shoe_name, pr.name, pr.address, pr.phone, pr.status, users.username AS customer_name, users.email AS customer_email
        FROM purchase_request pr
        JOIN users ON pr.user_id = users.user_id
        JOIN shoes ON pr.shoe_id = shoes.shoe_id";

$stmt = $connection->prepare($sql);

if ($stmt) {
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $orders = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $orders = [];
    }

    $stmt->close();
} else {
    // Handle query preparation error
    echo "Error preparing order: " . $connection->error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    
    <style>
       body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 900px;
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

.order-list {
    border-top: 2px solid #ccc;
    padding-top: 20px;
}

.order-list h2 {
    margin-bottom: 10px;
    text-align: center;
}

.order-list table {
    width: 100%;
    border-collapse: collapse;
}

.order-list th,
.order-list td {
    padding: 12px 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.order-list th {
    background-color: #f2f2f2;
    font-weight: bold;
}

.order-list tr:hover {
    background-color: #f9f9f9;
}

.order-list td {
    font-size: 14px;
}

.order-list tr:nth-child(even) {
    background-color: #f2f2f2;
}

.order-list td:last-child {
    text-align: center;
}

.order-list td:last-child form {
    display: flex;
    align-items: center;
    justify-content: center;
}

.order-list td:last-child form select {
    margin-right: 10px;
    padding: 8px 10px;
}

.order-list td:last-child form button {
    padding: 8px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.order-list td:last-child form button:hover {
    background-color: #45a049;
}

.order-list td:last-child form select,
.order-list td:last-child form button {
    transition: background-color 0.3s ease;
}

.order-list td:last-child a {
    display: inline-block;
    padding: 8px 20px;
    background-color: #337ab7;
    color: white;
    text-decoration: none;
    border-radius: 4px;
}

.order-list td:last-child a:hover {
    background-color: #286090;
}


    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Orders</h1>
        <div class="order-list">
            <h2>Orders</h2>
            <?php if (empty($orders)) : ?>
                <p>No orders found.</p>
            <?php else : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Phone</th>
                            <th>Shoe Name</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Payment Proof</th> <!-- Added column for payment proof -->
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order) : ?>
                            <tr>
                                <td><?php echo $order['id']; ?></td>
                                <td><?php echo $order['customer_name']; ?></td>
                                <td><?php echo $order['customer_email']; ?></td>
                                <td><?php echo $order['phone']; ?></td>
                                <td><?php echo $order['shoe_name']; ?></td>
                                <td><?php echo $order['name']; ?></td>
                                <td><?php echo $order['address']; ?></td>
                                <td>
                                    <?php if (!empty($order['payimg'])) : ?>
                                        <a href="view_payment.php?order_id=<?php echo $order['id']; ?>" target="_blank">View payment</a>
                                    <?php endif; ?>
                                </td>

                                <td><?php echo $order['status']; ?></td>
                                <td>
                                    <form action="update_status.php" method="post">
                                        <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                        <select name="status">
                                            <option value="Pending" <?php echo $order['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                            <option value="Accepted" <?php echo $order['status'] == 'Accepted' ? 'selected' : ''; ?>>Accepted</option>
                                            <option value="Rejected" <?php echo $order['status'] == 'Rejected' ? 'selected' : ''; ?>>Rejected</option>
                                        </select>
                                        <button type="submit">Update</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
