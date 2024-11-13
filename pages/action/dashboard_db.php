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
            echo json_encode([
                "status" => "success",
                "message" => 'success',
                "ingredients" => $ingredients
            ]);
        } else {
            echo json_encode([
                "status" => "success",
                "message" => "No data available.",
                "ingredients" => []
            ]);
        }

        $conn->close();
    } elseif ($action == 'topproduct') {

        $filter = $data['filter'];
        $whereClause = "";

        switch ($filter) {
            case "Today":
                $whereClause = "DATE(t.timestamp) = CURRENT_DATE";
                break;
            case "Weekly":
                $whereClause = "WEEK(t.timestamp) = WEEK(CURRENT_DATE) AND YEAR(t.timestamp) = YEAR(CURRENT_DATE)";
                break;
            case "Monthly":
                $whereClause = "MONTH(t.timestamp) = MONTH(CURRENT_DATE) AND YEAR(t.timestamp) = YEAR(CURRENT_DATE)";
                break;
            default:
                // Default to this week if no filter is specified
                $whereClause = "DATE(t.timestamp) = CURRENT_DATE";
                break;
        }

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
            $whereClause
        GROUP BY 
            p.product_name, p.price
        ORDER BY 
            sold_quantity DESC
        LIMIT 3;";
        $result = $conn->query($query);
        $top = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $top[] = $row;
            }
            echo json_encode([
                "status" => "success",
                "message" => "Data fetched successfully.",
                "top" => $top
            ]);
        } else {
            // No data case
            echo json_encode([
                "status" => "success",
                "message" => "No data available.",
                "top" => []
            ]);
        }
        $conn->close();
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
}
