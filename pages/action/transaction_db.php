<?php
header("Content-Type: application/json");

// Decode JSON input from the client

$data = $_GET;
$action = $data['action'];
function sanitizeInput($data)
{
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

try {
    if ($action === "reload") {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            include '../include/dbConnection.php';
            $data = $_GET;
            // Retrieve and sanitize page and itemsPerPage from the input data
            $page  = sanitizeInput($data['page']);
            $itemsPerPage = sanitizeInput($data['itemsPerPage']);
            $filter  = sanitizeInput($data['filter']);

            // Default to 10 items per page

            // Calculate the offset for pagination
            $offset = ($page - 1) * $itemsPerPage;
            $whereClause = "1=1"; // Default, selects all records

            switch ($filter) {
                case "Today":
                    $whereClause = "DATE(timestamp) = CURRENT_DATE";
                    break;
                case "Weekly":
                    $whereClause = "WEEK(timestamp) = WEEK(CURRENT_DATE) AND YEAR(timestamp) = YEAR(CURRENT_DATE)";
                    break;
                case "Monthly":
                    $whereClause = "MONTH(timestamp) = MONTH(CURRENT_DATE) AND YEAR(timestamp) = YEAR(CURRENT_DATE)";
                    break;
                case "All":
                default:
                    // No additional conditions, so the default is "all" transactions
                    break;
            }

            $sql = "SELECT * FROM transaction WHERE $whereClause ORDER BY transaction_id DESC";

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
    } elseif ($action === "transaction_item") {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $transaction_id   = sanitizeInput($data['transaction_id']);
            include '../include/dbConnection.php';

            $stmt = $conn->prepare("
    SELECT 
        t.transaction_id, 
        t.user, 
        t.total_amount, 
        t.timestamp,
        ti.product_name, 
        ti.quantity, 
        ti.price 
    FROM 
        transaction t
    JOIN 
        transaction_item ti ON t.transaction_id = ti.transaction_id 
    WHERE 
        t.transaction_id = ?
");
            $stmt->bind_param("i", $transaction_id); // 'i' denotes the variable type is integer

            // Execute the statement
            $stmt->execute();

            // Get the result
            $result = $stmt->get_result();

            // Initialize an array to hold the data
            $data = [];

            // Check if there are results
            if ($result->num_rows > 0) {
                // Fetch all results into the array
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                // Return the response as JSON
                echo json_encode(['status' => 'success', 'transaction' => $data]);
            } else {
                // No results found
                echo json_encode(['status' => 'error', 'message' => 'No results found.']);
            }

            // Close connections
            $stmt->close();
            $conn->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
        }
    }
} catch (Exception $e) {
    // Handle any errors and return a JSON response
    echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
}
