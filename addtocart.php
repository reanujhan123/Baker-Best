<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bakerbest";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

$sql = " SELECT * FROM product";
$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: #E3E7E8;
            font-family: system-ui;
        }

        .cart-container {

            width: calc(100% - 550px);
            padding: 20px;
        }

        header {
            display: grid;
            grid-template-columns: 1fr 50px;
            margin-top: 50px;
        }

        header .shopping {
            position: relative;
            text-align: right;
        }

        header .shopping img {
            width: 40px;
        }

        header .shopping span {
            background: red;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            position: absolute;
            top: -5px;
            left: 80%;
            padding: 3px 10px;
        }

        .list {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            column-gap: 20px;
            row-gap: 20px;
            margin-top: 50px;
        }

        .list .item {
            text-align: center;
            background-color: #DCE0E1;
            padding: 20px;
            box-shadow: 0 50px 50px #757676;
            letter-spacing: 1px;
        }

        .list .item img {
            width: 90%;
        }

        .list .item .title {
            font-weight: 600;
        }

        .list .item .price {
            margin: 10px;
        }

        .list .item button {
            background-color: #1C1F25;
            color: #fff;
            width: 100%;
            padding: 10px;
        }

        .card {
            position: fixed;
            top: 0;
            right: 0;
            /* stick to right */
            width: 500px;
            height: 100vh;
            background-color: #453E3B;
            overflow-y: auto;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.3);
        }


        .card h1 {
            color: #E8BC0E;
            font-weight: 100;
            margin: 0;
            padding: 0 20px;
            height: 80px;
            display: flex;
            align-items: center;
        }

        .card .checkOut {
            position: absolute;
            bottom: 0;
            width: 100%;
            display: grid;
            grid-template-columns: repeat(2, 1fr);

        }

        .card .checkOut div {
            background-color: #E8BC0E;
            width: 100%;
            height: 70px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            cursor: pointer;
        }

        .card .checkOut div:nth-child(2) {
            background-color: #1C1F25;
            color: #fff;
        }

        .listCard li {
            display: grid;
            grid-template-columns: 100px repeat(3, 1fr);
            color: #fff;
            row-gap: 10px;
        }

        .listCard li div {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .listCard li img {
            width: 90%;
        }

        .listCard li button {
            background-color: #fff5;
            border: none;
        }

        .listCard .count {
            margin: 0 10px;
        }
    </style>


</head>

<body class="">

    <div class="">
        <header>
            <h1>Your Shopping Cart</h1>
            <div class="shopping">
                <img src="image/shopping.svg">
                <span class="quantity">0</span>
            </div>
        </header>

        <div class="list">

        </div>
    </div>
    <div class="card">
        <h1>Card</h1>
        <ul class="listCard">
        </ul>
        <div class="checkOut">
            <div class="total">0</div>
            <div class="closeShopping">Close</div>
        </div>
    </div>
    <script>
        // ==== DOM Elements ====
        const openShopping = document.querySelector('.shopping');
        const closeShopping = document.querySelector('.closeShopping');
        const list = document.querySelector('.list');
        const listCard = document.querySelector('.listCard');
        const body = document.querySelector('body');
        const total = document.querySelector('.total');
        const quantity = document.querySelector('.quantity');

        // Open/Close cart
        openShopping.addEventListener('click', () => body.classList.add('active'));
        closeShopping.addEventListener('click', () => body.classList.remove('active'));

        // ==== Products ====
        const products = [
            <?php
            while ($rows = $result->fetch_assoc()) {
                // Output each product as a JS object
                echo "{ id: " . $rows['product_id'] . ", name: '" . ($rows['product_name']) . "', image: '". ($rows['img_path']) . "', price: " . $rows['price'] . " },";
            }
            ?>
        ];


        // Cart array
        let cart = [];

        // ==== Initialize Products Display ====
        function initApp() {
            products.forEach((product, index) => {
                const newDiv = document.createElement('div');
                newDiv.classList.add('item');
                newDiv.innerHTML = `
                <img src="${product.image}" alt="${product.name}">
                <div class="title">${product.name}</div>
                <div class="price">${product.price.toLocaleString()}</div>
                <button onclick="addToCart(${index})">Add To Cart</button>
            `;
                list.appendChild(newDiv);
            });
        }
        initApp();

        // ==== Add Product to Cart ====
        function addToCart(index) {
            const product = products[index];
            const existing = cart.find(item => item.id === product.id);

            if (existing) {
                existing.quantity += 1;
            } else {
                // create a copy, add quantity property
                cart.push({ ...product, quantity: 1 });
            }
            reloadCart();
        }

        function reloadCart() {
            listCard.innerHTML = '';
            let totalPrice = 0;
            let totalQty = 0;

            cart.forEach((item, index) => {
                const subtotal = item.price * item.quantity;
                totalPrice += subtotal;
                totalQty += item.quantity;

                const li = document.createElement('li');
                li.innerHTML = `
            <div><img src="cake_menu/${item.image}" width="50"/></div>
            <div>${item.name}</div>
            <div>Rs ${subtotal.toLocaleString()}</div>
            <div>
                <button onclick="changeQuantity(${index}, ${item.quantity - 1})">-</button>
                <span class="count">${item.quantity}</span>
                <button onclick="changeQuantity(${index}, ${item.quantity + 1})">+</button>
            </div>
            <button onclick="removeFromCart(${index})">Remove</button>
        `;
                listCard.appendChild(li);
            });

            total.innerText = `Rs ${totalPrice.toLocaleString()}`;
            quantity.innerText = totalQty;
        }

        function changeQuantity(index, qty) {
            if (qty <= 0) cart.splice(index, 1);
            else cart[index].quantity = qty;
            reloadCart();
        }

        function removeFromCart(index) {
            cart.splice(index, 1);
            reloadCart();
        }

    </script>
</body>

</html>