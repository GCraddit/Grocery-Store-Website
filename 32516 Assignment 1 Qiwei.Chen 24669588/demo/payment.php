<?php
session_start();

if (empty($_SESSION['cart']) || empty($_SESSION['delivery'])) {
    header("Location: cart.php");
    exit;
}

$delivery = $_SESSION['delivery']; 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Choose Payment Method</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include("header.php"); ?>

<div class="payment-container">
    <h2>Select Payment Method</h2>
    <form action="process_order.php" method="POST">
        <input type="hidden" name="name" value="<?= htmlspecialchars($delivery['name']) ?>">
        <input type="hidden" name="address" value="<?= htmlspecialchars($delivery['address']) ?>">
        <input type="hidden" name="phone" value="<?= htmlspecialchars($delivery['phone']) ?>">
        <input type="hidden" name="email" value="<?= htmlspecialchars($delivery['email']) ?>">

        <div class="payment-option">
            <label>
                <input type="radio" name="payment_method" value="credit_card" required>
                Credit Card (Demo only)
            </label>
        </div>

        <div class="payment-option">
            <label>
                <input type="radio" name="payment_method" value="paypal">
                PayPal (Demo only)
            </label>
        </div>

        <div class="payment-option">
            <label>
                <input type="radio" name="payment_method" value="cash_on_delivery">
                Cash on Delivery
            </label>
        </div>

        <button type="submit" class="btn payment-btn">Place Order</button>
    </form>
</div>

</body>
</html>
