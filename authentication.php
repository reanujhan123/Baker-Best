<?php
session_start(); // must be first

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bakerbest";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = $conn->query("SELECT * FROM admin_credentials WHERE BINARY username='$user' AND BINARY password='$password'");
    $rows = $query->num_rows;

    if ($rows == 1) {
        $_SESSION['admin_username'] = $user;      // store username
        $_SESSION['login_success'] = true;        // flag for alert
        header("Location: viewproduct.php");       // redirect after login
        exit();
    } else {
        echo "<script>
            alert('Invalid Username or Password. Please try again.');
            window.location.href = 'loginform.html';
        </script>";
        exit();
    }
}
?>