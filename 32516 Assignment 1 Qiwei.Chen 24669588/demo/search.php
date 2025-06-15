<?php
include("db.php");

$keyword = $_GET['q'] ?? '';

$sql = "SELECT * FROM products WHERE 
        product_name LIKE ? OR 
        category LIKE ? OR 
        keywords LIKE ?";

$like = '%' . $keyword . '%';
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $like, $like, $like);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Search: <?= htmlspecialchars($keyword) ?></title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include("header.php"); ?>
<?php include("categoryview.php"); ?>

<h2 style="text-align:center; padding: 10px;">Search Results for "<?= htmlspecialchars($keyword) ?>"</h2>

<?php
if ($result->num_rows > 0) {
    include("product_list.php");
} else {
    echo "<div class='container'><p>No products found matching your search.</p></div>";
}
?>
  <script src="js/cart-preview.js"></script>
  <script src="js/category.js"></script>
</body>
</html>

