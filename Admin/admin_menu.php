
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
<ul class="admin_menu">
    <?php
        $sn=explode('/', $_SERVER['SCRIPT_NAME']);
        $page = $sn[count($sn)-1];
    ?>
    <li class="<?php echo ($page == 'dashboard.php') ? 'active_link' : ''; ?>"><a href="dashboard.php">Dashboard</a></li>
    <li class="<?php echo ($page == 'list_shoes.php') ? 'active_link' : ''; ?>"><a href="list_shoes.php">List Shoes</a></li>
    <li class="<?php echo ($page == 'add_shoes.php') ? 'active_link' : ''; ?>"><a href="add_shoes.php">Add Shoes</a></li>
    <li class="<?php echo ($page == 'orders.php') ? 'active_link' : ''; ?>"><a href="orders.php">Orders</a></li>
    <li class="<?php echo ($page == 'logout.php') ? 'active_link' : ''; ?>"><a href="logout.php">Logout</a></li>
</ul>

<style>
    /* Elegant CSS Styles */
.admin_menu {
    list-style-type: none;
    padding: 0;
    margin: 0;
    background: linear-gradient(90deg, #ff6f61, #de6262); /* Gradient background */
    border-radius: 8px; /* More rounded corners */
    overflow: hidden; /* Ensures border radius applies to child elements */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    display: flex; /* Flexbox for easier alignment */
    justify-content: space-around; /* Space items evenly */
}

.admin_menu li {
    flex: 1; 
}

.admin_menu li a {
    display: block;
    padding: 15px 20px;
    text-decoration: none;
    color: #fff; 
    font-family: 'Arial', sans-serif; 
    font-size: 20px; 
    text-align: center;
    transition: all 0.3s ease;
    position: relative; 
}

.admin_menu li a::before {
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

.admin_menu li a:hover::before {
    transform: scaleX(1);
    transform-origin: left;
}

.admin_menu li a:hover {
    background: rgba(255, 255, 255, 0.1);
}

.admin_menu .active_link a {
    color: #ff6f61; 
    background: #fff; 
    font-weight: bold; 
    border-radius: 4px; 
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); 

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
        text-decoration: none;
    }
        * {
        margin: 0;
        padding: 10px;
        border: none;
        outline: none;
        text-decoration: none;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }
</style>
