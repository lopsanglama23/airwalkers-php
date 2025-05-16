<?php
session_start();

require_once 'connection.php'; // Include the database connection file

$username = $password = ''; 
$errUsername = $errPassword = ''; 

if(isset($_POST['btnlogin'])){
    // Validate username
    if(isset($_POST['username']) && !empty($_POST['username']) && trim($_POST['username'])){
        $username = trim($_POST['username']);
    } else {
        $errUsername = 'Enter your username';
    }
    
    // Validate password
    if(isset($_POST['password']) && !empty($_POST['password'])){
        $password = $_POST['password'];
    } else {
        $errPassword =  "Enter password";
    }
    
    if(empty($errUsername) && empty($errPassword)) {
        // Check if username exists in the Users table
        $query = "SELECT * FROM Users WHERE username='$username'";
        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result) == 1){
            $user = mysqli_fetch_assoc($result);
            if(password_verify($password, $user['password'])){
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_id'] = $user['user_id']; 

                header("Location: index.php");
                exit();
            } else {
                $errPassword = "Incorrect password";
            }
        } else {
            $errUsername = "User not found";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #565051;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-container {
      background-color: #fff;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center;
      width: 300px;
    }

    h2 {
      margin-top: 0;
      color: #333;
    }

    .input-container {
      margin-bottom: 20px;
      text-align: left;
    }

    label {
      display: block;
      margin-bottom: 5px;
      color: #666;
    }

    input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .error-message {
      color: red;
      font-size: 12px;
      margin-top: 5px;
      display: block;
      text-align: left;
    }

    button {
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 10px 20px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #0056b3;
    }

    p {
      margin-top: 20px;
      color: #666;
    }

    a {
      color: #007bff;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>LOGIN</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
      <div class="input-container">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" value="<?php echo isset($username) ? $username : ''; ?>"/>
        <span class="error-message"><?php echo isset($errUsername) ? $errUsername : ''; ?></span>
      </div>
      <div class="input-container">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" />
        <span class="error-message"><?php echo isset($errPassword) ? $errPassword : ''; ?></span>
      </div>
      <button type="submit" name="btnlogin">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register</a></p>
  </div>
</body>
</html>
