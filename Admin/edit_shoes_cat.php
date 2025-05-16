<?php
// Start session to access session variables
session_start();

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

    // Validate status field
    $status = $_POST['status'];
    if($status != '1' && $status != '0'){
        $err['status'] = 'Please select a valid status';
    }

    // Proceed if there are no errors
    if (count($err) == 0){
        require_once 'connection.php';
        $id = $_GET['id']; // Get category ID from URL
        $updated_at = date('Y-m-d H:i:s');
        $updated_by = $_SESSION['admin_id']; // Assuming admin ID is stored in session

        // Prepare and execute SQL statement to update category
        $sql = "UPDATE shoe_categories SET name='$name', status='$status', updated_by='$updated_by', updated_at='$updated_at' WHERE id=$id";
        $connection->query($sql);

        // Check if category was updated successfully
        if($connection->affected_rows == 1 ){
            $success = 'Category updated successfully';
        }else{
            $error = 'Category update failed';
        }
    }
}

// Get category ID from URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
} else {
    // Redirect if category ID is missing or invalid
    header('location:list_shoes_cat.php?msg=1');
    exit(); // Add exit to stop further execution
}

require_once 'connection.php';

// Query to select data from table
$sql = "SELECT id, name, status FROM shoe_categories WHERE id=$id";

// Execute query
$result = $connection->query($sql);
$row = [];

// Checking if the database returned exactly one row
if ($result->num_rows == 1) {
    // Fetching data from result object
    $row = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Shoe Category Details</title>
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
<?php require_once 'admin_menu.php'; ?>
<div class="wrapper">
    <h2>Edit Shoe Category Details</h2>
    <div>
        <form action="" method="POST" class="edit_shoes_form">
            <fieldset>
                <?php if (isset($error)) : ?>
                    <p class="error_message"><?php echo $error ?></p>
                <?php endif; ?>
                <?php if (isset($success)) : ?>
                    <p class="success_message"><?php echo $success ?></p>
                <?php endif; ?>

                <?php if (isset($_GET['err']) && $_GET['err'] == 1) : ?>
                    <p class="error_msg">Please login to continue</p>
                <?php endif; ?>
                <legend>Category Form</legend>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>">
                    <?php if (isset($err['name'])) : ?>
                        <span class="form-error"><?php echo $err['name']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="radio" name="status" value="1" <?php echo $row['status'] == 1 ? 'checked' : ''; ?>>Active
                    <input type="radio" name="status" value="0" <?php echo $row['status'] == 0 ? 'checked' : ''; ?>>Deactive
                </div>
                <div class="form-group">
                    <input type="submit" name="btnUpdate" id="update" value="Update">
                    <input type="reset" name="btnClear" id="clear" value="Clear">
                </div>
            </fieldset>
        </form>
    </div>
</div>
</body>
</html>
