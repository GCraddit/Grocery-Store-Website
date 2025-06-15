<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_SESSION['cart'])) {
        header("Location: cart.php");
        exit;
    }

    $name = $_POST['name'] ?? '';
    $street = $_POST['address'] ?? '';
    $state = $_POST['state'] ?? '';
    $mobile = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';

    $address = $street . ', ' . $state;

    if (!$name || !$address || !$mobile || !$email) {
        $_SESSION['form_error'] = "All fields are required!";
        header("Location: delivery.php");
        exit;
    }

    $unavailable = [];

    foreach ($_SESSION['cart'] as $id => $item) {
        $stmt = $conn->prepare("SELECT in_stock, product_name FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $unavailable[] = "Product ID $id does not exist.";
            continue;
        }

        $row = $result->fetch_assoc();
        if ($row['in_stock'] < $item['quantity']) {
            $unavailable[] = "{$row['product_name']} is out of stock or insufficient (Available: {$row['in_stock']}, You want: {$item['quantity']})";
        }
    }

    if (!empty($unavailable)) {
        $_SESSION['order_error'] = $unavailable;
        header("Location: cart.php");
        exit;
    }

    $_SESSION['delivery'] = [
        "name" => $name,
        "address" => $address,
        "phone" => $mobile,
        "email" => $email
    ];

    header("Location: payment.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delivery Details</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include("header.php"); ?>

<div class="container">
    <h2 class="delivery-title">Delivery and Contact Information</h2>


    <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!$name || !$street || !$city || !$state || !$mobile || !$email) {
                $_SESSION['form_error'] = "All fields are required!";
                header("Location: delivery.php");
                exit;
            }
        }
    ?>


    <form class="delivery-form" action="delivery.php" method="POST">
        <label for="name">Recipient Name:</label>
        <input type="text" name="name" required>
    
        <label for="street">Street Address:</label>
        <input type="text" name="street" required>
        <label for="city">City/Suburb:</label>
        <input type="text" name="city" required>

        <label for="state">State/Territory:</label>
        <select name="state" required>
            <option value="">-- Select a State --</option>
            <option value="NSW">New South Wales (NSW)</option>
            <option value="VIC">Victoria (VIC)</option>
            <option value="QLD">Queensland (QLD)</option>
            <option value="WA">Western Australia (WA)</option>
            <option value="SA">South Australia (SA)</option>
            <option value="TAS">Tasmania (TAS)</option>
            <option value="ACT">Australian Capital Territory (ACT)</option>
            <option value="NT">Northern Territory (NT)</option>
            <option value="Other">Other</option>
        </select>
        
        <label for="phone">Australian Mobile (format: 04XXXXXXXX):</label>
        <input type="tel" name="phone" pattern="^04\d{8}$" required title="Format should be like 0412345678">
    
        <label for="email">Email Address:</label>
        <input type="email" name="email" required>
    
        <button type="submit" class="place-order-btn">Place Order</button>
    </form>
</div>



</body>
</html>
