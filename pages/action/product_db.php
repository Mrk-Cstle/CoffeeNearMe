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



        // Prepare and bind SQL statement using prepared statement
        $stmt = $conn->prepare("INSERT INTO product (product_name, product_category, price) VALUES (?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param("ssi", $products, $categorys, $prices);

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
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
}
