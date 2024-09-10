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

        $sql = "SELECT * FROM product_category";
        $result = $conn->query($sql);

        if (!$result) {
            die(json_encode(["status" => "error", "message" => "Invalid query: " . $conn->error]));
        }

        // Fetch categories into an array
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }

        // Close database connection
        $conn->close();

        // Return categories as JSON response
        echo json_encode(["status" => "success", "message" => 'success', "categories" => $categories]);
    } elseif ($action === "delete") {


        $categoryId = sanitizeInput($data['categoryId']);


        include '../include/dbConnection.php';



        // Prepare the SQL statement with a placeholder
        $stmt = $conn->prepare("DELETE FROM product_category WHERE category_id = ?");


        $stmt->bind_param("i", $categoryId);

        try {
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                // Return success JSON response if deletion was successful
                echo json_encode(["status" => "success", "message" => "Category deleted successfully"]);
            } else {
                // Return error JSON response if no rows were affected
                echo json_encode(["status" => "error", "message" => "No category found to delete"]);
            }
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => "Error deleting category: " . $stmt->error]);
        }



        $stmt->close();
        $conn->close();
    } elseif ($action === "add") {
        include '../include/dbConnection.php';

        $category = sanitizeInput($data['category']);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        $stmt = $conn->prepare("INSERT INTO product_category (category) VALUES (?)");
        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }
        $stmt->bind_param("s", $category);

        try {
            $stmt->execute();
            echo json_encode(["status" => "success", "message" => "New record created successfully"]);
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
}
