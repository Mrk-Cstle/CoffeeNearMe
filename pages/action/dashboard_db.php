<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents('php://input'), true);
$action = isset($data['action']) ? $data['action'] : '';

include '../include/dbConnection.php';
try {
    if ($action == 'lowstock') {
        $query = "SELECT * FROM ingredients WHERE quantity < (ideal_quantity * 0.8)";
        $result = $conn->query($query);
        $ingredients = [];
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $ingredients[] = $row;
            }
        } else {
            echo "No ingredients with low stock.";
        }
        echo json_encode([
            "status" => "success",
            "message" => 'success',
            "ingredients" => $ingredients
        ]);
        $conn->close();
    } elseif ($action == 'topproduct') {
        $query = "SELECT 
            p.product_name, 
            SUM(ti.quantity) AS sold_quantity, 
            SUM(ti.quantity * p.price) AS total_value
        FROM 
            coffeenearme.product p
        JOIN 
            coffeenearme.transaction_item ti ON p.product_name = ti.product_name
        JOIN 
            coffeenearme.transaction t ON ti.transaction_id = t.transaction_id
        WHERE 
            WEEK(t.timestamp) = WEEK(CURRENT_DATE) 
            AND YEAR(t.timestamp) = YEAR(CURRENT_DATE)
        GROUP BY 
            p.product_name, p.price
        ORDER BY 
            sold_quantity DESC
        LIMIT 5;";
        $result = $conn->query($query);
        $top = [];
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $top[] = $row;
            }
        } else {
            echo "No ingredients with low stock.";
        }
        echo json_encode([
            "status" => "success",
            "message" => 'success',
            "top" => $top
        ]);
        $conn->close();
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
}
