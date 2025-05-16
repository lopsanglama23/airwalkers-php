
<?php
session_start();

//validation
if(isset($_POST['btnSave'])){
	//assing error to array
	$err=[];

	if(isset($_POST['name']) && !empty($_POST['name']) && trim($_POST['name'])){
		$name=$_POST['name'];
	}else{
		$err['name']='Please enter name';
	}

	$status = $_POST['status'];
	$created_at=date('Y-m-d H:i:s');
	$created_by = $_SESSION['admin_id'];
    

	if (count($err)==0){
			require_once'connection.php';
			$sql ="INSERT INTO shoe_categories (name,status,created_at,created_by) VALUES('$name','$status','$created_at','$created_by')";
			$connection->query($sql);
			if($connection->affected_rows ==1 && $connection->insert_id > 0){
				$success = 'Category insert success';
			}else{
				$error='Category insert failed';
			}

	}
}
?>


<!DOCTYPE html>
<html>
<head>
 <title>hhh</title>
 <link rel="stylesheet" type="text/css" href="style.css">
 <style>
        /* Form wrapper styles */
        .wrapper {
            margin: 20px;
            font-family: Arial, sans-serif;
        }

        /* Form container styles */
        .add_shoes_form {
            width: 50%;
            margin: auto;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Form title styles */
        .add_shoes_form h5 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        /* Form field styles */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="radio"] {
            width: calc(100% - 12px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

      /* Button styles */
.form-group input[type="submit"],
.form-group input[type="reset"] {
    width: 100px; /* Adjust width as needed */
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
.form-group input[type="reset"] {
    margin-left: 10px; /* Add margin to separate buttons */
}

.form-group input[type="submit"]:hover,
.form-group input[type="reset"]:hover {
    background-color: #737373; /* Darker grey on hover */
}

    </style>
</head>
<body>
	<?php require_once 'admin_menu.php'?>
   <div class="wrapper">
   			<h5>Create shoes category</h5>
   	<div>
   	<form action="" method="POST" class="add_shoes_form">
       <fieldset>
       	<?php if (isset($error)){?>
       			<p class="error_message"><?php echo $error ?></p>
       	<?php }?>
       	<?php if (isset($success)){?>
       			<p class="success_message"><?php echo $success ?></p>
       	<?php }?>


       	<?php if (isset($_GET['err']) && $_GET['err']==1){?>
       			<p class="error_msg">Please login to continue</p>
       	<?php }?>
       	<legend>Category form</legend>
       	<div class="form-group">
       		<label for="name">name</label>
       		<input type="text" name="name" id="name" placeholder="enter name" value="<?php echo isset($name)? $name :''?>"/>
       		<?php if (isset($err['name'])){ ?>
       				<?php echo $err['name'] ?>
       		<?php } ?>
       	</div>
       	<div class="form-group">
    <label for="status">Status</label>
    <input type="radio" id="active" name="status" value="1">
    <label for="active">Active</label>
    <input type="radio" id="deactive" name="status" value="0" checked>
    <label for="deactive">Deactive</label>

       
     
       	<input type="submit" name="btnSave" id="save" value="save">
       	<input type="submit" name="btnClear" id="clear" value="clear">
       </fieldset>
	</form>
</div>
	</div>
	
</body>
</html>