<?php include('header.php') ?>
<br/>
<br/>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Shoes</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
            
        }
        .headers {
            background-size: cover;
            background-repeat: no-repeat;
            width: 90%;
            height: 1000px; /* Adjust the height as needed */
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-shadow: 1px 1px 2px black;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .container {
            max-width: 1000px; /* Increase the max-width to accommodate more shoes */
            margin: 20px auto;
            padding: 0 20px;
            overflow: hidden; /* Hide overflowing content */
        }


        .shoe {
            display: inline-block;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
            position: relative;
            width: calc(20% - 20px); /* Set the width to 20% with margin */
            margin: 0 10px; /* Add margin between shoes */
            padding: 10 0px;
            vertical-align: top; /* Align shoes to the top */
        }

        .shoe:hover {
            transform: translateY(-5px);
        }

        .shoe-image {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
            max-height: 150px; /* Limit the height of the image */
        }

        .shoe-details {
            padding: 10px; /* Reduce padding */
        }

        .shoe-details p {
            margin: 0;
            margin-bottom: 5px; /* Reduce margin */
            color: #666;
            font-size: 12px; /* Reduce font size */
        }

        .shoe-details h2 {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .new-arrivals {
            margin-top: 40px; 
        }
        
        .best-seller {
            margin-top: 40px; 
        }


    </style>
</head>
<body>
    <section>
    
          <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airwalker Footwear Store</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section>
        <!-- carousel -->
        <div class="carousel">
            <!-- list item -->
            <div class="list">
                <div class="item active">
                    <img src="images/img1.jpg" alt="Shoes 1">
                    <div class="content">
                        <div class="author">WELCOME</div>
                        <div class="title">TO AIRALKER</div>
                        <div class="topic">FOOTWEAR STORE</div>
                        <div class="des">
                            Welcome to Airwalker Footwear, your one-stop destination for a wide variety of high-quality shoes at the best prices. We offer an extensive collection of footwear to suit every style and need. Whether you're looking for casual wear, formal shoes,
                            athletic sneakers, or something in between, Airwalker Footwear has got you covered.
                        </div>
                        <div class="buttons">
                            <button class="see-more">SEE MORE</button>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="images/shoes.jpg" alt="Shoes 2">
                    <div class="content">
                        <div class="author">WELOME TO</div>
                        <div class="title">AIRWALKER</div>
                        <div class="topic">FOOTWARE STORE</div>
                        <div class="des">
                            Welcome to Airwalker Footwear, your one-stop destination for a wide variety of high-quality shoes at the best prices. We offer an extensive collection of footwear to suit every style and need. Whether you're looking for casual wear, formal shoes,
                            athletic sneakers, or something in between, Airwalker Footwear has got you covered.
                        </div>
                        <div class="buttons">
                            <button class="see-more">SEE MORE</button>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="images/img3.jpg" alt="Shoes 3">
                    <div class="content">
                        <div class="author">WELCOME </div>
                        <div class="title">TO AIRWALKER</div>
                        <div class="topic">FOOTWARE STORE</div>
                        <div class="des">
                            Welcome to Airwalker Footwear, your one-stop destination for a wide variety of high-quality shoes at the best prices. We offer an extensive collection of footwear to suit every style and need. Whether you're looking for casual wear, formal shoes,
                            athletic sneakers, or something in between, Airwalker Footwear has got you covered.
                        </div>
                        <br/>
                        <div class="buttons">
                            <button class="see-more">SEE MORE</button>  
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="images/hero.jpg" alt="Shoes 4">
                    <div class="content">
                        <div class="author">WELCOME</div>
                        <div class="title">TO FOOTWEAR STORE</div>
                        <div class="topic">AIRWALKER</div>
                        <div class="des">
                            Welcome to Airwalker Footwear, your one-stop destination for a wide variety of high-quality shoes at the best prices. We offer an extensive collection of footwear to suit every style and need. Whether you're looking for casual wear, formal shoes,
                            athletic sneakers, or something in between, Airwalker Footwear has got you covered.
                        </div>
                        <div class="buttons">
                            <button class="see-more">SEE MORE</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- list thumbnail -->
            <div class="thumbnail">
                <div class="item active">
                    <img src="images/img1.jpg" alt="Thumbnail 1">
                    <div class="content">
                        <div class="title">
                            Name Slider
                        </div>
                        <div class="description">
                            Description
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="images/shoes.jpg" alt="Thumbnail 2">
                    <div class="content">
                        <div class="title">
                            Name Slider
                        </div>
                        <div class="description">
                            Description
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="images/img3.jpg" alt="Thumbnail 3">
                    <div class="content">
                        <div class="title">
                            Name Slider
                        </div>
                        <div class="description">
                            Description
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="images/hero.jpg" alt="Thumbnail 4">
                    <div class="content">
                        <div class="title">
                            Name Slider
                        </div>
                        <div class="description">
                            Description
                        </div>
                    </div>
                </div>
            </div>
            <!-- next prev -->
            <div class="arrows">
                <button id="prev">&lt;</button>
                <button id="next">&gt;</button>
            </div>
            <!-- time running -->
            <div class="time"></div>
        </div>
    </section>

    <script src="app.js"></script>
     
    
</body>
</html>

    </section>
    <div class="container">
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
            ?>
            <div class='shoe'>
                <a href='shoe_details.php?shoe_id=<?php echo $row["shoe_id"]; ?>'> 
                    <img class='shoe-image' src='../shoeImage/<?php echo $row["image_col"]; ?>' alt='Shoe Image'>
                </a>
                <div class='shoe-details'>
                    <h2 class='name'><?php echo $row["name"]; ?></h2>
                    <p class='brand'><strong>Brand:</strong> <?php echo $row["brand"]; ?></p>
                    <p class='price'><strong>Price:</strong> $<?php echo $row["price"]; ?></p>
                    <p class='status'><strong>Status:</strong> <?php echo ($row["status"] == 1 ? "Available" : "Out of Stock"); ?></p>
                </div>
            </div>
            <?php
                }
            } else {
                echo "<p>No shoes found.</p>";
            }
            ?>
        </div>       
        <?php
        // Retrieve data for new arrivals from the database
        $sql = "SELECT * FROM shoes ORDER BY created_at DESC LIMIT 5";
        $result = $connection->query($sql);

        // Check if there are any records
        if ($result->num_rows > 0) {
            // Output new arrivals section
            echo "<div class='new-arrivals'>";
            echo "<h2>New Arrivals</h2>";
            // Output data of each new arrival
            while ($row = $result->fetch_assoc()) {
                echo "<div class='shoe'>";
                echo "<a href='shoe_details.php?shoe_id=" . $row["shoe_id"] . "'>"; //  
                echo "<img class='shoe-image' src='../shoeImage/" . $row["image_col"] . "' alt='Shoe Image'>";
                echo "</a>";
                echo "<div class='shoe-details'>";
                echo "<h2 class='name'>" . $row["name"] . "</h2>";
                echo "<p class='brand'><strong>Brand:</strong> " . $row["brand"] . "</p>";
                echo "<p class='price'><strong>Price:</strong> $" . $row["price"] . "</p>";
                echo "<p class='status'><strong>Status:</strong> " . ($row["status"] == 1 ? "Available" : "Out of Stock") . "</p>";
                echo "</div>"; 
                echo "</div>"; 
            }
            echo "</div>";
        } else {
            echo "<p>No new arrivals found.</p>";
        }

        // Retrieve best seller shoes 
        $sql = "SELECT DISTINCT s.* FROM shoes s INNER JOIN purchase_request p ON s.shoe_id = p.shoe_id GROUP BY s.shoe_id HAVING COUNT(*) > 2";
        $result = $connection->query($sql);

        // Check if there are any best seller shoes
        if ($result->num_rows > 0) {
           
            echo "<div class='best-seller'>";
            echo "<h2>Best Sellers</h2>";
            // Output data of each best seller shoe
            while ($row = $result->fetch_assoc()) {
                echo "<div class='shoe'>";
                echo "<a href='shoe_details.php?shoe_id=" . $row["shoe_id"] . "'>"; 
                echo "<img class='shoe-image' src='../shoeImage/" . $row["image_col"] . "' alt='Shoe Image'>";
                echo "</a>";
                echo "<div class='shoe-details'>";
                echo "<h2 class='name'>" . $row["name"] . "</h2>";
                echo "<p class='brand'><strong>Brand:</strong> " . $row["brand"] . "</p>";
                echo "<p class='price'><strong>Price:</strong> $" . $row["price"] . "</p>";
                echo "<p class='status'><strong>Status:</strong> " . ($row["status"] == 1 ? "Available" : "Out of Stock") . "</p>";
                echo "</div>"; 
                echo "</div>"; 
            }
            echo "</div>";
        } else {
            echo "<p>No best seller shoes found.</p>";
        }

        // Close connection
        $connection->close();
        ?>
    </div>
</body>
</html>
<?php include('footer.php') ?>
