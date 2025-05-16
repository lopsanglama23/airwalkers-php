
<?php include('header.php') ?>
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

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .container {
            max-width: 1200px; /* Increase the max-width to accommodate more shoes */
            margin: 20px auto;
            padding: 0 20px;
            overflow: hidden; /* Hide overflowing content */
        }

        .shoes {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .shoe {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
            position: relative;
            width: calc(25% - 20px); /* Set the width to 25% with margin */
            margin: 0 10px 20px; /* Add margin between shoes */
            vertical-align: top; /* Align shoes to the top */
        }

        .shoe:hover {
            transform: translateY(-5px);
        }

        .shoe-image {
    width: 100%;
    display: block;
    border-radius: 10px 10px 0 0;
    max-height: 350px; /* Increase the max-height of the image */
    object-fit: cover;
    transition: transform 0.3s ease; /* Add transition for smooth animation */
}

.shoe:hover .shoe-image {
    transform: scale(1.1); /* Increase the scale of the image on hover */
}


        .shoe-details {
            padding: 20px; /* Increase padding */
            text-align: center;
        }

        .shoe-details h2 {
            margin-bottom: 15px;
            font-size: 20px; /* Increase font size */
            color: #333;
        }

        .shoe-details h2 a {
            text-decoration: none;
            color: #333; /* Change text color */
        }

        .shoe-details h2 a:hover {
            color: #007bff; /* Change text color on hover */
        }

        .price {
            color: #007bff;
        }

        .status {
            font-weight: bold;
        }

        .status.available {
            color: green;
        }

        .status.not-available {
            color: red;
        }
    </style>
</head>
<body>
  
    <div class="container">
        <h2>puma</h2>
        <div class="shoes">
            <?php
            // Database connection
            require_once 'connection.php';

            // Brand to filter
            $brand_to_filter = "puma"; // Change this to the desired brand

            // Prepare and execute the query
            $stmt = $connection->prepare("SELECT * FROM shoes WHERE brand = ?");
            $stmt->bind_param("s", $brand_to_filter);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if there are any records
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<div class='shoe'>";
                    echo "<img class='shoe-image' src='../shoeImage/" . $row["image_col"] . "' alt='Shoe Image'>";
                    echo "<div class='shoe-details'>";
                    echo "<h2 class='name'><a href='shoe_details.php?shoe_id=" . $row['shoe_id'] . "'>" . $row["name"] . "</a></h2>";
                    echo "<p class='price'><strong>Price:</strong> $" . $row["price"] . "</p>";
                    echo "<p class='status " . ($row["status"] == 1 ? "available" : "not-available") . "'><strong>Status:</strong> " . ($row["status"] == 1 ? "Available" : "Not Available") . "</p>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<h2>No shoes found with the brand: $brand_to_filter</h2>";
            }

            // Close connection
            $stmt->close();
            $connection->close();
            ?>
        </div>
    </div>
</body>
</html>
<?php include('footer.php')?>

