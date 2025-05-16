<?php include('header.php') ?>
<?php

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Check if shoe ID is provided in the URL
if (isset($_GET["shoe_id"])) {
    // Retrieve shoe details from the database based on the provided ID
    $shoe_id = $_GET["shoe_id"];
    require_once 'connection.php';

    $sql = "SELECT * FROM shoes WHERE shoe_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $shoe_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if shoe details are found
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Fetch shoe details
        $shoe_name = $row["name"];
        $brand = $row["brand"];
        $price = $row["price"];
        $description = $row["description"];
        $status = ($row["status"] == 1 ? "Available" : "Out of Stock");
        $image_path = "../shoeImage/" . $row["image_col"];
    } else {
        // If shoe details are not found, redirect to an error page or show an error message
        echo "Shoe details not found.";
        exit();
    }
} else {
    // If shoe ID is not provided, redirect to an error page or show an error message
    echo "Shoe ID not provided.";
    exit();
}

// Check if the "added" parameter is present in the URL
if (isset($_GET['added']) && $_GET['added'] == 'true') {
    // Display the "Item added successfully" message
    echo '<div style="background-color: #28a745; color: #fff; padding: 10px;">Item added successfully.</div>';
}
// Check if the "wishlist_added" parameter is present in the URL
if (isset($_GET['wishlist_added']) && $_GET['wishlist_added'] == 'true') {
    // Display the "Item added to wishlist successfully" message
    echo '<div style="background-color: #ffc107; color: #fff; padding: 10px;">Item added to wishlist successfully.</div>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $shoe_name; ?> Details</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
        }

        .shoe-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .shoe-details h2 {
            color: #333;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .shoe-image {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .shoe-details p {
            color: #666;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .add-to-cart-btn {
            display: inline-block;
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .add-to-cart-btn:hover {
            background-color: #218838;
        }

        .out-of-stock {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <p><b>Name:lopsang lama</b><br>
    <b>Roll no: 59
</p>
    <div class="container">
        <div class="shoe-details">
            <h2><?php echo $shoe_name; ?></h2>
            <img class="shoe-image" src="<?php echo $image_path; ?>" alt="<?php echo $shoe_name; ?> Image">
            <p><strong>Brand:</strong> <?php echo $brand; ?></p>
            <p><strong>Price:</strong> $<?php echo $price; ?></p>
            <p><strong>Description:</strong> <?php echo $description; ?></p>
            <p><strong>Status:</strong> <?php echo $status; ?></p>
            <?php if ($status == "Available") : ?>
            <!-- "Add to Cart" button linking to addtocart.php -->
            <a href="addtocart.php?shoe_id=<?php echo $shoe_id; ?>" class="add-to-cart-btn">Add to Cart</a>
            <a href="add_to_wishlist.php?shoe_id=<?php echo $shoe_id; ?>" class="add-to-cart-btn">Wishlist</a>
            <!-- Display out of stock message -->
            <p class="out-of-stock">Out of Stock</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<?php include('footer.php'); ?>
