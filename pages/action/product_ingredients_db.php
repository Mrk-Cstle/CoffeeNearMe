<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents('php://input'), true);
$action = isset($data['action']) ? $data['action'] : '';

function sanitizeInput($data)
{
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}


if ($action === "add") {

    include '../include/dbConnection.php';
    $ingredients = sanitizeInput($data['ingredients']);
    $qty = sanitizeInput($data['qty']);
    $productId = sanitizeInput($data['productId']);

    $stmt = $conn->prepare("INSERT INTO product_ingredients (product_id, ingredients_id, quantity) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssi", $productId, $ingredients, $qty);

    // Execute the statement
    try {
        $stmt->execute();
        echo json_encode(["status" => "success", "message" => "New record created successfully"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
    }
    // Close the statement and connection
    $stmt->close();
    $conn->close();
} elseif ($action === "reload") {

    include '../include/dbConnection.php';


    $productId = sanitizeInput($data['productId']);
    $stmt = $conn->prepare("
        SELECT i.raw_name, pi.quantity , pi.product_raw_id
        FROM product_ingredients pi
        INNER JOIN ingredients i ON pi.ingredients_id = i.ingredients_id
        WHERE pi.product_id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    $ingredients = [];
    while ($row = $result->fetch_assoc()) {
        $ingredients[] = $row;
    }



    echo json_encode([
        "status" => "success",
        "message" => "success",
        "ingredients" => $ingredients

    ]);
} elseif ($action === 'delete') {



    $hiddenValue = sanitizeInput($data['hiddenValue']);


    include '../include/dbConnection.php';




    // Prepare the SQL statement with a placeholder
    $stmt = $conn->prepare("DELETE FROM product_ingredients WHERE product_raw_id = ?");


    $stmt->bind_param("i", $hiddenValue);

    try {
        $stmt->execute();
        if ($stmt->affected_rows > 0) {

            echo json_encode(["status" => "success", "message" => "Record deleted successfully"]);
        } else {

            echo json_encode(["status" => "error", "message" => "No record found to delete"]);
        }
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Error deleting record: " . $stmt->error]);
    }



    $stmt->close();
    $conn->close();
}
