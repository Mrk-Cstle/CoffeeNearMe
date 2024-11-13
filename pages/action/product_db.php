<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents('php://input'), true);
$action = isset($data['action']) ? $data['action'] : '';

function sanitizeInput($data)
{
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}


try {

    if ($action === "add") {

        include '../include/dbConnection.php';

        // Check connection
        if ($conn->connect_error) {
            die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
        }

        // Function to sanitize input data






        // Extract and sanitize data
        $products = sanitizeInput($data['productName']);
        $categorys = sanitizeInput($data['productCategory']);
        $prices = sanitizeInput($data['productPrice']);
        $costadd = sanitizeInput($data['costadd']);
        $margin = $prices - $costadd;



        // Prepare and bind SQL statement using prepared statement
        $stmt = $conn->prepare("INSERT INTO product (product_name, product_category, price,cost,margin) VALUES (?, ?, ?,?,?)");
        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param("ssddd", $products, $categorys, $prices, $costadd, $margin);

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


        $category = sanitizeInput($data['categoryFilter']);
        $searchQuery = sanitizeInput($data['searchQuery']);
        $page  = sanitizeInput($data['page']);
        $itemsPerPage = sanitizeInput($data['itemsPerPage']);
        // Calculate the offset for the query 

        $offset = ($page - 1) * $itemsPerPage;
        $sql = "SELECT * FROM product WHERE 1=1";



        if (!empty($category)) {
            $sql .= " AND product_category = '$category'";
        }
        if (!empty($searchQuery)) {
            $sql .= " AND product_name LIKE '%$searchQuery%'";
        }


        $result = $conn->query($sql);
        $totalItems = $result->num_rows;

        $sql .= " LIMIT $offset, $itemsPerPage";
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

        $totalPages = ceil($totalItems / $itemsPerPage);

        echo json_encode([
            "status" => "success",
            "message" => "success",
            "product" => $product,
            "totalPages" => $totalPages
        ]);
    } elseif ($action === "editmodal") {
        include '../include/dbConnection.php';


        $productid = sanitizeInput($data['productsid']);
        $sql = "SELECT * FROM product WHERE product_id = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $productid);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                echo json_encode(['status' => 'success', 'data' => $user, 'modalview' => 'modalview']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'User not found']);
            }
        }
    } elseif ($action === "edit") {
        include '../include/dbConnection.php';
        $productId = sanitizeInput($data['productId']);
        $productName = sanitizeInput($data['productName']);
        $productCategory = sanitizeInput($data['productCategory']);
        $productPrice = sanitizeInput($data['productPrice']);
        $productCost = sanitizeInput($data['productCost']);




        // Prepare query to fetch existing data
        $select_sql = "SELECT * FROM product WHERE product_id = ?";
        $select_stmt = $conn->prepare($select_sql);
        $select_stmt->bind_param("i", $productId);
        $select_stmt->execute();

        $result = $select_stmt->get_result();
        $row = $result->fetch_assoc();

        // Check if any data has been fetched
        if ($row) {
            // Extract specific columns from the result set
            $db_product_name = $row['product_name'];
            $db_category = $row['product_category'];
            $db_price = $row['price'];
            $db_cost = $row['cost'];
            $db_picture = $row['picture'];
        }


        if ($db_product_name == $productName && $db_category == $productCategory && $db_price == $productPrice && $db_cost == $productCost) {
            // No changes, so skip the update
            echo json_encode(["status" => "error", "message" => "No changes to update."]);
        } else {
            // Prepare update query

            $sql = "UPDATE product SET 
            product_name = ? ,product_category = ? ,price = ?,cost=?
 
            WHERE product_id = $productId";

            $stmt = $conn->prepare($sql);

            // Bind parameters to statement
            $stmt->bind_param("ssdd", $productName, $productCategory, $productPrice, $productCost);

            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "New record created successfully"]);
            } else {
                echo "Error updating record: " . $stmt->error;
            }
            $stmt->close();
            $conn->close();
        }
    } elseif ($action === 'delete') {



        $productId = sanitizeInput($data['productId']);


        include '../include/dbConnection.php';

        $sql = "SELECT picture FROM product WHERE product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $productId);
        $stmt->execute();
        $stmt->bind_result($fileName);
        $stmt->fetch();
        $stmt->close();
        if ($fileName) {
            // Construct the full path to the image file
            $uploadDir = '../uploads/product/';
            $filePath = $uploadDir . $fileName;

            // Check if the file exists and delete it
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Prepare the SQL statement with a placeholder
        $stmt = $conn->prepare("DELETE FROM product WHERE product_id = ?");


        $stmt->bind_param("i", $productId);

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
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
}
