<?php
include("db.php");

$category = $_GET['type'] ?? 'All';

if ($category === 'All') {
    $sql = "SELECT * FROM products";
    $stmt = $conn->prepare($sql);
} else {
    $sql = "SELECT * FROM products WHERE category LIKE CONCAT(?, '%')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title> Category: <?= htmlspecialchars($category) ?></title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    
    <script src="js/cart-preview.js"></script>
    <script src="js/category.js"></script>

    <body>
    <?php include("header.php"); ?>
    <?php include("categoryview.php"); ?>
        
        <h2 style="padding: 15px;">Category: <?= htmlspecialchars($category) ?></h2>
    <?php include("product_list.php"); ?>  
    </body>

    <?php $conn->close(); ?>

</html>
