<!DOCTYPE html>
<html lang="en">
<head>
  <title>Footer Design</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    body {
      line-height: 1.5;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      min-height: 100vh; /* Set minimum height to 100% of viewport height */
      background-color: #f0f0f0; /* Background color */
    }
    .containers {
      flex: 1; /* Grow to fill remaining space */
    }
    .row {
      display: flex;
      flex-wrap: wrap;
    }
    ul {
      list-style: none;
    }
    .footer {
      background-color: #000; /* Footer background color */
      padding: 70px 0;
      color: #fff; /* Footer text color */
      width: 100%; /* Set footer to full width */
    }
    .footer-col {
      width: 25%;
      padding: 0 15px;
    }
    .footer-col h4 {
      font-size: 18px;
      color: #fff; /* Footer heading color */
      text-transform: capitalize;
      margin-bottom: 25px;
      font-weight: 500;
      position: relative;
    }
    .footer-col h4::before {
      content: '';
      position: absolute;
      left: 0;
      bottom: -10px;
      background-color: #0947f3; /* Line color */
      height: 2px;
      box-sizing: border-box;
      width: 50px;
    }
    .footer-col ul li:not(:last-child) {
      margin-bottom: 5px;
    }
    .footer-col ul li a {
      font-size: 16px;
      text-transform: capitalize;
      color: #ccc; /* Footer link color */
      text-decoration: none;
      transition: color 0.3s ease;
    }
    .footer-col ul li a:hover {
      color: #fff; /* Footer link color on hover */
    }
    .footer-col .social-links a {
      background-color: rgba(255, 255, 255, 0.2);
      margin: 0 10px 10px 0;
      text-align: center;
      line-height: 40px;
      border-radius: 50%;
      color: #ccc; /* Social icon color */
      transition: all 0.5s ease;
      display: inline-block;
      width: 40px;
      height: 40px;
      font-size: 20px;
    }
    .footer-col .social-links a:hover {
      color: #fff; /* Social icon color on hover */
      background-color: #444;
    }
    .trademark {
      text-align: center;
      font-size: 14px;
      color: #888; /* Trademark text color */
      margin-top: 20px;
    }
    @media(max-width: 767px) {
      .footer-col {
        width: 50%;
        margin-bottom: 10px;
      }
    }
    @media(max-width: 574px) {
      .footer-col {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="containers">
    <!-- Content above the footer -->
  </div>
  <footer class="footer">
    <div class="containers">
      <div class="row">
        <div class="footer-col">
          <h4>Information</h4>
          <ul>
            <li><a href="aboutus.php">About us</a></li>
            <li><a href="privacy_policy.php">Privacy Policy</a></li>
            <li><a href="#">Brands</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Get Help</h4>
          <ul>
            <li><a href="#">Contact Us</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Follow Us</h4>
          <div class="social-links">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="trademark">&copy; 2024 Airwalker Online Shoe Store. All rights reserved.</div>
  </footer>
</body>
</html>
