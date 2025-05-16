<?php
require_once 'connection.php';

//query to select data from table
$sql="SELECT id,name,status from shoe_categories order by name";

//execute query 
$result=$connection->query($sql);
$data=[];

//checking if the databse is empty for fetching the data
if($result->num_rows > 0){
	//fetching data from result object using while loop
	while($row = $result->fetch_assoc()){
		array_push($data, $row);

	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>shoe category listing</title>
	<style type="text/css">
		/* style.css */

/* Wrapper styles */
.wrapper {
    margin: 20px;
    font-family: Arial, sans-serif;
}

/* Table styles */
.list_shoes_cat {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.list_shoes_cat th,
.list_shoes_cat td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.list_shoes_cat th {
    background-color: #f2f2f2;
}

/* Error message styles */
.error_msg {
    color: red;
    font-weight: bold;
}

/* Action column styles */
.action_col a {
    margin-right: 5px;
    text-decoration: none;
    padding: 3px 8px;
    border: 1px solid #ccc;
    border-radius: 3px;
    color: #333;
    background-color: #f9f9f9; /* Neutral color */
    transition: background-color 0.3s; /* Smooth transition */
}

.action_col a:hover {
    background-color: #e0e0e0; /* Hover color */
}

/* No record styles */
.no_record {
    font-style: italic;
    color: #999;
}

	</style>
	 <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php require_once'admin_menu.php';?>
	<div class="wrapper">
		<h2>shoes category</h2>
		<div>

			<?php if(isset($_GET['msg']) && $_GET['msg'] ==1 ){?>
				<p class="error_msg">Invalid Request</p>
			<?php }?>

			<?php if(isset($_GET['msg']) && $_GET['msg'] ==2 ){?>
				<p class="done_msg"> Category deleted successfully</p>
			<?php }?>

			<?php if(isset($_GET['msg']) && $_GET['msg'] ==3 ){?>
				<p class="error_msg">Request failed</p>
			<?php }?>
			<table class="list_shoes_cat">
				<thead>
				<tr>
					<th>SN</th>
					<th>Name</th>
					<th>status</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
					<?php if (count($data)>0) {?>
						<?php foreach($data as $key => $record){?>
				<tr>
					<td><?php echo $key +1 ?></td>		
					<td><?php echo $record ['name'] ?></td>
					<td><?php if($record['status'] ==1) {
						echo'Active';
					}else{
						echo'Deactive';
					} ?> </td>
					<td class="action_col">
						<a href="edit_shoes_cat.php?id=<?php echo $record['id'] ?>"" class="edit" >Edit</a>
						<a href="view_shoes_cat.php?id=<?php echo $record['id'] ?>" class="view" target="_blank">View</a>
						<a href="delete_shoe_catagory.php?id=<?php echo $record['id'];?>" class="delete" onclick="return confirm('are you sure')">Delete</a>

					</td>
				</tr>
			<?php } ?>
			<?php } else { ?>
				<tr class="no_record">
					<td>No categories found into database</td>
				</tbody>
			<?php } ?>
			</table>	
	</div>
</body>