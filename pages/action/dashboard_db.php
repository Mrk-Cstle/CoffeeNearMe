<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents('php://input'), true);
$action = isset($data['action']) ? $data['action'] : '';

include '../include/dbConnection.php';
try {
    if ($action == 'lowstock') {
        $query = "SELECT * FROM ingredients WHERE quantity <= (ideal_quantity * 0.05)";
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
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
}
