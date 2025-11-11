<?php

include 'db.php';

if ($_POST) {
    $pid = $_POST['product_id'];
    $prodname = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];
    $catid = $_POST['category_id'];

    $img = $_POST['old_image'];

    if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] == 0) {
        $target_dir = "Images/";
        $filename = $_FILES['new_image']['name'];
        $target_file = $target_dir . $filename;

        move_uploaded_file($_FILES['new_image']['tmp_name'], $target_file);
        $img = $target_file;
    }
}
$sql = "update product set product_name='$prodname',price='$price',quantity='$quantity',unit='$unit',category_id='$catid', img_path='$img' where product_id=$pid;";

if ($conn->query($sql) === true) {
    header("Location: viewproduct.php");
} else {
    echo "error" . $con_error;
}

?>