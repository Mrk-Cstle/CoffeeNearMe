<?php
require '../../vendor/autoload.php'; // Load Composer's autoloader

use UnitConverter\UnitConverter;

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    // Initialize the cart session if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    switch ($action) {
        case 'add':
            include '../include/dbConnection.php';
            $userId = $_SESSION['user_id'];
            $productId = $_POST['product_id'];
            $productName = $_POST['product_name'];
            $productPrice = $_POST['product_price'];
            $quantity = $_POST['quantity'];


            $cartQuery = "SELECT * FROM carts WHERE user_id = ? AND product_id = ?";
            $stmt = $conn->prepare($cartQuery);
            $stmt->bind_param("ii", $userId, $productId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // If product exists, update the quantity
                $updateQuery = "UPDATE carts SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?";
                $stmt = $conn->prepare($updateQuery);
                $stmt->bind_param("iii", $quantity, $userId, $productId);
                $stmt->execute();
            } else {
                // If product does not exist, insert a new row
                $insertQuery = "INSERT INTO carts (user_id, product_id, product_name, product_price, quantity) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($insertQuery);
                $stmt->bind_param("iisdi", $userId, $productId, $productName, $productPrice, $quantity);
                $stmt->execute();
            }


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


            $query = "SELECT pi.ingredients_id, pi.quantity AS ingredient_quantity,pi.unit AS ingredient_unit, i.quantity AS available_quantity , i.unit AS available_unit 
                  FROM product_ingredients pi
                  JOIN ingredients i ON pi.ingredients_id = i.ingredients_id
                  WHERE pi.product_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $productId);
            $stmt->execute();
            $result = $stmt->get_result();

            // Update each ingredient's quantity based on the product's required ingredients
            while ($row = $result->fetch_assoc()) {
                $ingredientId = $row['ingredients_id'];
                $ingredientQuantity = $row['ingredient_quantity'];
                $availableQuantity = $row['available_quantity'];
                $ingredientUnit = $row['ingredient_unit'];
                $availableUnit = $row['available_unit'];



                // Create a default unit converter
                $converter = UnitConverter::default();

                if ($ingredientUnit === 'pcs') {



                    $quantityToDeduct = $ingredientQuantity * $quantity;
                    $newQuantity = $availableQuantity - $quantityToDeduct;
                } else {
                    $todeduct = $converter->convert($ingredientQuantity, 10)->from($ingredientUnit)->to($availableUnit);


                    $quantityToDeduct = $todeduct * $quantity;
                    $newQuantity = $availableQuantity - $quantityToDeduct;
                }





                // Update the ingredient's stock
                $updateQuery = "UPDATE ingredients SET quantity = ? WHERE ingredients_id = ?";
                $updateStmt = $conn->prepare($updateQuery);
                $updateStmt->bind_param("di", $newQuantity, $ingredientId);
                $updateStmt->execute();
            }
            echo json_encode(['status' => 'success',  'cart' => $_SESSION['cart']]);
            break;

        case 'fetch':
            // Fetch the cart from session
            $userId = $_SESSION['user_id'];
            include '../include/dbConnection.php';

            // Initialize the session cart if not already done
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Fetch cart items from the database
            $cartQuery = "SELECT * FROM carts WHERE user_id = ?";
            $stmt = $conn->prepare($cartQuery);
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $cartItems = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            // Loop through the retrieved cart items
            foreach ($cartItems as $item) {
                // Check if the item already exists in the session cart
                $exists = false;
                foreach ($_SESSION['cart'] as $sessionItem) {
                    if ($sessionItem['id'] == $item['product_id']) {
                        $exists = true;
                        break;
                    }
                }
                // If the item does not exist, add it to the session cart
                if (!$exists) {
                    $_SESSION['cart'][] = [
                        'id' => $item['product_id'],
                        'name' => $item['product_name'],
                        'price' => $item['product_price'],
                        'quantity' => $item['quantity']
                    ];
                }
            }

            // Optional: Close the statement
            $stmt->close();

            echo json_encode(['status' => 'success', 'cart' => $_SESSION['cart']]);
            break;


        case 'remove':
            include '../include/dbConnection.php';

            $product_id = $_POST['product_id'];
            $quantity = intval($_POST['quantity']);

            // Increase the stock back when deleting an item from the cart
            $query = "SELECT pi.ingredients_id, pi.quantity AS ingredient_quantity,pi.unit AS ingredient_unit, i.quantity AS available_quantity , i.unit AS available_unit 
              FROM product_ingredients pi
              JOIN ingredients i ON pi.ingredients_id = i.ingredients_id
              WHERE pi.product_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $result = $stmt->get_result();

            // Update each ingredient's quantity based on the product's required ingredients
            while ($row = $result->fetch_assoc()) {
                $ingredientId = $row['ingredients_id'];
                $ingredientQuantity = $row['ingredient_quantity'];
                $availableQuantity = $row['available_quantity'];
                $ingredientUnit = $row['ingredient_unit'];
                $availableUnit = $row['available_unit'];


                $converter = UnitConverter::default();


                if ($ingredientUnit == 'pcs') {
                    $todeduct = $ingredientQuantity;
                } else {
                    $todeduct = $converter->convert($ingredientQuantity, 10)->from($ingredientUnit)->to($availableUnit);
                }






                // Calculate the total quantity to be added back based on the number of products removed
                $quantityToAdd = $todeduct * $quantity;
                $newQuantity = $availableQuantity + $quantityToAdd;

                // Update the ingredient's stock
                $updateQuery = "UPDATE ingredients SET quantity = ? WHERE ingredients_id = ?";
                $updateStmt = $conn->prepare($updateQuery);
                $updateStmt->bind_param("ii", $newQuantity, $ingredientId);

                if (!$updateStmt->execute()) {
                    echo json_encode(['status' => 'error', 'message' => $updateStmt->error]);
                    exit;
                }
                $updateStmt->close(); // Close update statement
            }
            $stmt->close(); // Close select statement

            // Remove the item from the cart session
            foreach ($_SESSION['cart'] as $index => $item) {
                if ($item['id'] == $product_id) {
                    unset($_SESSION['cart'][$index]);
                    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array
                    break;
                }
            }

            $userId = $_SESSION['user_id'];
            $deleteQuery = "DELETE FROM carts WHERE user_id = ? AND product_id = ?";
            $stmt = $conn->prepare($deleteQuery);
            $stmt->bind_param("ii", $userId, $product_id);

            if (!$stmt->execute()) {
                echo json_encode(['status' => 'error', 'message' => $stmt->error]);
                exit;
            }

            $stmt->close(); // Close delete statement

            echo json_encode(['status' => 'success', 'cart' => $_SESSION['cart']]);
            break;


        case 'pay':
            include '../include/dbConnection.php';
            // After payment, process the order and clear the cart
            $userId = $_SESSION['user_id'];

            if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                echo json_encode(['status' => 'error', 'message' => 'Cart is empty!']);
                exit;
            }

            $cart = $_SESSION['cart'];
            $username = $_SESSION['user_name'];
            $total = $_POST['total'];

            $query = "INSERT INTO transaction (user, total_amount) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sd", $username, $total);
            $stmt->execute();
            $transactionId = $stmt->insert_id; // Get the ID of the newly created transaction

            $items = []; // Array to hold cart items for response

            // Step 2: Save each cart item into transaction_items table
            foreach ($cart as $item) {
                $productId = $item['name'];
                $quantity = $item['quantity'];
                $price = $item['price'];

                // Insert into the transaction_items table
                $itemQuery = "INSERT INTO transaction_item (transaction_id, product_name, quantity, price) VALUES (?, ?, ?, ?)";
                $itemStmt = $conn->prepare($itemQuery);
                $itemStmt->bind_param("isid", $transactionId, $productId, $quantity, $price);
                $itemStmt->execute();

                // Add item to the response items array
                $items[] = [
                    'name' => $productId,
                    'quantity' => $quantity,
                    'price' => $price,
                    'total' => number_format($price * $quantity, 2)
                ];
            }

            // After successful payment, delete the cart items
            $clearCartQuery = "DELETE FROM carts WHERE user_id = ?";
            $stmt = $conn->prepare($clearCartQuery);
            $stmt->bind_param("i", $userId);

            try {
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    $_SESSION['cart'] = [];
                    echo json_encode([
                        "status" => "success",
                        "message" => "Payment Successful",
                        "items" => $items // Include the items in the response
                    ]);
                } else {
                    echo json_encode(["status" => "error", "message" => "Error clearing cart: " . $stmt->error]);
                }
            } catch (Exception $e) {
                echo json_encode(["status" => "error", "message" => "Error deleting record: " . $e->getMessage()]);
            }

            break;
        default:
            echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
            break;
    }
}
