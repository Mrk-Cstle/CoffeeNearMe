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

        // Read all rows from the database
        $sql = "SELECT * FROM ingredients ";
        $result = $conn->query($sql);

        if (!$result) {
            die(json_encode(["status" => "error", "message" => "Invalid query: " . $conn->error]));
        }

        // Read data for each row
        $ingredients = [];

        while ($row = $result->fetch_assoc()) {
            $ingredients[] = $row;
        }
        $conn->close();

        echo json_encode(["status" => "success", "message" => 'success', "ingredients" => $ingredients]);
    } elseif ($action === 'delete') {



        $ingredients_id = sanitizeInput($data['ingredients_id']);


        include '../include/dbConnection.php';



        // Prepare the SQL statement with a placeholder
        $stmt = $conn->prepare("DELETE FROM ingredients WHERE ingredients_id = ?");


        $stmt->bind_param("i", $ingredients_id);

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
    } elseif ($action === 'add') {



        include '../include/dbConnection.php';
        $ingredients = sanitizeInput($data['ingredients']);
        $category = sanitizeInput($data['category']);
        $qty = sanitizeInput($data['qty']);
        $ideal_qty = sanitizeInput($data['ideal_qty']);



        $stmt = $conn->prepare("INSERT INTO ingredients (raw_name,category,quantity,ideal_quantity) VALUES (?,?,?,?)");
        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }
        $stmt->bind_param("ssii", $ingredients, $category, $qty, $ideal_qty);

        try {
            $stmt->execute();
            echo json_encode(["status" => "success", "message" => "New record created successfully"]);
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
}
