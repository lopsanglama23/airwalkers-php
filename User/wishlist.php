<?php include('header.php'); ?>
<?php

require_once 'connection.php';

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// Fetch wishlist items for the logged-in user
$sql = "SELECT w.id, s.name AS shoe_name, s.brand, s.price, s.image_col, s.status 
        FROM wishlist w
        JOIN shoes s ON w.shoe_id = s.shoe_id
        WHERE w.user_id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$wishlist_items = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Wishlist</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
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

        .wishlist-list table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .wishlist-list th, .wishlist-list td {
            padding: 12px 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .wishlist-list th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .wishlist-list tr:hover {
            background-color: #f9f9f9;
        }

        .wishlist-list img {
            max-width: 100px;
            height: auto;
            border-radius: 5px;
        }

        .wishlist-list td:last-child {
            text-align: center;
        }

        .remove-btn {
            background-color: #d9534f;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .remove-btn:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<p><b>Name:lopsang lama</b><br>
    <b>Roll no: 59
</p>
<body>
    <div class="container">
        <h1>Your Wishlist</h1>
        <div class="wishlist-list">
            <?php if (empty($wishlist_items)) : ?>
                <p>Your wishlist is empty.</p>
            <?php else : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($wishlist_items as $item) : ?>
                            <tr>
                                <td><img src="../shoeImage/<?php echo $item['image_col']; ?>" alt="<?php echo $item['shoe_name']; ?>"></td>
                                <td><?php echo $item['shoe_name']; ?></td>
                                <td><?php echo $item['brand']; ?></td>
                                <td>$<?php echo $item['price']; ?></td>
                                <td><?php echo ($item['status'] == 1 ? "Available" : "Out of Stock"); ?></td>
                                
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<?php include('footer.php'); ?>
