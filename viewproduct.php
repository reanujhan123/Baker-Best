<?php
session_start();

include 'db.php';


if (isset($_SESSION['login_success']) && $_SESSION['login_success'] === true) {
    echo "<script>alert('Login Successful!');</script>";
    unset($_SESSION['login_success']);
}

$admin_name = "Admin";

if (isset($_SESSION['admin_username'])) {
    $username = $_SESSION['admin_username'];
    $result = $conn->query("SELECT name FROM admin_credentials WHERE username='$username' LIMIT 1");
    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $admin_name = $row['name'];
    }
}

$catResult = $conn->query("SELECT * FROM category ORDER BY category_name ASC");
$categoryId = $_GET['category'] ?? '';

if (!empty($categoryId)) {
    $sql = "SELECT * FROM product WHERE category_id = '$categoryId' ORDER BY product_name ASC";
} else {
    $sql = "SELECT * FROM product ORDER BY category_id ASC";
}
$result = $conn->query($sql);
if (isset($_GET['del_id'])) {
    $del_id = $_GET['del_id'];
    $del_sql = "DELETE FROM product WHERE product_id = '$del_id'";
    $conn->query($del_sql);
    header("Location: viewproduct.php");
}


$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>VIEW PRODUCT</title>
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
        <a class="current-option" href="viewproduct.php">➥ VIEW PRODUCTS</a>
        <a href="addproduct.php">➥ ADD PRODUCT</a>
    </div>
    <div class="viewprod">
        <div class="product-table-container">
            <div class="product-table-wrapper">
                <div class="table-header">
                    <h2>Product Inventory</h2>
                </div>
                <div class="table-scroll">
                    <div class="search">
                        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for products..">
                        <form method="GET" action="viewproduct.php">
                            <select name="category" id="prodcat">
                                <option value="">Select a category</option>
                                <?php while ($cat = $catResult->fetch_assoc()) { ?>
                                    <option value="<?= $cat['category_id']; ?>" <?= (isset($_GET['category']) && $_GET['category'] == $cat['category_id']) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($cat['category_name']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <button type="submit">Filter</button>
                        </form>

                    </div>
                    <table id="myTable">
                        <tr class="heading">
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                        while ($rows = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $rows['product_name'] . ' ' . $rows['unit']; ?></td>
                                <td><?php echo 'Rs ' . $rows['price']; ?></td>
                                <td><?php echo $rows['quantity']; ?></td>
                                <td><img class="product-image" src="<?php echo $rows['img_path']; ?>" alt=""></td>
                                <td><a href="editproduct.php?p_id=<?php echo $rows['product_id']; ?>">Edit</a></td>
                                <td>
                                    <a id="delete" href="javascript:void(0)"
                                        onclick="chkalert(<?php echo $rows['product_id']; ?>)">
                                        <img class="delete-btn" src="Images/trash.svg" style="width:25px;height:25px">
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function chkalert(id) {
            var sts = confirm('Are you sure you want to delete this product?');
            if (sts) {
                document.location.href = 'viewproduct.php?del_id=' + id;
            }
        }
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

    </script>
</body>

</html>