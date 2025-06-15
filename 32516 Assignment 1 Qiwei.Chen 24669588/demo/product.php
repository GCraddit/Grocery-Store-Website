<?php
include("db.php");
$product_id = $_GET['id'] ?? null;

if (!$product_id) {
    echo "Invalid Product ID.";
    exit;
}

$stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Product not found.";
    exit;
}

$product = $result->fetch_assoc();
$keywords = $product['keywords'];
$category = explode(">", $product['category'])[0]; 

$like = '%' . explode(" ", $keywords)[0] . '%';

$stmt_related = $conn->prepare("
    SELECT * FROM products 
    WHERE product_id != ? 
      AND (keywords LIKE ? OR category LIKE ?) 
    LIMIT 4
");
$stmt_related->bind_param("iss", $product['product_id'], $like, $category);
$stmt_related->execute();
$result_related = $stmt_related->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($product['product_name']) ?> - GCStore</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/product.css">
</head>
<body>

<?php include("header.php"); ?>
<?php include("categoryview.php"); ?>

<div class="container">
  <div class="product-detail">
    <div class="product-image">
      <img src="<?= $product['image_path'] ?>" alt="<?= $product['product_name'] ?>">
    </div>
    <div class="product-info">
      <h2><?= $product['product_name'] ?></h2>
      <p class="price">$<?= number_format($product['unit_price'], 2) ?></p>
      <p class="unit">Unit: <?= $product['unit_quantity'] ?></p>
      <p class="category">Category: <?= $product['category'] ?></p>
      <p class="keywords">Tags: <?= $product['keywords'] ?></p>

      <form class="cart-form" method="POST">
        <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
        <input type="hidden" name="product_name" value="<?= $product['product_name'] ?>">
        <input type="hidden" name="unit_price" value="<?= $product['unit_price'] ?>">

        <div class="cart-controls">
          <button type="button" class="decrease-btn">−</button>
          <input type="text" name="quantity" value="1" class="quantity-input" readonly>
          <button type="button" class="increase-btn">+</button>
        </div>

        <button type="submit" class="add-to-cart-btn">Add to Cart</button>
      </form>
      
    </div>

  <h3 style="padding: 20px 50px;">You may also like</h3>

    <div class="related-products">
      <?php while ($item = $result_related->fetch_assoc()): ?>
        <a href="product.php?id=<?= $item['product_id'] ?>" class="related-card">
          <img src="<?= $item['image_path'] ?>" alt="<?= $item['product_name'] ?>">
          <h4><?= $item['product_name'] ?></h4>
          <p>$<?= number_format($item['unit_price'], 2) ?></p>
        </a>
      <?php endwhile; ?>
    </div>
  </div>
</div>

<script src="js/cart-preview.js"></script>
<script src="js/category.js"></script>

</body>
</html>
