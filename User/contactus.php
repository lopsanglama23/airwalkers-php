<?php include('header.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .contact-info {
            margin-top: 20px;
            text-align: center;
        }

        .contact-info p {
            margin-bottom: 10px;
        }

        .contact-info a {
            color: #007bff;
            text-decoration: none;
        }

        .contact-info a:hover {
            text-decoration: underline;
        }

        .fa {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Contact Us</h1>
        <div class="contact-info">
            <p><i class="fas fa-phone"></i> Phone Number: <a href="tel:+1234567890">1234567890</a></p>
            <p><i class="fab fa-instagram"></i> Instagram: <a href="https://www.instagram.com/instagram_username/">@airwalker</a></p>
            <p><i class="fab fa-facebook"></i> Facebook: <a href="https://www.facebook.com/facebook_page/">Airwalker</a></p>
            <p><i class="far fa-envelope"></i> Email: <a href="mailto:info@example.com">airwalker@gmail.com</a></p>
        </div>
    </div>
</body>
</html>
<?php include('footer.php') ?>
