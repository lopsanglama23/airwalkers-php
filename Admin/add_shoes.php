
<?php require_once 'admin_menu.php'?>
<?php
session_start(); // Start session if not already started

if(!isset($_SESSION['admin_id']))
{
    header('location:index.php?err=1');
}


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $created_at = date('Y-m-d H:i:s');
    $created_by = $_SESSION['admin_id'];

    // Validate form data (you can add more validation as needed)
    if (empty($name) || empty($brand) || empty($price) || empty($description)) {
        echo "All fields are required";
    } else {
        // Check if image is uploaded
        if ($_FILES['photo']['error'] == 0) {
            if ($_FILES['photo']['size'] < 1048576) { // 1MB limit
                $filetype = ['image/jpeg', 'image/png', 'image/webp'];
                if (in_array($_FILES['photo']['type'], $filetype)) {
                    $filename = uniqid() . '_' . $_FILES['photo']['name'];
                    $filepath = '../shoeImage/' . $filename;
                    if (move_uploaded_file($_FILES['photo']['tmp_name'], $filepath)) {
                        $vimage = $filename; // Store filename in $vimage variable
                    } else {
                        echo 'Upload Failed';
                    }
                } else {
                    echo 'File type must be JPG, PNG, or WEBP';
                }
            } else {
                echo 'File size must be less than 1MB';
            }
        } else {
            echo 'Choose file';
        }

        // Database connection
        $connection = new mysqli('localhost','root','','airwalker');
        if($connection->connect_errno !=0){
        die('Database Connection Error:'.$connection->connect_error);
        }
        // Prepare SQL statement to insert data into the database
        $sql = "INSERT INTO shoes (name, brand, price, description, image_col, status, created_at, created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        if (!$stmt) {
            die('Error: ' . $connection->error);
        }
        $stmt->bind_param("ssdssisi", $name, $brand, $price, $description, $vimage, $status, $created_at, $created_by);

        // Execute SQL statement
        if ($stmt->execute()) {
            echo "Shoe added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $stmt->error;
        }

        // Close statement and connection
        $stmt->close();
        $connection->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Shoe</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style type="text/css">
        /* Form wrapper styles */
        .wrapper {
            margin: 20px;
            font-family: Arial, sans-serif;
        }

        /* Form container styles */
        form {
            width: 30%;
            margin: auto;
            background-color: #f9f9f9;
            padding: 8px;
            border-radius: 3px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Form title styles */
        h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        /* Form field styles */
        form label {
            display: block;
            font-weight: bold;
            margin-bottom: 3px;
        }

        form input[type="text"],
        form textarea {
            width: calc(100% - 12px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 8px;
        }

        /* File input styles */
        form input[type="file"] {
            margin-bottom: 10px;
        }

        /* Radio button styles */
        form input[type="radio"] {
            margin-right: 5px;
        }

        /* Submit button styles */
        form input[type="submit"] {
            width: 100%; /* Full width */
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #808080; /* Grey background color */
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        /* Clear button */
        form input[type="reset"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 5px;
            background-color: #808080; /* Grey background color */
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        /* Button hover styles */
        form input[type="submit"]:hover,
        form input[type="reset"]:hover {
            background-color: #737373; /* Darker grey on hover */
        }

    </style>
</head>
<body>
    <header class="header">
    <div class="logo">
      <a href="dashboard.php">Name: Lopsang Lama</a>
      <a href="">Roll.no: 59</a>
    </div>
    <div class="header-icons">
      <div class="account">
      </div>
    </div>
</header>
    <h2>Add Shoe</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="brand">Brand:</label><br>
        <input type="text" id="brand" name="brand"><br>
        <label for="price">Price:</label><br>
        <input type="text" id="price" name="price"><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"></textarea><br>
        <label for="photo">Photo:</label><br>
        <input type="file" name="photo" id="photo"><br>
        <label for="status">Status</label>
        <input type="radio" name="status" value="1">Active
        <input type="radio" name="status" value="0" checked>DeActive
        <input type="submit" value="Add Shoe" name="submit">
    </form>
</body>
</html>
