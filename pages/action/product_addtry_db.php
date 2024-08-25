<?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include '../include/dbConnection.php';

    // Check connection
    if ($conn->connect_error) {
        die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
    }

    // Function to sanitize input data
    function sanitizeInput($data)
    {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }

    header("Content-Type: application/json");
    $data = json_decode(file_get_contents('php://input'), true);



    // Extract and sanitize data
    $products = sanitizeInput($data['product']);
    $categorys = sanitizeInput($data['category']);
    $prices = sanitizeInput($data['price']);
    $pictures = sanitizeInput($data['picture']);


    // Prepare and bind SQL statement using prepared statement
    $stmt = $conn->prepare("INSERT INTO product (product_name, product_category, price, picture) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssis", $products, $categorys, $prices, $pictures);

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
}
