<?php
if(isset($_COOKIE['admin_id'])){
    session_start();
    $_SESSION['admin_id'] = $_COOKIE['admin_id'];
    $_SESSION['admin_username'] = $_COOKIE['admin_username'];
    $_SESSION['admin_name'] = $_COOKIE['admin_name'];
    header('locaion:dashboard.php');
}

//after button click
if(isset($_POST['btnLogin'])){
    //assing error to array
    $err=[];

    if(isset($_POST['username']) && !empty($_POST['username']) && trim($_POST['username'])){
        $username=$_POST['username'];
    }else{
        $err['username']='Please enter username';
    }

    if(isset($_POST['password']) && !empty($_POST['password']) && trim($_POST['password'])){
        $password=$_POST['password'];

    }else{
        $err['password']='Please enter password';
    }
    if (count($err)==0){
        require_once 'connection.php';  
        $sql="SELECT id,name,username FROM admins WHERE username='$username' AND password='$password' AND status=1";

        //execute query
        $result=$connection->query($sql);

        if($result->num_rows == 1){
            $row = $result->fetch_assoc();

            session_start();
            $_SESSION['admin_id']=$row['id'];
            $_SESSION['admin_name']=$row['name'];
            $_SESSION['admin_username']=$row['username'];
            
            //check remember me button
            if(isset($_POST['remember'])){
                //store data into cookie
                setcookie('admin-id',$row['id'],time()+7*24*60*60);
                setcookie('admin-username',$row['username'],time()+7*24*60*60);
                setcookie('admin-name',$row['name'],time()+7*24*60*60);
            }

            //redirect to next page
            header('location:dashboard.php');

        }else{
            $msg='Username and password do not match';
        }
        
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            width: 300px;
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-container h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: calc(100% - 12px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group input[type="checkbox"] {
            margin-right: 5px;
        }

        .error-msg {
            color: red;
            margin-top: 5px;
        }

        .btn-container {
            text-align: center;
        }

        .btn-container input[type="submit"],
        .btn-container input[type="reset"] {
            width: 100px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-container input[type="submit"] {
            background-color: #007bff;
            color: #fff;
        }

        .btn-container input[type="reset"] {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-container input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .btn-container input[type="reset"]:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Admin Login</h1>
        <form action="" method="POST">
            <?php if (isset($msg)) : ?>
                <p class="error-msg"><?php echo $msg; ?></p>
            <?php endif; ?>
            <?php if (isset($_GET['err']) && $_GET['err'] == 1) : ?>
                <p class="error-msg">Please login to continue</p>
            <?php endif; ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter username" value="<?php echo isset($username) ? $username : ''; ?>" />
                <?php if (isset($err['username'])) : ?>
                    <p class="error-msg"><?php echo $err['username']; ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter password" />
                <?php if (isset($err['password'])) : ?>
                    <p class="error-msg"><?php echo $err['password']; ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            </div>
            <div class="btn-container">
                <input type="submit" name="btnLogin" value="Login">
                <input type="reset" name="btnClear" value="Clear">
            </div>
        </form>
    </div>
</body>
</html>
