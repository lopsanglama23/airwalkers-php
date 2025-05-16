<?php include('header.php')?>
<?php

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Checking if cart data is available in session
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    // Redirect or display a message if cart is empty
    $cart_empty = true;
} else {
    // Include the database connection file if needed
    require_once 'connection.php';
    $cart_empty = false;
}
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <style>
       
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px00px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .cart-items {
            margin-top: 20px;
        }

        .cart-item {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .shoe-name {
            display: flex;
            align-items: center;
        }

        .shoe-image {
            max-width: 50px;
            max-height: 50px;
            border-radius: 5px;
            margin-right: 10px;
        }

        .shoe-name p {
            margin: 0;
            font-weight: bold;
            color: #333;
        }

        .shoe-price {
            color: #888;
            margin-right: 20px;
        }

        .remove-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .remove-btn:hover {
            background-color: #c82333;
        }

        .checkout-btn {
            display: block;
            background-color: <?php echo $cart_empty ? '#ccc' : '#007bff'; ?>;
            color: #fff;
            text-align: center;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            margin-top: 20px;
            text-decoration: none;
            cursor: <?php echo $cart_empty ? 'not-allowed' : 'pointer'; ?>;
            pointer-events: <?php echo $cart_empty ? 'none' : 'auto'; ?>;
            transition: background-color 0.3s;
        }

        .checkout-btn:hover {
            background-color: <?php echo $cart_empty ? '#ccc' : '#0056b3'; ?>;
        }

        .empty-cart-msg {
            text-align: center;
            font-size: 18px;
            color: #888;
        }
        .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 60px;
        padding: 20px;
        background: #fff;
    }
    
    .logo a {
        color: #000;
        font-size: 18px;
        font-weight: 600;
        text-decoration: none;
    }
      
    </style>
</head>
<body>
<header class="header">
    <div class="logo">
      <a href="dashboard.php">Name: Lopsang Lama</a><br>
      <a href="">Roll.no: 59</a>
    </div>
    <div class="header-icons">
      <div class="account">
      </div>
    </div>
</header>
    <div class="container">
        <h1>My Cart</h1>
        <?php if ($cart_empty) : ?>
            <p class="empty-cart-msg">No items found in your cart.</p>
        <?php else : ?>
            <div class="cart-items">
                <?php 
                foreach ($_SESSION['cart'] as $shoe_id => $quantity) {
                    // Fetch shoe details from the database
                    $sql = "SELECT name, price, image_col FROM shoes WHERE shoe_id = ?";
                    $stmt = $connection->prepare($sql);
                    $stmt->bind_param("i", $shoe_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows == 1) {
                        $row = $result->fetch_assoc();
                        $shoe_name = $row['name'];
                        $shoe_price = $row['price'];
                        $image_url =  "../shoeImage/" . $row["image_col"];
                        // Display shoe details
                        ?>
                        <div class="cart-item">
                            <div class="shoe-name">
                                <img class="shoe-image" src="<?php echo $image_url; ?>" alt="<?php echo $shoe_name; ?> Image">
                                <p><?php echo $shoe_name; ?></p>
                            </div>
                            <p class="shoe-price">$<?php echo $shoe_price; ?></p>
                            <form action="remove_from_cart.php" method="post">
                                <input type="hidden" name="shoe_id" value="<?php echo $shoe_id; ?>">
                                <button type="submit" class="remove-btn">Remove</button>
                            </form>
                        </div>
                        <?php
                    } else {
                        echo "No items were selected.";
                    }
                }
                ?>
            </div>
            <a href="place_order.php" class="checkout-btn">Checkout</a>
        <?php endif; ?>
    </div>
</body>
</html>
<?php include('footer.php') ?>
