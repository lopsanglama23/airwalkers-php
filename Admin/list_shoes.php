<?php
session_start();
if(!isset($_SESSION['admin_id']))
{
    header('location:index.php?err=1');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Shoes</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Shoes styles */
        .shoes {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            grid-gap: 20px;
        }

        .shoe {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
            position: relative;
        }

        .shoe:hover {
            transform: translateY(-5px);
        }

        .shoe-details {
            padding: 20px;
        }

        .shoe-details p {
            margin: 0;
            margin-bottom: 10px;
            color: #666;
        }

        .shoe-image {
            width: 100%;
            display: block;
            border-top: 1px solid #eee;
            max-height: 300px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #f4f4f4;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        .button-container a {
            text-decoration: none;
            color: #333;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .button-container a:hover {
            background-color: #ccc;
        }
    </style>
</head>
<body>
    <?php require_once 'admin_menu.php' ?>
    <div class="container">
        <h2>Uploaded Shoes</h2>
        <div class="shoes">
            <?php
            // Database connection
            require_once 'connection.php';

            // Retrieve data from the database
            $sql = "SELECT * FROM shoes";
            $result = $connection->query($sql);

            // Check if there are any records
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<div class='shoe'>";
                    echo "<div class='shoe-details'>";
                    echo "<h2 class='name'>" . $row["name"] . "</h2>";
                    echo "<p class='brand'><strong>Brand:</strong> " . $row["brand"] . "</p>";
                    echo "<p class='price'><strong>Price:</strong> $" . $row["price"] . "</p>";
                    echo "<p class='desc'><strong>Description:</strong> " . $row["description"] . "</p>";
                    echo "<p class='status'><strong>Status:</strong> " . ($row["status"] == 1 ? "Active" : "Inactive") . "</p>";
                    echo "</div>";
                    echo "<img class='shoe-image' src='../shoeImage/" . $row["image_col"] . "' alt='Shoe Image'>";
                    echo "<div class='button-container'>";
                    echo "<a href='edit_shoe.php?shoe_id=" . $row['shoe_id'] . "'>Edit</a>";
                    echo "<a href='view_shoes.php?shoe_id=" . $row['shoe_id'] . "' target='_blank'>View</a>";
                    echo "<a href='delete_shoe.php?shoe_id=" . $row['shoe_id'] . "' class='delete' onclick=\"return confirm('Are you sure you want to delete this shoe?')\">Delete</a>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No shoes found.</p>";
            }

            // Close connection
            $connection->close();
            ?>
        </div>
    </div>
</body>
</html>
