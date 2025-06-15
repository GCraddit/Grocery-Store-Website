<?php
ob_clean(); 
header('Content-Type: application/json; charset=utf-8');
session_set_cookie_params(1200);
session_start();

$product_id = $_POST['product_id'] ?? null;
$product_name = $_POST['product_name'] ?? '';
$unit_price = $_POST['unit_price'] ?? 0;
$quantity = intval($_POST['quantity'] ?? 1); //intval mean Force conversion to integer

if (!$product_id || $quantity < 1) {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid product or quantity."
    ]);
    exit;
}

//isset Whether the variable has been defined
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id]['quantity'] += $quantity;
} else {
    $_SESSION['cart'][$product_id] = [
        'name' => $product_name,
        'price' => $unit_price,
        'quantity' => $quantity
    ];
}


$cart = $_SESSION['cart'];
$response = ['status' => 'success', 'items' => [], 'total' => 0];

foreach ($cart as $id => $item) { //The foreach loop function can first define the type of assignment and then assign the value to the parameter in a loop mode.
    $subtotal = $item['price'] * $item['quantity'];
    $response['items'][] = [
        'product_id' => $id, 
        'product_name' => $item['name'],
        'quantity' => $item['quantity'],
        'subtotal' => number_format($subtotal, 2),
        'subtotal_raw' => $subtotal
    ];
    $response['total'] += $subtotal;
}

$response['total'] = number_format($response['total'], 2);
echo json_encode($response);


