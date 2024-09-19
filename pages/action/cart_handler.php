<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    // Initialize the cart session if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    switch ($action) {
        case 'add':
            $productId = $_POST['product_id'];
            $productName = $_POST['product_name'];
            $productPrice = $_POST['product_price'];
            $quantity = $_POST['quantity'];

            // Check if product already exists in the cart
            $found = false;
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['id'] == $productId) {
                    $item['quantity'] += $quantity;
                    $found = true;
                    break;
                }
            }

            // If product not found, add a new item
            if (!$found) {
                $_SESSION['cart'][] = [
                    'id' => $productId,
                    'name' => $productName,
                    'price' => $productPrice,
                    'quantity' => $quantity
                ];
            }

            // Send response
            echo json_encode(['status' => 'success', 'cart' => $_SESSION['cart']]);
            break;

        case 'fetch':
            echo json_encode(['status' => 'success', 'cart' => $_SESSION['cart']]);
            break;

            // Additional actions like 'remove' can be added here

        default:
            echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
            break;
    }
}
