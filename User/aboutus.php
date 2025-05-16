<?php include('header.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airwalker Footwear Store</title>
    <style>
        
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 0 20px;
}

/* Page header */
.about-header {
    text-align: center;
    margin-bottom: 40px;
}

.about-header h2 {
    color: #333;
    font-size: 32px;
    margin-bottom: 10px;
    font-weight: bold;
}

.about-header p {
    color: #555;
    font-size: 18px;
    margin-top: 10px;
    font-style: italic;
}

/* Main content */
section {
    margin-bottom: 40px;
}

section p {
    color: #444;
    font-size: 16px;
    line-height: 1.6;
    padding: 20px;
    border-radius: 10px;
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
    cursor: pointer;
    margin-bottom: 20px;
}

section p:hover {
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

/* Button */
.button {
    text-align: center;
    margin-top: 20px;
}

.button a {
    display: inline-block;
    background-color: #007bff;
    color: #fff;
    padding: 12px 24px;
    text-decoration: none;
    border-radius: 30px;
    transition: background-color 0.3s ease;
    font-size: 18px;
    font-weight: bold;
}

.button a:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <div class="container">
        <section class="about-header">
            <h2>KNOW US</h2>
            <p>Airwalker Footwear Store</p>
        </section>
        <section>
            <p>Where footwear meets fashion and comfort! Established with a passion for footwear and a commitment to providing exceptional customer service, we strive to offer the latest trends in shoes while ensuring quality and affordability. At <b>Airwalker Footwear Store</b>, we understand that shoes are not just a necessity but also a statement of style. Whether you're looking for trendy sneakers, elegant heels, comfortable flats, or durable boots, we have a diverse collection to suit every taste and occasion. Our team is dedicated to curating a selection of shoes from renowned brands and emerging designers, ensuring that you have access to the best footwear options available in the market. We believe that every step you take should be comfortable and stylish, which is why we pay attention to detail in selecting our products.</p>
            <p>What Sets Us Apart Quality Craftsmanship: We partner with reputable manufacturers known for their craftsmanship and attention to detail. Each pair of shoes we offer undergoes rigorous quality control to ensure it meets our standards. Wide Selection: Whether you're looking for stylish sneakers, comfortable sandals, or rugged boots, we've got you covered. Our carefully curated collection features a diverse range of styles to suit every taste and occasion. Exceptional Customer Service: At Airwalker, our customers are our top priority. Our friendly and knowledgeable team is here to assist you every step of the way, from finding the perfect fit to answering any questions you may have. Our Commitment to Sustainability We believe in making a positive impact on the planet, which is why we're committed to sustainability every step of the way. From eco-friendly materials to ethical manufacturing practices, we strive to minimize our environmental footprint while delivering quality footwear you can feel good about wearing. Visit Us Today! Whether you're shopping for yourself or searching for the perfect gift, we invite you to explore our collection and experience the difference at Airwalker. Visit our store today and step into style, comfort, and quality like never before!</p>
        </section>
        <div class="button">
            <a href="index.php">Shop Now</a>
        </div>
    </div>
    <?php include('footer.php');?>
</body>
</html>
