<?php
header("Content-Type: application/json");

// Decode JSON input from the client
$data = json_decode(file_get_contents('php://input'), true);


function sanitizeInput($data)
{
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        include '../include/dbConnection.php';
        $data = $_GET;
        // Retrieve and sanitize page and itemsPerPage from the input data
        $page  = sanitizeInput($data['page']);
        $itemsPerPage = sanitizeInput($data['itemsPerPage']);


        // Default to 10 items per page

        // Calculate the offset for pagination
        $offset = ($page - 1) * $itemsPerPage;
        $sql = "SELECT * FROM inventory_action WHERE 1=1";

        $result = $conn->query($sql);
        $totalItems = $result->num_rows;
        $sql .= " LIMIT $offset, $itemsPerPage";
        $result = $conn->query($sql);

        if (!$result) {
            die(json_encode(["status" => "error", "message" => "Invalid query: " . $conn->error]));
        }

        $item = [];

        while ($row = $result->fetch_assoc()) {
            $item[] = $row;
        }
        $conn->close();
        $totalPages = ceil($totalItems / $itemsPerPage);

        echo json_encode([
            "status" => "success",
            "message" => 'success',
            "item" => $item,
            "totalPages" => $totalPages

        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    }
} catch (Exception $e) {
    // Handle any errors and return a JSON response
    echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
}
