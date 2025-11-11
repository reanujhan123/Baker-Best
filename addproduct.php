
<?php
session_start();

include 'db.php';

$admin_name = "Admin";

if (isset($_SESSION['admin_username'])) {
    $username = $_SESSION['admin_username'];
    $result = $conn->query("SELECT name FROM admin_credentials WHERE username='$username' LIMIT 1");
    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $admin_name = $row['name'];
    }
}

$show_success_popup = false; // Flag to control popup display

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = mysqli_real_escape_string($conn, $_POST['prodname']);
    $price = (float) $_POST['price'];
    $quantity = (int) $_POST['quantity'];
    $unit = $_POST['unit'];
    $category = (int) $_POST['category'];

    $file_name = $_FILES['path']['name'];
    $tempname = $_FILES['path']['tmp_name'];
    $folder =  $file_name;

    // File upload & DB insert logic here
    if (move_uploaded_file($tempname, $folder)) {
        // Insert data into database
        $sql = "INSERT INTO product (product_name, price, quantity, unit, category_id, img_path)
VALUES ('$product_name', '$price', '$quantity', '$unit', '$category', '$file_name')";

        if ($conn->query($sql) === TRUE) {
            $show_success_popup = true;
        } else {
            echo "
<script>alert('Database error occurred!');</script>";
        }
    } else {
        echo "
<script>alert('File upload failed!');</script>";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ADD PRODUCT</title>
    <link rel="stylesheet" href="style.css">

</head>

<body class="adminpage">
    <div class="logo">
        <img src="Images/logo5.png" alt="">
    </div>
    <div class="website"><a href="index.html">Customer View</a></div>
    <div class="profile">
        <iframe src="https://free.timeanddate.com/clock/ia47cn2i/n2459/tllk/fn13/tcdb9f55/tt0/tw0/tb4" frameborder="0"
            width="125" height="34"></iframe>

        <a href="">
            <img src="Images/mail.svg" alt="">
            <span class="badge">3</span>
        </a>
        <a href="">
            <img src="Images/alert.svg" alt="">
            <span class="badge">1</span>
        </a>
        <a href="">
            <img class="profile-img" src="Images/profile.png" alt="">
        </a>
        <p><?php echo htmlspecialchars($admin_name); ?></p>
        <a href="logout.php" class="logout-btn">Logout</a>

    </div>
    <div class="nav-menu">
        <a href="viewproduct.php">➥ VIEW PRODUCTS</a>
        <a class="current-option" href="addproduct.php">➥ ADD PRODUCT</a>
    </div>
   <div class="addprod">
        <form id="addProductForm" method="POST" action="addproduct.php" enctype="multipart/form-data">
            <div class="form-header">
                <h2>Add Product</h2>
            </div>
            <label for="prodname">Product name:</label><br>
            <input type="text" id="prodname" name="prodname" placeholder="Enter product name" required><br>

            <label for="price">Price:</label><br>
            <input type="number" id="price" name="price" placeholder="Enter product price" step="0.01" required><br>

            <label for="quantity">Quantity:</label><br>
            <input type="number" id="quantity" name="quantity" placeholder="Enter product quantity" required><br>

            <label for="unit">Unit:</label><br>
            <input type="text" id="unit" name="unit" placeholder="Enter unit, for i.e. 500ml or 1kg"><br>

            <label for="category">Choose Category:</label><br>
            <select id="category" name="category" required>
                <option value="" disabled selected>Select any</option>
                <option value="2">Sweets</option>
                <option value="5">Savouries</option>
                <option value="4">Bakery</option>
                <option value="3">Cakes</option>
                <option value="6">Cookies</option>
                <option value="1">Beverages</option>
            </select><br>

            <label for="path">Image path:</label><br>
            <input type="file" id="path" name="path" accept="image/*" required><br><br>

            <button type="submit">Submit</button>
        </form>

        <div class="popup" id="popup">
            <img src="Images/tick.jpg" alt="Success">
            <h2>Product Added Successfully!</h2>
            <button type="button" onclick="closePopup()">OK</button>
        </div>
    </div>
    <script>
        const form = document.getElementById('addProductForm');
        const popup = document.getElementById('popup');
        /*
    form.addEventListener('submit', (e) => {
        e.preventDefault(); // prevent page refresh
        popup.classList.add('open-popup'); // show popup
    });*/

        function closePopup() {
            popup.classList.remove('open-popup'); // hide popup
            form.reset(); // clear form inputs
        }
    </script>
    <?php if ($show_success_popup): ?>
        <script>
            document.getElementById('popup').classList.add('open-popup');
        </script>
    <?php endif; ?>

</body>

</html>