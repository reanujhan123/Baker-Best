<?php
// Database connection
$user = 'root';
$password = '';
$database = 'bakerbest';
$servername = 'localhost';

$mysqli = new mysqli($servername, $user, $password, $database);
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Fetch products ordered by category
$allproductssql = "SELECT * FROM product ORDER BY category_id ASC";
$result = $mysqli->query($allproductssql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery Gallery</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #000814;
            font-family: sans-serif;
        }

        .gallery_wrapper {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 10px;
            padding: 20px;
        }

        .gallery_wrapper img {
            width: 100%;
            aspect-ratio: 1;
            object-fit: cover;
            border-radius: 0.5rem;
            clip-path: polygon(
                50% 0%, 95% 25%, 95% 75%, 50% 100%, 5% 75%, 5% 25%
            ); /* hexagon */
            transition: transform 0.3s, filter 0.3s;
            cursor: pointer;
        }

        .gallery_wrapper img:hover {
            transform: scale(1.1);
            filter: brightness(1.2);
            z-index: 10;
        }

        /* Dim other images when hovering */
        .gallery_wrapper:hover img:not(:hover) {
            filter: brightness(0.5) saturate(0.5);
        }

        /* Optional: responsive adjustments */
        @media (max-width: 768px) {
            .gallery_wrapper {
                grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
            }
        }

        @media (max-width: 480px) {
            .gallery_wrapper {
                grid-template-columns: repeat(auto-fill, minmax(70px, 1fr));
            }
        }
    </style>
</head>
<body>
    <article class="gallery_wrapper">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <img class="product-image" 
                     src="<?php echo $row['img_path']; ?>" 
                     alt="<?php echo htmlspecialchars($row['product_name']); ?>">
                <?php
            }
        } else {
            echo "<p style='color:white;'>No products found.</p>";
        }
        ?>
    </article>
</body>
</html>
