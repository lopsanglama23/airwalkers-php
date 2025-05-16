
<?php include('header.php') ?>
<?php

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include the database connection file
require_once 'connection.php';

$name = $address = $phone = $proof_of_payment = '';
$nameErr = $addressErr = $phoneErr = $proofErr = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
    }

    // Validate address
    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
    } else {
        $address = test_input($_POST["address"]);
    }

    // Validate phone number
    if (empty($_POST["phone"])) {
        $phoneErr = "Phone number is required";
    } else {
        $phone = test_input($_POST["phone"]);
        // Check if phone number is well-formed
        if (!preg_match("/^\d{10}$/", $phone)) {}
            $phoneErr = "Invalid phone number format";
        }
    }

    // Validate proof of payment
    if (isset($_FILES["proof_of_payment"]) && $_FILES["proof_of_payment"]["error"] == 0) {
        $allowed = ["jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png"];
        $filetype = $_FILES["proof_of_payment"]["type"];
        $filesize = $_FILES["proof_of_payment"]["size"];
        
        // Verify file extension and size
        $ext = pathinfo($_FILES["proof_of_payment"]["name"], PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) {
            $proofErr = "Invalid file format";
        } elseif ($filesize > 5 * 1024 * 1024) {
            $proofErr = "File size is larger than the allowed limit.";
        } elseif (!in_array($filetype, $allowed)) {
            $proofErr = "There was a problem uploading your file. Please try again.";
        } else {
            // Read file content
            $proof_of_payment = file_get_contents($_FILES["proof_of_payment"]["tmp_name"]);
        }
    } else {
        $proofErr = "Proof of payment is required.";
    }

    // If all inputs are valid
    if (empty($nameErr) && empty($addressErr) && empty($phoneErr) && empty($proofErr)) {
        // Get user ID from session
        $user_id = $_SESSION['user_id'];

        // Check if shoe IDs are provided via POST
        if (isset($_POST["shoe_ids"]) && !empty($_POST["shoe_ids"])) {
            // Get the shoe IDs from the form
            $shoe_ids = $_POST["shoe_ids"];

            $sql = "INSERT INTO purchase_request (user_id, shoe_id, name, address, phone, payimg) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $connection->prepare($sql);

            // Bind parameters
            $stmt->bind_param("iissss", $user_id, $shoe_id, $name, $address, $phone, $proof_of_payment);

            // Iterate through each shoe ID
            foreach ($shoe_ids as $shoe_id) {
                // Execute the SQL statement for each shoe
                $stmt->send_long_data(5, $proof_of_payment); // Index 5 corresponds to the payimg parameter
                $stmt->execute();
            }

            // Close statement
            $stmt->close();

            // Empty the cart after successful order placement
            unset($_SESSION['cart']);

            // Redirect to a success page or display a success message
            header("Location: index.php");
            exit();
        } else {
            // Shoe IDs not provided
            header("Location: order_error.php");
            exit();
        }
    }


// Retrieve cart items from session
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cart_items = $_SESSION['cart'];
} else {
    // Redirect to an error page or display an error message if cart is empty
    header("Location: cart_error.php");
    exit();
}

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container {
            width: 60%;
        }
        .image-container {
            width: 35%;
            text-align: center;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .error {
            color: #ff0000;
            font-size: 14px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Checkout</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <!-- Display cart items -->
                <?php foreach ($cart_items as $shoe_id => $quantity) : ?>
                    <input type="hidden" name="shoe_ids[]" value="<?php echo $shoe_id; ?>">
                <?php endforeach; ?>

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <span class="error"><?php echo $nameErr; ?></span>
                
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
                <span class="error"><?php echo $addressErr; ?></span>
                
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" required>
                <span class="error"><?php echo $phoneErr; ?></span>

                <label for="proof_of_payment">Proof of Payment:</label>
                <input type="file" id="proof_of_payment" name="proof_of_payment" accept="image/*" required>
                <span class="error"><?php echo $proofErr; ?></span>
                
                <input type="submit" value="Place Order">
            </form>
        </div>
        <div class="image-container">
            <h2>Scan for Payment</h2>
            <img src="images/QR.jpg" alt="Scan for Payment" style="max-width: 100%; height: auto;">
        </div>
    </div>
    
</body>
</html>
<?php include('footer.php')?>