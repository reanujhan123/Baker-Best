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
///cake menu
$sql = "SELECT * FROM product WHERE category_id = 3";
$result = $mysqli->query($sql);

$cakes = [];
while ($row = $result->fetch_assoc()) {
    $cakes[] = $row;
}
///bakery menu
$sql = "SELECT * FROM product WHERE category_id = 4";
$result = $mysqli->query($sql);

$bakery = [];
while ($row = $result->fetch_assoc()) {
    $bakery[] = $row;
}
///cookie menu
$sql = "SELECT * FROM product WHERE category_id = 6";
$result = $mysqli->query($sql);

$cookies = [];
while ($row = $result->fetch_assoc()) {
    $cookies[] = $row;
}
///beverage menu
$sql = "SELECT * FROM product WHERE category_id = 1";
$result = $mysqli->query($sql);

$beverages = [];
while ($row = $result->fetch_assoc()) {
    $beverages[] = $row;
}
///savoury menu
$sql = "SELECT * FROM product WHERE category_id = 5";
$result = $mysqli->query($sql);

$savouries = [];
while ($row = $result->fetch_assoc()) {
    $savouries[] = $row;
}
///sweet menu
$sql = "SELECT * FROM product WHERE category_id = 2";
$result = $mysqli->query($sql);

$sweets = [];
while ($row = $result->fetch_assoc()) {
    $sweets[] = $row;
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baker Best</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="favicon.ico">
    <script src="jquery.min.js"></script>
    <script src="html2canvas.js"></script>
</head>

<body class="order">
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
                <a class="current-link">Order Now</a>
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
    <div class="category-button">
        <h2>welcome to Baker Best, enjoy your shopping</h2>
        <p>Please choose the required category</p>
        <button class="btn special" onclick="showProducts(bakery)">Bakery</button>
        <button class="btn" onclick="showProducts(cakes)">Cakes</button>
        <button class="btn" onclick="showProducts(savouries)">Savouries</button>
        <button class="btn" onclick="showProducts(sweets)">Sweets</button>
        <button class="btn" onclick="showProducts(cookies)">Cookies</button>
        <button class="btn" onclick="showProducts(beverages)">Beverages</button>
    </div>
    <div class="cart-container">
        <div class="product-list"></div>
        <div class="cart">
            <img src="Images/logo5.png" alt="logo">
            <h1>Cart Summary</h1>
            <div class="customer-info">
                <form action="order.php" method="POST" id="orderForm">
                    <input type="text" name="name" placeholder="Customer Name" required>
                    <input type="text" name="contact" placeholder="Contact Number" required>
                    <input type="email" name="email" placeholder="Email Address" required>
                    <input type="text" name="address" placeholder="Address" required>
                    <input type="hidden" name="cart_data" id="cart_data">
                </form>
            </div>
            <div class="cart-head">
                <span class="item-name">Item</span>
                <span class="item-price">Price</span>
                <span class="item-quantity">Quantity</span>
                <span class="item-subtotal">Subtotal</span>
                <span class="remove-placeholder"></span>
            </div>
            <div class="cart-items"></div>
            <div class="cart-summary">
                <p>Total: Rs <span id="cart-total">0</span></p>
                <button id="place-order" class="menu-btn"><span>Place Order</span><span>Place Order</span><span>Place
                        Order</span><span>Place Order</span></button>
            </div>
        </div>
    </div>
    <div class="bill" id="bill">
        <?php
        if (
            $_SERVER["REQUEST_METHOD"] === "POST"
            && isset($_POST["name"])
            && isset($_POST["contact"])
            && isset($_POST["email"])
            && isset($_POST["address"])
            && isset($_POST["cart_data"])
        ) {

            $name = htmlspecialchars($_POST["name"]);
            $contact = htmlspecialchars($_POST["contact"]);
            $email = htmlspecialchars($_POST["email"]);
            $address = htmlspecialchars($_POST["address"]);

            // Decode cart JSON
            $cart = json_decode($_POST["cart_data"], true);

            echo "<img src='Images/logo5.png' alt='LOGO'>";
            echo "<h1>Thank you for shopping with us!</h1>";
            echo "<h2>Customer Details</h2>";
            echo "<p><strong>Name:</strong> $name</p>";
            echo "<p><strong>Contact:</strong> $contact</p>";
            echo "<p><strong>Email:</strong> $email</p>";
            echo "<p><strong>Address:</strong> $address</p>";

            if (!empty($cart)) {
                echo "<h2 class='cus-details'>Order Summary</h2>";
                echo "<ul>";
                $total = 0;
                foreach ($cart as $item) {
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                    echo "<li>
                            <span class='item-name'>{$item['product_name']}</span>
                            <span class='item-price'>Rs {$item['price']}</span>
                            <span class='item-quantity'>x {$item['quantity']}</span>
                            <span class='item-subtotal'>Rs {$subtotal}</span>
                        </li>";
                }
                echo "</ul>";
                echo "<p class='bill-total'>Total: Rs $total</p>";
            }
            echo '<button id="download"><img src="Images/download.png" alt="download"></button>';
            echo '<button type="button" onclick="closeBill()">Close</button>';

        } else {
            echo '<!-- No order placed yet -->';
        }
        ?>
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
    <script>
        const cakes = <?php echo json_encode($cakes); ?>;
        const bakery = <?php echo json_encode($bakery); ?>;
        const cookies = <?php echo json_encode($cookies); ?>;
        const sweets = <?php echo json_encode($sweets); ?>;
        const savouries = <?php echo json_encode($savouries); ?>;
        const beverages = <?php echo json_encode($beverages); ?>;


        // =================== Cart ===================
        let cart = [];

        // =================== Show Products ===================
        function showProducts(list) {
            const listDiv = document.querySelector(".product-list");
            listDiv.innerHTML = "";

            list.forEach((item) => {
                const div = document.createElement("div");
                div.className = "product-row";
                div.innerHTML = `
            <img src="${item.img_path}" alt="${item.product_name}" class="product-image">
            <div class="product-info">
                <h4>${item.product_name}</h4>
                <p>Rs. ${item.price}</p>
            </div>
            <div class="product-actions">
                <input type="number" min="1" value="1" class="quantity-input">
                <button class="add-to-cart">+</button>
            </div>
        `;
                listDiv.appendChild(div);

                // Add to cart click event
                div.querySelector(".add-to-cart").addEventListener("click", () => {
                    const qty = parseInt(div.querySelector(".quantity-input").value);
                    addToCart(item, qty);
                });
            });
        }

        // =================== Add to Cart ===================
        function addToCart(product, quantity) {
            const existing = cart.find(p => p.product_name === product.product_name);
            if (existing) {
                existing.quantity += quantity;
            } else {
                cart.push({ ...product, quantity });
            }
            updateCart();
        }

        // =================== Update Cart ===================
        function updateCart() {
            const cartDiv = document.querySelector(".cart-items");
            cartDiv.innerHTML = "";

            let total = 0;

            cart.forEach((item, idx) => {
                const subtotal = item.price * item.quantity;
                const itemDiv = document.createElement("div");
                itemDiv.className = "cart-item";
                itemDiv.innerHTML = `
            <span class="item-name">${item.product_name}</span>
            <span class="item-price">Rs ${item.price}</span>
            <span class="item-quantity">Qty: ${item.quantity}</span>
            <span class="item-subtotal">Subtotal: Rs ${subtotal}</span>
            <button class="remove-btn">Remove</button>
        `;
                cartDiv.appendChild(itemDiv);

                total += subtotal;

                // Remove item from cart
                itemDiv.querySelector(".remove-btn").addEventListener("click", () => {
                    cart.splice(idx, 1);
                    updateCart();
                });
            });

            document.getElementById("cart-total").innerText = total;
        }
        const placeOrderBtn = document.getElementById("place-order");

        placeOrderBtn.addEventListener("click", () => {
            orderForm.requestSubmit(); // triggers the form submit
        });


        // =================== Place Order ===================


        const orderForm = document.getElementById("orderForm");

        orderForm.addEventListener("submit", (e) => {
            // Check HTML form validity first
            if (!orderForm.checkValidity()) {
                // Let browser show native alerts for required fields
                return; // don't prevent default
            }

            // Now check cart
            if (cart.length === 0) {
                e.preventDefault(); // prevent form submission
                alert("Please add at least one product to cart.");
                return;
            }

            // Put cart as JSON string into hidden input
            document.getElementById("cart_data").value = JSON.stringify(cart);
        });




        // =================== Default load ===================
        showProducts(bakery);

        const btnELlist = document.querySelectorAll('.btn');

        btnELlist.forEach(btnEl => {
            btnEl.addEventListener('click', () => {
                const current = document.querySelector('.special');
                if (current) {
                    current.classList.remove('special');
                }
                btnEl.classList.add('special');
            });
        });
        const billDiv = document.getElementById('bill');

        // Function to show the bill popup
        function showBill() {
            billDiv.classList.add('open-popup'); // add class to make it visible
        }

        // Function to close the bill popup
        function closeBill() {
            billDiv.classList.remove('open-popup'); // hide popup
            billDiv.innerHTML = '<!-- No order placed yet -->'; // reset content
            cart = []; // clear cart
            updateCart();
            orderForm.reset(); // clear inputs
            window.location.href = "order.php";
        }


        // Optionally, show the bill automatically if it has content
        if (billDiv.innerHTML.trim() !== "<!-- No order placed yet -->") {
            showBill();
        }

    </script>
</body>

</html>