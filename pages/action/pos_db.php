<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents('php://input'), true);
$action = isset($data['action']) ? $data['action'] : '';

function sanitizeInput($data)
{
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}


try {

    if ($action === "reload") {

        include '../include/dbConnection.php';


        $category = sanitizeInput($data['categoryFilter']);
        $searchQuery = sanitizeInput($data['searchQuery']);




        $sql = "SELECT * FROM product WHERE 1=1";



        if (!empty($category)) {
            $sql .= " AND product_category = '$category'";
        }
        if (!empty($searchQuery)) {
            $sql .= " AND product_name LIKE '%$searchQuery%'";
        }


        $result = $conn->query($sql);

        if (!$result) {
            die(json_encode(["status" => "error", "message" => "Invalid query: " . $conn->error]));
        }

        // Read data for each row
        $product = [];

        while ($row = $result->fetch_assoc()) {
            $product[] = $row;
        }
        $conn->close();


        echo json_encode([
            "status" => "success",
            "message" => "success",
            "product" => $product
        ]);
    } elseif ($action === 'pay') {


        session_start();
        include '../include/dbConnection.php';

        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            echo json_encode(['status' => 'error', 'message' => 'Cart is empty!']);
            exit;
        }

        $cart = $_SESSION['cart'];
        $errors = [];

        // Start transaction to ensure data integrity
        $conn->begin_transaction();

        try {
            // Loop through each product in the cart
            foreach ($cart as $item) {
                $productId = $item['id'];
                $quantity = $item['quantity'];

                // Get ingredients associated with the product from the product_ingredients table
                $query = "SELECT pi.ingredients_id, pi.quantity AS required_quantity, ing.raw_name, p.product_name
                      FROM product_ingredients pi
                      JOIN ingredients ing ON pi.ingredients_id = ing.ingredients_id
                      JOIN product p ON pi.product_id = p.product_id
                      WHERE pi.product_id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('i', $productId);
                $stmt->execute();
                $result = $stmt->get_result();

                // Deduct each ingredient's quantity based on the product's quantity in the cart
                while ($row = $result->fetch_assoc()) {
                    $ingredientId = $row['ingredients_id'];
                    $requiredQuantity = $row['required_quantity'] * $quantity; // Total quantity needed
                    $ingredientName = $row['raw_name'];
                    $productName = $row['product_name'];
                    // Deduct the required quantity from the ingredients table
                    $updateQuery = "UPDATE ingredients 
                                SET quantity = quantity - ? 
                                WHERE ingredients_id = ? AND quantity >= ?";
                    $updateStmt = $conn->prepare($updateQuery);
                    $updateStmt->bind_param('iii', $requiredQuantity, $ingredientId, $requiredQuantity);
                    $updateStmt->execute();

                    // Check if the update was successful (enough stock)
                    if ($updateStmt->affected_rows === 0) {
                        $errors[] = "Insufficient ingredients for Product: $productName (Ingredient: $ingredientName)";
                    }
                }
            }

            // If there were any errors (e.g., insufficient stock), rollback the transaction
            if (!empty($errors)) {
                $conn->rollback();
                echo json_encode(['status' => 'error', 'message' => $errors]);
            } else {
                // Commit the transaction if all deductions were successful
                $conn->commit();
                // Clear the cart
                $_SESSION['cart'] = [];
                echo json_encode(['status' => 'success', 'message' => 'Payment processed successfully!']);
            }
        } catch (Exception $e) {
            $conn->rollback(); // Rollback transaction on any error
            echo json_encode(['status' => 'error', 'message' => 'An error occurred while processing payment.']);
        }

        // Close statements
        $stmt->close();
        $updateStmt->close();
        $conn->close();
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
}
