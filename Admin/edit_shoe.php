<?php include('admin_menu.php')?>
<?php
// Start session to access session variables
session_start();

// Require the connection file
require_once 'connection.php';

// Check if form is submitted
if(isset($_POST['btnUpdate'])){
    // Assign errors to array
    $err = [];

    // Validate name field
    if(isset($_POST['name']) && !empty($_POST['name']) && trim($_POST['name'])){
        $name = $_POST['name'];
    }else{
        $err['name'] = 'Please enter name';
    }

    // Validate brand field
    if(isset($_POST['brand']) && !empty($_POST['brand']) && trim($_POST['brand'])){
        $brand = $_POST['brand'];
    }else{
        $err['brand'] = 'Please enter brand';
    }

    // Validate price field (assuming it's required)
    if(isset($_POST['price']) && !empty($_POST['price']) && trim($_POST['price'])){
        $price = $_POST['price'];
    }else{
        $err['price'] = 'Please enter price';
    }

    // Validate description field (assuming it's required)
    if(isset($_POST['description']) && !empty($_POST['description']) && trim($_POST['description'])){
        $description = $_POST['description'];
    }else{
        $err['description'] = 'Please enter description';
    }

    // Validate status field
    $status = $_POST['status'];
    if($status != '1' && $status != '0'){
        $err['status'] = 'Please select a valid status';
    }

    if ($_FILES['simage']['error'] == 0) {
        if ($_FILES['simage']['size'] < 1048576) { // 1MB limit
            $filetype = ['image/jpeg', 'image/png', 'image/webp'];
            if (in_array($_FILES['simage']['type'], $filetype)) {
                $filename = uniqid() . '_' . $_FILES['simage']['name'];
                $filepath = '../shoeImage/' . $filename;
                if (move_uploaded_file($_FILES['simage']['tmp_name'], $filepath)) {
                    $simage = $filename; // Store filename in $simage variable
                } else {
                    $err['img'] = 'Upload Failed';
                }
            } else {
                $err['img'] = 'File type must be JPG, PNG, or WEBP';
            }
        } else {
            $err['img'] = 'File size must be less than 1MB';
        }
    } else {
        $err['img'] = 'Choose file';
    }

    // Proceed if there are no errors
    if (count($err) == 0){
        // Get shoe ID from URL
        if (isset($_GET['shoe_id']) && is_numeric($_GET['shoe_id'])) {
            $shoe_id = $_GET['shoe_id'];
        } else {
            // Redirect if shoe ID is missing or invalid
            header('location:list_shoes.php?msg=1');
            exit(); // Add exit to stop further execution
        }

        // Get admin ID from session
        $updated_by = $_SESSION['admin_id']; // Assuming admin ID is stored in session

        // Prepare and execute SQL statement to update shoe details
        $sql = "UPDATE shoes SET name=?, brand=?, price=?, description=?, status=?, image_col=?, updated_by=?, updated_at=NOW() WHERE shoe_id=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssssssii", $name, $brand, $price, $description, $status, $simage, $updated_by, $shoe_id);
        if ($stmt->execute()) {
            $success = 'Shoe details updated successfully';
        } else {
            $error = 'Shoe details update failed: ' . $stmt->error;
        }
        $stmt->close();
    }
}

// Get shoe ID from URL
if (isset($_GET['shoe_id']) && is_numeric($_GET['shoe_id'])) {
    $shoe_id = $_GET['shoe_id'];

    // Query to select data from table
    $sql = "SELECT shoe_id, name, brand, price, description, status FROM shoes WHERE shoe_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $shoe_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = [];

    // Checking if the database returned exactly one row
    if ($result->num_rows == 1) {
        // Fetching data from result object
        $row = $result->fetch_assoc();
    }
    $stmt->close();
} else {
    // Redirect if shoe ID is missing or invalid
    header('location:list_shoes.php?msg=1');
    exit(); // Add exit to stop further execution
}

// Close MySQLi connection
$connection->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Shoe Details</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style type="text/css">
        /* style.css */

        /* Wrapper styles */
        .wrapper {
            margin: 20px;
            font-family: Arial, sans-serif;
        }

        /* Form styles */
        .edit_shoes_form {
            width: 50%;
            margin: auto;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="radio"] {
            width: 100%;
            padding: 5px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        /* Error message styles */
        .error_message {
            color: red;
        }

        /* Success message styles */
        .success_message {
            color: green;
        }

        /* Error message styles for form fields */
        .form-error {
            color: red;
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <h2>Edit Shoe Details</h2>
    <?php if(isset($success)): ?>
        <p class="success_message"><?php echo $success; ?></p>
    <?php endif; ?>
    <div>
        <form action="" method="POST" enctype="multipart/form-data" class="edit_shoes_form">
            <fieldset>
                <legend>Shoe Details Form</legend>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>">
                    <?php if (isset($err['name'])) : ?>
                        <span class="form-error"><?php echo $err['name']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="brand">Brand</label>
                    <input type="text" name="brand" id="brand" value="<?php echo isset($row['brand']) ? $row['brand'] : ''; ?>">
                    <?php if (isset($err['brand'])) : ?>
                        <span class="form-error"><?php echo $err['brand']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" name="price" id="price" value="<?php echo isset($row['price']) ? $row['price'] : ''; ?>">
                    <?php if (isset($err['price'])) : ?>
                        <span class="form-error"><?php echo $err['price']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" value="<?php echo isset($row['description']) ? $row['description'] : ''; ?>">
                    <?php if (isset($err['description'])) : ?>
                        <span class="form-error"><?php echo $err['description']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="simage">Edit Image</label>
                    <input type="file" name="simage" id="simage" />
                    <?php if (isset($err['img'])) :?>
                        <span class="form-error"><?php echo $err['img']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="radio" name="status" value="1" <?php echo $row['status'] == 1 ? 'checked' : ''; ?>>Active
                    <input type="radio" name="status" value="0" <?php echo $row['status'] == 0 ? 'checked' : ''; ?>>Deactive
                    <?php if (isset($err['status'])) : ?>
                        <span class="form-error"><?php echo $err['status']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <input type="submit" name="btnUpdate" id="update" value="Update">
                </div>
            </fieldset>
        </form>
    </div>
</div>
</body>
</html>
