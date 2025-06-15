<?php
ini_set('session.gc_maxlifetime', 1200);  
session_set_cookie_params(1200);
session_start();
$cart = $_SESSION['cart'] ?? [];

$response = ['items' => [], 'total' => 0];

foreach ($cart as $id => $item) {
    $subtotal = $item['price'] * $item['quantity'];
    $response['items'][] = [
        'product_id' => $id,  
        'product_name' => $item['name'],
        'quantity' => $item['quantity'],
        'subtotal' => number_format($subtotal, 2)
        
    ];
    $response['total'] += $subtotal;
}
$response['total'] = number_format($response['total'], 2);
header('Content-Type: application/json');
echo json_encode($response);
