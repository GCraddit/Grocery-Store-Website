<?php
ini_set('session.gc_maxlifetime', 1200);  
session_set_cookie_params(1200);
session_start();
$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shopping Cart</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include("header.php"); ?>
<?php include("categoryview.php"); ?>
<!-- delivery.php verify insufficient stock -->
<?php if (!empty($_SESSION['order_error'])): ?>
  <div class="error-box">
    <h4> Unable to Place Order:</h4>
    <ul>
      <?php foreach ($_SESSION['order_error'] as $msg): ?>
        <li><?= htmlspecialchars($msg) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
  <?php unset($_SESSION['order_error']); ?>
<?php endif; ?>


<div class="container">
  <h2>Your Shopping Cart</h2>
  
  <!-- If the shopping cart is empty, notify the user and disable the button -->
  <?php if (empty($cart)): ?>
    <p>Your cart is empty.</p>
    <button class="btn" disabled>Place Order</button>

  <?php else: ?>
    <form id="update-form">
      <table class="cart-table">
        <thead>
          <tr>
            <th>Product</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="cart-body">

          <?php foreach ($cart as $id => $item): 
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
          ?>
          
          <tr data-product-id="<?= $id ?>">
            <td><?= htmlspecialchars($item['name']) ?></td>
            <td>$<?= number_format($item['price'], 2) ?></td>
            <td>
              <input type="number" name="quantities[<?= $id ?>]" value="<?= $item['quantity'] ?>" min="1" max="99" style="width: 60px;">
            </td>
            <td class="subtotal">$<?= number_format($subtotal, 2) ?></td>
            <td class="cart-actions">
              <button type="button" class="btn btn-remove" data-id="<?= $id ?>">Remove</button>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <button type="submit" class="btn">Update Quantities</button>
    </form>

    <p class="cart-total">Total: $<span id="cart-total"><?= number_format($total, 2) ?></span></p>

    <form action="delivery.php" method="POST">
      <button type="submit" class="btn">Place Order</button>
    </form>
  <?php endif; ?>
</div>

<script src="js/cart-page.js"></script>


</body>
</html>
