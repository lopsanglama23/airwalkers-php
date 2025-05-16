<?php
session_start();
if(!isset($_SESSION['admin_id']))
{
	header('location:index.php?err=1');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard | By Code Info</title>
  <style>
    /* Combined and updated CSS */
    * {
        margin: 0;
        padding: 10px;
        border: none;
        outline: none;
        text-decoration: none;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    body {
        background: rgb(219, 219, 219);
        display: flex;
        min-height: 100vh;
        flex-direction: column;
    }

    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 60px;
        padding: 20px;
        background: #fff;
    }

    .logo a {
        color: #000;
        font-size: 18px;
        font-weight: 600;
    }

    .header-icons .account img {
        width: 35px;
        height: 35px;
        cursor: pointer;
        border-radius: 50%;
    }

    .container {
        display: flex;
        flex: 1;
        margin-top: 10px;
    }

    nav {
        background: #fff;
        width: 250px;
        padding-top: 20px;
    }

    .side_navbar {
        list-style-type: none;
        padding: 0;
        margin: 0;
        background: linear-gradient(180deg, #ff6f61, #de6262); /* Gradient background */
        border-radius: 8px; /* More rounded corners */
        overflow: hidden; /* Ensures border radius applies to child elements */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        display: flex;
        flex-direction: column;
    }

    .side_navbar li {
        width: 100%;
    }

    .side_navbar li a {
        display: block;
        padding: 15px 20px;
        text-decoration: none;
        color: #fff; /* White text color */
        font-family: 'Arial', sans-serif; /* Clean font */
        font-size: 18px; /* Appropriate font size for sidebar */
        text-align: left;
        transition: all 0.3s ease;
        position: relative; /* For the hover effect */
    }

    .side_navbar li a::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #fff;
        transform: scaleX(0);
        transform-origin: right;
        transition: transform 0.3s ease;
    }

    .side_navbar li a:hover::before {
        transform: scaleX(1);
        transform-origin: left;
    }

    .side_navbar li a:hover {
        background: rgba(255, 255, 255, 0.1); /* Light transparent background on hover */
    }

    .side_navbar .active_link a {
        color: #ff6f61; /* Matching active link color */
        background: #fff; /* White background for active link */
        font-weight: bold; /* Bold font for active link */
        border-radius: 4px; /* Slightly rounded corners for active link */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Slight shadow for active link */
    }

    .main-body {
        flex: 1;
        padding: 1rem;
    }

    .promo_card {
        width: 100%;
        color: #fff;
        margin-top: 10px;
        border-radius: 8px;
        padding: 0.5rem 1rem 1rem 3rem;
        background: rgb(37, 37, 37);
    }

    .promo_card h1,
    .promo_card span,
    button {
        margin: 10px;
    }

    @media only screen and (max-width: 768px) {
        .header {
            flex-direction: column;
            align-items: flex-start;
            padding: 10px;
        }

        .logo a {
            margin: 1rem 1rem 0;
        }

        .container {
            flex-direction: column;
            align-items: center;
        }

        nav {
            width: 100%;
        }

        .side_navbar li a {
            padding: 15px 10px;
            font-size: 16px;
        }

        .promo_card {
            padding: 0.5rem 1rem;
        }
    }
  </style>
</head>
<body>
  <header class="header">
    <div class="logo">
      <a href="#">Airwalker</a>
    </div>
    <div class="header-icons">
      <div class="account">
        <h4></h4>
      </div>
    </div>
  </header>

  <div class="container">
    <nav>
      <ul class="side_navbar">
        <?php
          $sn = explode('/', $_SERVER['SCRIPT_NAME']);
          $page = $sn[count($sn) - 1];
        ?>
        <li class="<?php echo ($page == 'dashboard.php') ? 'active_link' : ''; ?>"><a href="dashboard.php">Dashboard</a></li>
        <li class="<?php echo ($page == 'list_shoes.php') ? 'active_link' : ''; ?>"><a href="list_shoes.php">List Shoes</a></li>
        <li class="<?php echo ($page == 'add_shoes.php') ? 'active_link' : ''; ?>"><a href="add_shoes.php">Add Shoes</a></li>
        <li class="<?php echo ($page == 'orders.php') ? 'active_link' : ''; ?>"><a href="orders.php">Orders</a></li>
        <li class="<?php echo ($page == 'logout.php') ? 'active_link' : ''; ?>"><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
    <div class="main-body">
      <h2>Dashboard</h2>
      <div class="promo_card">
        <h1>Welcome to Airwalker</h1>
        <span>Footwear Store</span>
      </div>
    </div>
  </div>
</body>
</html>


