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
        $page  = sanitizeInput($data['page']);
        $itemsPerPage = sanitizeInput($data['itemsPerPage']);

        // Calculate the offset for the query
        $offset = ($page - 1) * $itemsPerPage;

        $sql = "SELECT * FROM ingredients WHERE 1=1";
        if (!empty($category)) {
            $sql .= " AND category = '$category'";
        }
        if (!empty($searchQuery)) {
            $sql .= " AND raw_name LIKE '%$searchQuery%'";
        }




        $result = $conn->query($sql);
        $totalItems = $result->num_rows;

        $sql .= " LIMIT $offset, $itemsPerPage";
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

        $totalPages = ceil($totalItems / $itemsPerPage);

        echo json_encode([
            "status" => "success",
            "message" => 'success',
            "ingredients" => $ingredients,
            "totalPages" => $totalPages
        ]);
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
    } elseif ($action === 'edit') {

        $ingredients_names = sanitizeInput($data['ingredients_names']);
        $ingredients_qtys = sanitizeInput($data['ingredients_qtys']);
        $ingredients_idealqtys = sanitizeInput($data['ingredients_idealqtys']);
        $ingredients_id = sanitizeInput($data['ingredients_id']);
        $ingredients_categorys = sanitizeInput($data['ingredients_categorys']);


        include '../include/dbConnection.php';

        $select_sql = "SELECT * FROM ingredients WHERE ingredients_id = ?";
        $select_stmt = $conn->prepare($select_sql);
        $select_stmt->bind_param("i", $ingredients_id);
        $select_stmt->execute();

        $result = $select_stmt->get_result();
        $row = $result->fetch_assoc();

        // Check if any data has been fetched
        if ($row) {
            // Extract specific columns from the result set
            $db_raw_name = $row['raw_name'];
            $db_qty = $row['quantity'];
            $db_ideal_qty = $row['ideal_quantity'];
            $db_picture = $row['picture'];
            $db_categorys = $row['category'];
        }


        if ($ingredients_names == $db_raw_name && $ingredients_qtys == $db_qty && $ingredients_idealqtys == $db_ideal_qty && $ingredients_categorys == $db_categorys) {
            // No changes, so skip the update
            echo json_encode(["status" => "error", "message" => "No changes to update. "]);
            echo "";
        } else {
            // Prepare update query

            $sql = "UPDATE ingredients SET 
            raw_name = ? ,quantity = ? ,ideal_quantity = ?, category = ?
 
            WHERE ingredients_id = $ingredients_id";

            $stmt = $conn->prepare($sql);

            // Bind parameters to statement
            $stmt->bind_param("siis", $ingredients_names, $ingredients_qtys, $ingredients_idealqtys, $ingredients_categorys);

            try {
                $stmt->execute();
                echo json_encode([
                    "status" => "success",
                    "message" => "New record created successfully"
                ]);
            } catch (Exception $e) {
                echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
            }
            $stmt->close();
            $conn->close();
        }
    } else {
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
}
