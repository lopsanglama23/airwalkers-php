<?php
//calling function to get admin name
require_once 'function.php';

// Check if ID is numeric
if (isset($_GET['shoe_id']) && is_numeric($_GET['shoe_id'])) {
    $id = $_GET['shoe_id'];
} else {
    // Redirect to shoe category listing page with error message
    header('location: list_shoes_cat.php?msg=1');
    exit();
}

require_once 'connection.php';

// Query to select data from table
$sql = "SELECT * FROM shoes WHERE shoe_id = $id";

// Execute query
$result = $connection->query($sql);
$data = [];

// Checking if the database has data for fetching the details
if ($result->num_rows > 0) {
    // Fetching data from result object
    $row = $result->fetch_assoc();
} else {
    $row = [];
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

        /* Table styles */
        .view_table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .view_table th,
        .view_table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .view_table th {
            background-color: #f2f2f2;
        }

        /* No record styles */
        .no_record {
            font-style: italic;
            color: #999;
        }
    </style>
</head>
<body>
<?php require_once 'admin_menu.php'; ?>
<div class="wrapper">
    <h2>Shoe Category Details</h2>
    <div>
        <?php if (!empty($row)) { ?>
            <table class="view_table">
                <tr>
                    <th>Name</th>
                    <td><?php echo $row['name'] ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?php echo $row['status'] == 1 ? 'Active' : 'Deactive'; ?></td>
                </tr>
                <tr>
                    <th>Created By</th>
                    <td><?php echo getNameByAdminId($row['created_by']) ?></td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td><?php echo $row['created_at'] ?></td>
                </tr>
                <tr>
                    <th>Updated By</th>
                    <td><?php echo $row['updated_by'] ? getNameByAdminId($row['updated_by']) : ''; ?></td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td><?php echo $row['updated_at'] ?></td>
                </tr>
            </table>
        <?php } else { ?>
            <div class="no_record">
                Invalid category information
            </div>
        <?php } ?>
    </div>
</div>
</body>
</html>
