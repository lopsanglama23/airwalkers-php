<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <style>
       /* CSS styles */
       /* CSS styles */
body {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f2f2f2;
}

header {
    background-color: rgba(51, 51, 51, 0.9); /* Slightly more opaque black */
    padding: 20px 40px; /* Increased padding */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    background-size: cover; /* Ensure the background image covers the entire header */
    position: relative; /* Add relative positioning to create a stacking context */
    z-index: 100; /* High z-index to ensure it's in front */
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

nav ul li {
    position: relative;
}

nav ul li a {
    text-decoration: none;
    color: #fff;
    font-weight: bold;
    font-size: 18px; /* Increased font size */
    text-transform: uppercase;
    transition: color 0.3s ease, border-bottom 0.3s ease;
    padding: 10px 15px; /* Adjusted padding */
}

nav ul li a:hover {
    color: hotpink; /* Red color on hover */
    border-bottom: 4px solid hotpink; /* Red underline on hover */
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #333;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 200; /* Ensure dropdown is in front of other elements */
    padding: 10px;
    border-radius: 5px; /* Rounded corners for dropdown */
}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown-content a {
    display: block;
    text-decoration: none;
    color: #fff;
    font-size: 16px; /* Increased font size for dropdown items */
    transition: color 0.3s ease;
    padding: 5px 0;
}

.dropdown-content a:hover {
    color: lightpink; /* Red color on hover */
}

.welcome {
    color: #ffd700; /* Gold color */
    font-weight: bold;
    font-size: 18px; /* Increased font size */
    text-transform: uppercase;
    margin-right: 20px;
    position: relative;
}

.welcome:hover {
    background-color: #444; /* Darker gray for hover */
    border-radius: 5px; /* Rounded corners */
    padding: 10px; /* Adjust padding */
}

/* Responsive styling */
@media (max-width: 768px) {
    nav ul {
        flex-direction: column;
        align-items: flex-start;
    }
    nav ul li {
        width: 100%;
    }
    nav ul li a {
        display: block;
        width: 100%;
    }
    .dropdown-content {
        position: static;
        width: 100%;
        box-shadow: none;
    }
}


    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php" class="home">Home</a></li>
                <li class="dropdown">
                    <a class="brand">Brand</a>
                    <div class="dropdown-content">
                        <a href="addidas.php">Adidas</a>
                        <a href="nike.php">Nike</a>
                        <a href="puma.php">Puma</a>
                        <!-- Add more brand links as needed -->
                    </div>
                </li>
                <li><a href="aboutus.php" class="aboutus">About Us</a></li>
                <li><a href="contactus.php" class="contact">Contact Us</a></li>
                <li><a href="order.php" class="order">My Order</a></li>
                <li class="my-cart"><a href="mycart.php">My Cart</a></li>
                <li class="my-cart"><a href="wishlist.php">wishlist</a></li>
                <?php 
                    session_start();
                    if(isset($_SESSION['username'])) {
                        echo '<li class="welcome">Welcome, ' . $_SESSION['username'] . '</li>';
                        echo '<li><a href="loggingout.php" class="logout">Logout</a></li>';
                    } else {
                        echo '<li><a href="login.php" class="login">Login</a></li>';
                        echo '<li><a href="register.php" class="register">Register</a></li>';
                    }
                ?>
            </ul>
        </nav>
    </header>
</body>
</html>
