<?php
session_start();

if (isset($_POST['quantities']) && is_array($_POST['quantities']) && count($_POST['quantities']) > 0) {
    $quantities = $_POST['quantities'];
    $items = [];
    $total = 0;
    $updated = 0;

    foreach ($quantities as $id => $qty) {
        $qty = max(1, (int)$qty);
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] = $qty;
            $subtotal = $_SESSION['cart'][$id]['price'] * $qty;
            $items[] = [
                "id" => $id,
                "name" => $_SESSION['cart'][$id]['name'],
                "price" => $_SESSION['cart'][$id]['price'],
                "quantity" => $qty,
                "subtotal" => number_format($subtotal, 2)
            ];
            $total += $subtotal;
            $updated++;
        }
    }

    if ($updated > 0) {
        echo json_encode(["status" => "success", "items" => $items, "total" => number_format($total, 2)]);
    } else {
        echo json_encode(["status" => "success", "empty" => true, "items" => [], "total" => "0.00"]);
    }
} else {
    echo json_encode(["status" => "success", "empty" => true, "items" => [], "total" => "0.00"]);
}
?>

