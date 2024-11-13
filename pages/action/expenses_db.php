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
        $expenses = sanitizeInput($data['expenses']);
        $categoryadd = sanitizeInput($data['categoryadd']);
        $payment = sanitizeInput($data['payment']);




        // Prepare and bind SQL statement using prepared statement
        $stmt = $conn->prepare("INSERT INTO expenses (expenses, category, payment) VALUES (?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param("ssd", $expenses, $categoryadd, $payment);

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



        $searchQuery = sanitizeInput($data['searchQuery']);
        $page = sanitizeInput($data['page']);
        $itemsPerPage = sanitizeInput($data['itemsPerPage']);
        $startDate = sanitizeInput($data['startDate']);
        $endDate = sanitizeInput($data['endDate']);

        // Calculate the offset for pagination
        $offset = ($page - 1) * $itemsPerPage;
        $sql = "SELECT * FROM expenses WHERE 1=1";


        if (!empty($searchQuery)) {
            $sql .= " AND expenses LIKE '%$searchQuery%'";
        }
        if (!empty($startDate) && !empty($endDate)) {
            $sql .= " AND DATE(date) BETWEEN '$startDate' AND '$endDate'";
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
    } elseif ($action === 'delete') {


        include '../include/dbConnection.php';
        $expenses = sanitizeInput($data['expenses']);



        // Prepare the SQL statement with a placeholder
        $stmt = $conn->prepare("DELETE FROM expenses WHERE expenses_id = ?");


        $stmt->bind_param("i", $expenses);

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
