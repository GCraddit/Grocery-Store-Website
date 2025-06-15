<div class="container">
  <section class="product-area">
    <div class="product-grid">
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="product-card <?= $row['in_stock'] > 0 ? 'in-stock' : 'out-of-stock' ?>">
          <a href="product.php?id=<?= $row['product_id'] ?>">
            <img src="<?= $row['image_path'] ?>" alt="<?= $row['product_name'] ?>" class="product-img">
          </a>
          <a href="product.php?id=<?= $row['product_id'] ?>">
            <h4 class="product-name"><?= $row['product_name'] ?></h4>
          </a>
          <p class="product-unit">Unit: <?= $row['unit_quantity'] ?></p>
          <p class="product-price">Price: $<?= $row['unit_price'] ?></p>
          <form class="cart-form" method="POST">
            <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
            <input type="hidden" name="product_name" value="<?= $row['product_name'] ?>">
            <input type="hidden" name="unit_price" value="<?= $row['unit_price'] ?>">
            <div class="cart-controls">
              <button type="button" class="decrease-btn">−</button>
              <input type="text" name="quantity" value="1" class="quantity-input" readonly>
              <button type="button" class="increase-btn">+</button>
            </div>
            <button type="submit" class="add-to-cart-btn">Add to Cart</button>
          </form>
        </div>
      <?php endwhile; ?>
    </div>
  </section>
</div>
