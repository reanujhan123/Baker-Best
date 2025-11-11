<?php

// Username is root
$user = 'root';
$password = '';

// Database name is geeksforgeeks
$database = 'bakerbest';

// Server is localhost with
// port number 3306
$servername = 'localhost';
$mysqli = new mysqli(
    $servername,
    $user,
    $password,
    $database
);

// Checking for connections
if ($mysqli->connect_error) {
    die('Connect Error (' .
        $mysqli->connect_errno . ') ' .
        $mysqli->connect_error);
}
$bakerysql = " SELECT * FROM product WHERE category_id = 4 ";
$bakery = $mysqli->query($bakerysql);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery Menu</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="bakery">
    <div class="topnav">
        <div class="logo">
            <img src="Images/logo5.png" alt="LOGO">
        </div>
        <ul class="nav">
            <li class="nav-item">
                <a class="link" href="index.html">Home</a>
            </li>
            <li class="nav-item">
                <a class="link" href="menu.html">Menu</a>
            </li>
            <li class="nav-item">
                <a class="link" href="gallery.php">Gallery</a>
            </li>
            <li class="nav-item">
                <a class="link" href="contact.html">Contact</a>
            </li>
            <li class="nav-item">
                <a class="link" href="about_us.html">About Us</a>
            </li>
            <li class="nav-item">
                <a class="link" href="order.php">Order Now</a>
            </li>
        </ul>
        <div class="contact">
            <a class="tel"><img src="Images/tel.svg" alt="telephone">0211 234 567</a>
            <a class="tel"><img src="Images/mail.svg" alt="email">bakerbest@gmail.com</a>
            <a class="whatsapp" href="https://www.whatsapp.com/?lang=en"><img src="Images/whatsapp.svg" alt="whatsapp"></a>
            <a class="instagram" href="https://www.instagram.com/?hl=en"><img src="Images/instagram.svg" alt="instagram"></a>
            <a class="facebook" href="https://www.facebook.com/"><img src="Images/facebook.svg" alt="facebook"></a>
        </div>
    </div>
    </div>
    <div class="product_menu">
        <video autoplay muted loop id="bgVideo">
            <source src="Images/bakeryvid.mp4" type="video/mp4">
        </video>
        <p>bakery</p>
    </div>
    <div class="parent">
        <div class="glass">
            <div id="bakerymenu">
                <?php while ($row = $bakery->fetch_assoc()) { ?>
                    <div class="item">
                        <img class="product-image" src="<?php echo $row['img_path']; ?>"
                            alt="<?php echo $row['product_name']; ?>">
                        <div class="pname">
                            <p><?php echo $row['product_name']; ?></p>
                            <p><?php echo 'RS. ' . $row['price'] . '/='; ?></p>
                        </div>
                    </div>
                <?php } ?>

            </div>

            <div class="backoption">
                <a href="Menu.html" class="menu-btn">
                    <span>Back to menu</span>
                    <span>Back to menu</span>
                    <span>Back to menu</span>
                    <span>Back to menu</span>
                </a>
            </div>
        </div>
    </div>
    <div class="final-block">
       <div class="description">
            <img id="final-block-logo" src="Images/logo5.png" alt="logo">
            <p>Family-owned artisan bakery crafting fresh, delicious baked goods daily. From traditional breads
                to custom cakes, we bring warmth to your table.</p>
            <div class="socialmedia">
                <a id="whatsapp" href="https://www.whatsapp.com/?lang=en"><img src="Images/whatsapp.svg" alt="whatsapp"></a>
                <a id="instagram" href="https://www.instagram.com/?hl=en"><img src="Images/instagram.svg" alt="instagram"></a>
                <a id="facebook" href="https://www.facebook.com/"><img src="Images/facebook.svg" alt="facebook"></a>
            </div>
        </div>
<div class="contact">
            <h2>Contact Us</h2>
            <div><img src="Images/location.svg" alt="location">
                <p>12, Main Street, Jaffna</p>
            </div>
            <div><img src="Images/tel.svg" alt="telephone">
                <p>021 123 4567</p>
            </div>
            <div><img src="Images/mail.svg" alt="email">
                <p>bakerbest@gmail.com</p>
            </div>
            <h2>Opening Hours</h2>
            <div>
                <img src="Images/timing.svg" alt="time">
                <p>Monday - Sunday: 6:00 AM - 10:00 PM</p>
            </div>
        </div>
        <div class="links">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="Menu.html">Menu</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="about_us.html">About Us</a></li>
                <li><a href="order.php">Order Now</a></li>
            </ul>
        </div>
        <div class="footer">
            <p>© 2025 Baker Best. All rights reserved. Made with ❤️ by SweetByte Designs.</p>
        </div>
    </div>
    <button id="wm-back-to-top">
        <div class="btt-background"></div>
        <a class="icon" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" aria-labelledby="title" role="img"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>Arrow Up</title>
                <path data-name="layer2" fill="none" stroke="#202020" stroke-miterlimit="10" stroke-width="2"
                    d="M32 10v46" stroke-linejoin="round" stroke-linecap="round"></path>
                <path data-name="layer1" fill="none" stroke="#202020" stroke-miterlimit="10" stroke-width="2"
                    d="M50 20 L32 4 14 20" stroke-linejoin="round" stroke-linecap="round"></path>
            </svg>
        </a>
    </button>
</body>

</html>