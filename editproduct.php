<?php

include 'db.php';

$pid = $_GET['p_id'];
$sql = "select * from product where product_id='$pid'";
$result = $conn->query($sql);

$data = $result->fetch_assoc();
$admin_name = "Admin";

if (isset($_SESSION['admin_username'])) {
    $username = $_SESSION['admin_username'];
    $result = $conn->query("SELECT name FROM admin_credentials WHERE username='$username' LIMIT 1");
    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $admin_name = $row['name'];
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>EDIT PRODUCT</title>
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
        <form action="updateproduct.php" method="POST" enctype="multipart/form-data">
            <div class="form-header">
                <h2>Edit Product</h2>
            </div>
            <label>Product Name :</label><br>
            <input type="text" name="product_name" value="<?php echo $data['product_name']; ?>">
            <br>

            <label>Price :</label><br>
            <input type="number" name="price" value="<?php echo $data['price']; ?>">
            <br>

            <label>Quantity :</label><br>
            <input type="number" name="quantity" value="<?php echo $data['quantity']; ?>">
            <br>

            <label>Unit :</label><br>
            <input type="text" name="unit" value="<?php echo $data['unit']; ?>">
            <br>

            <label for="category">Choose Category:</label><br>
            <select id="category" name="category_id" required>
                <option value="" disabled>Select any</option>
                <option value="2" <?php if ($data['category_id'] == 2)
                    echo "selected"; ?>>Sweets</option>
                <option value="5" <?php if ($data['category_id'] == 5)
                    echo "selected"; ?>>Savouries</option>
                <option value="4" <?php if ($data['category_id'] == 4)
                    echo "selected"; ?>>Bakery</option>
                <option value="3" <?php if ($data['category_id'] == 3)
                    echo "selected"; ?>>Cakes</option>
                <option value="6" <?php if ($data['category_id'] == 6)
                    echo "selected"; ?>>Cookies</option>
                <option value="1" <?php if ($data['category_id'] == 1)
                    echo "selected"; ?>>Beverages</option>
            </select>
            <br>

            <label>Current Image:</label><br>
            <img src="<?php echo $data['img_path']; ?>" alt="Product Image" width="100"><br>

            <label>Upload New Image:</label><br>
            <input type="file" name="new_image" accept="image/*"><br>

            <input type="hidden" name="old_image" value="<?php echo $data['img_path']; ?>">


            <input type="hidden" name="product_id" value="<?php echo $data['product_id']; ?>">

            <button type="submit">Save changes</button>
            <br><br>
        </form>
    </div>
</body>

</html>