<?php
//calling function to get admin name
require_once'function.php';
if(is_numeric($_GET['id'])){
	$id=$_GET['id'];
}else{
	header('location:list_shoes_cat.php?msg=1');
}
$id=$_GET['id'];
require_once 'connection.php';

//query to select data from table
$sql="SELECT * from shoe_categories where id=$id";

//execute query 
$result=$connection->query($sql);
$data=[];

//checking if the databse is empty for fetching the data
if($result->num_rows > 0){
	//fetching data from result object using while loop
	$row = $result->fetch_assoc();
	}else {
	$row=[];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>shoe category Details</title>
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
	<?php require_once'admin_menu.php';?>
	<div class="wrapper">
		<h2>shoes category details</h2>
		<div>
		 <?php 
		 	if (!empty($row)){?>
		 			<table class="view_table">
		 				<tr>
		 					<th>Name</th>
		 					<td><?php echo $row['name']?></td>
		 				</tr>
		 				<tr>
		 					<th>Status</th>
		 					<td><?php if($row['status'] ==1) {
						echo'Active';
					}else{
						echo'Deactive';
					} ?></td>
		 				</tr>
		 				<tr>
		 					<th>Created_by</th>
		 					<td><?php echo getNameByAdminId($row['created_by']) ?></td>
		 				</tr>
		 				<tr>
		 					<th>created_at</th>
		 					<td><?php echo $row['created_at']?></td>
		 				</tr>
		 				<tr>
		 					<th>updated_by</th>
		 					<td><?php if ($row['updated_by']){

		 						echo getNameByAdminId($row['updated_by']);
		 					} ?></td>
		 				</tr>
		 				<tr>
		 					<th>updated_at</th>
		 					<td><?php echo $row['updated_at']?></td>
		 				</tr>
		 			</table>

		 	<?php }else{ ?>
		 		<div class="no_record">
		 			invalid category information
		 		</div>
		 		
		 <?php	}
?>
			
		</div>
		</div>
</body>