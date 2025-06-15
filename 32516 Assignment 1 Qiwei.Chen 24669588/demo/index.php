<?php
include("db.php");
$sql = "SELECT * FROM products ORDER BY category";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>GCStore | Home</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <?php include("header.php"); ?>
  <?php include("categoryview.php"); ?>

  <h2 style="padding: 15px; text-align:center">All Products</h2>

<?php include("product_list.php"); ?>  

  <footer class="site-footer">
    <p>&copy; GCStore - All rights reserved</p>
  </footer>
  <script src="js/cart-preview.js"></script>
  <script src="js/category.js"></script>
</body>
</html>
