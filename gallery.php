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

// SQL query to select data from database
$allproductssql = " SELECT * FROM product ORDER BY category_id asc ";
$result = $mysqli->query($allproductssql);

$bakerysql = " SELECT * FROM product WHERE category_id = 4 ";
$bakery = $mysqli->query($bakerysql);

$cakessql = " SELECT * FROM product WHERE category_id = 3 ";
$cakes = $mysqli->query($cakessql);

$cookiesql = " SELECT * FROM product WHERE category_id = 6 ";
$cookie = $mysqli->query($cookiesql);

$beveragesql = " SELECT * FROM product WHERE category_id = 1 ";
$beverages = $mysqli->query($beveragesql);

$savouriessql = " SELECT * FROM product WHERE category_id = 5 ";
$savouries = $mysqli->query($savouriessql);

$sweetsql = " SELECT * FROM product WHERE category_id = 2 ";
$sweets = $mysqli->query($sweetsql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>

    </style>
</head>

<body class="gallery">
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
                <a class="current-link">Gallery</a>
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
    <div class="gallery-header">
        <img class="bgleft" src="Images/bgleft.png" alt="left corner bun ">
        <h1>Our Delicious Creations</h1>
        <p>Explore our handcrafted collection of bakery delights — from cakes to cookies and everything in between.</p>
        <img class="bgright" src="Images/bgright.png" alt="right corner bun">
    </div>
    <div class="container">
        <div class="container-glass">
            <div class="gallery-btn">
                <button class="btn" onclick="showGrid('shop')">Interior</button>
                <button class="btn" onclick="showGrid('products')">All Products</button>
                <button class="btn" onclick="showGrid('bakery')">Bakery</button>
                <button class="btn" onclick="showGrid('cakes')">Cakes</button>
                <button class="btn" onclick="showGrid('sweets')">Sweets</button>
                <button class="btn" onclick="showGrid('savouries')">Savouries</button>
                <button class="btn" onclick="showGrid('beverages')">Beverages</button>
                <button class="btn" onclick="showGrid('cookie')">Cookie</button>
            </div>
            <div id="products">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <div class="grid-item">
                        <img class="product-image" src="<?php echo $row['img_path']; ?>"
                            alt="<?php echo $row['product_name']; ?>">
                    </div>
                <?php } ?>
            </div>
            <div id="bakery">
                <?php while ($row = $bakery->fetch_assoc()) { ?>
                    <div class="grid-item">
                        <img class="product-image" src="<?php echo $row['img_path']; ?>"
                            alt="<?php echo $row['product_name']; ?>">
                    </div>
                <?php } ?>
            </div>
            <div id="cakes">
                <?php while ($row = $cakes->fetch_assoc()) { ?>
                    <div class="grid-item">
                        <img class="product-image" src="<?php echo $row['img_path']; ?>"
                            alt="<?php echo $row['product_name']; ?>">
                    </div>
                <?php } ?>
            </div>
            <div id="cookie">
                <?php while ($row = $cookie->fetch_assoc()) { ?>
                    <div class="grid-item">
                        <img class="product-image" src="<?php echo $row['img_path']; ?>"
                            alt="<?php echo $row['product_name']; ?>">
                    </div>
                <?php } ?>
            </div>
            <div id="beverages">
                <?php while ($row = $beverages->fetch_assoc()) { ?>
                    <div class="grid-item">
                        <img class="product-image" src="<?php echo $row['img_path']; ?>"
                            alt="<?php echo $row['product_name']; ?>">
                    </div>
                <?php } ?>

            </div>
            <div id="sweets">
                <?php while ($row = $sweets->fetch_assoc()) { ?>
                    <div class="grid-item">
                        <img class="product-image" src="<?php echo $row['img_path']; ?>"
                            alt="<?php echo $row['product_name']; ?>">
                    </div>
                <?php } ?>

            </div>
            <div id="savouries">
                <?php while ($row = $savouries->fetch_assoc()) { ?>
                    <div class="grid-item">
                        <img class="product-image" src="<?php echo $row['img_path']; ?>"
                            alt="<?php echo $row['product_name']; ?>">
                    </div>
                <?php } ?>
            </div>
            <div id="shop">
                <div class="grid-item">
                    <img src="Images/bakeryinterior.jpg" alt="Interior image of Baker Best">
                </div>
                <div class="grid-item">
                    <img src="Images/seating.jpg" alt="Indoor seating area of Baker Best Bakery">
                </div>
                <div class="grid-item">
                    <img src="Images/oven.jpg" alt="Oven used for baking fresh bread at Baker Best Bakery">
                </div>
                <div class="grid-item">
                    <img src="Images/oven2.jpg" alt="Oven used for baking fresh bread at Baker Best Bakery">
                </div>
                <div class="grid-item">
                    <img src="Images/seating2.jpg" alt="Indoor seating area of Baker Best Bakery">
                </div>
                <div class="grid-item">
                    <img src="Images/oven3.jpg" alt="Oven used for baking fresh bread at Baker Best Bakery">
                </div>
                <div class="grid-item">
                    <img src="Images/display.jpg" alt="Display cabinet in Baker Best">
                </div>

            </div>
        </div>
    </div>
    <div class="final-block">
        <div class="description">
            <img id="final-block-logo" src="Images/logo5.png" alt="Baker Best logo">
            <p>Family-owned artisan bakery crafting fresh, delicious baked goods daily. From traditional breads
                to custom cakes, we bring warmth to your table.</p>
            <div class="socialmedia">
                <img id="whatsapp" src="Images/whatsapp.svg" alt="whatsapp">
                <img id="instagram" src="Images/instagram.svg" alt="instagram">
                <img id="facebook" src="Images/facebook.svg" alt="facebook">
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
    <script>
        let currentOpen = null;

        function showGrid(id) {
            // All section IDs
            var sections = ["products", "bakery", "cakes", "beverages", "sweets", "savouries", "cookie", "shop"];

            // If the same section is clicked again → close it
            if (currentOpen == id) {
                document.getElementById(id).style.display = "none";
                currentOpen = null;
                return;
            }

            // Hide all sections
            sections.forEach(sec => {
                document.getElementById(sec).style.display = "none";
            });

            // Show the clicked section
            document.getElementById(id).style.display = "grid";
            currentOpen = id;
        }
        showGrid('shop');

        const interiorBtn = document.querySelector('.gallery-btn button');
        interiorBtn.classList.add('special');


        const btnELlist = document.querySelectorAll('.btn');

        btnELlist.forEach(btnEl => {
            btnEl.addEventListener('click', () => {
                // If this button is already selected → unselect it
                if (btnEl.classList.contains('special')) {
                    btnEl.classList.remove('special');
                } else {
                    // Remove special from any other button
                    const current = document.querySelector('.btn.special');
                    if (current) current.classList.remove('special');

                    // Add special to clicked button
                    btnEl.classList.add('special');
                }
            });
        });



    </script>
</body>

</html>