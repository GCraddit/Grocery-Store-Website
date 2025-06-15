<?php
session_start();
include("db.php"); 

if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

$name = $_POST['name'] ?? '';
$street = $_POST['street'] ?? '';
$city = $_POST['city'] ?? '';
$state = $_POST['state'] ?? '';
$address = $street . ', ' . $city . ' ' . $state;
$mobile = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';


if (!$name || !$address || !$mobile || !$email) {
  echo " All fields are required.";
  exit;
}

$deliveryInfo = $_SESSION['delivery'] ?? null;
$paymentMethod = $_POST['payment_method'] ?? null;

if (!$deliveryInfo || !$paymentMethod) {
  echo "Missing delivery or payment method.";
  exit;
}

$total = 0;
$itemsHtml = "";

foreach ($_SESSION['cart'] as $id => $item) {
    $lineTotal = $item['price'] * $item['quantity'];
    $total += $lineTotal;

    $stmt = $conn->prepare("UPDATE products SET in_stock = in_stock - ? WHERE product_id = ?");
    $stmt->bind_param("ii", $item['quantity'], $id);
    $stmt->execute();

    $itemsHtml .= "
        <li>
            <span class='item-name'>{$item['name']}</span>
            <span class='item-qty'>x {$item['quantity']}</span>
            <span class='item-subtotal'>= $" . number_format($lineTotal, 2) . "</span>
        </li>";
}
unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Confirmation</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include("header.php"); ?>

<div class="confirmation-container">
  <h2>
    <img src="img/correct_symbol.jpeg" alt="Success" style="width: 50px; vertical-align: middle; margin-right: 8px;">
    Your Order Has Been Placed Successfully!
  </h2>
  <ul class="order-items">
    <?= $itemsHtml ?>
  </ul>
  <div class="order-summary">
    <p>
      <img src="img/shipping_address.png" alt="Location" class="icon-label">
      <strong>Shipping Address:</strong> <?= htmlspecialchars($address) ?>
    </p>
    <p>
      <img src="img/phone_number.png" alt="Phone" class="icon-label">
      <strong>Phone Number:</strong> <?= htmlspecialchars($mobile) ?>
    </p>
    <p>
      <img src="img/email.png" alt="Email" class="icon-label">
      <strong>Email:</strong> <?= htmlspecialchars($email) ?>
    </p>
    <p>
      <img src="img/total_cost.png" alt="Total" class="icon-label">
      <strong>Total:</strong> $<?= number_format($total, 2) ?>
    </p>
  </div>
  <a class="back-btn" href="index.php">Back to Home</a>
</div>

</body>
</html>
