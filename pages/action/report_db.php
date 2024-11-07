<?php
header("Content-Type: application/json");

// Decode JSON input from the client
$data = json_decode(file_get_contents('php://input'), true);


function sanitizeInput($data)
{
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

try {

    include '../include/dbConnection.php';
    $date = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d');

    // Prepare the SQL query
    $query = "
    SELECT 
        product.product_name,
        product.price,
        IFNULL(SUM(CASE WHEN DATE(transaction.timestamp) = '$date' THEN transaction_item.quantity ELSE 0 END), 0) AS total_qty_sold_today,
        IFNULL(SUM(CASE WHEN DATE(transaction.timestamp) = '$date' THEN transaction_item.quantity * transaction_item.price ELSE 0 END), 0) AS total_sales_today
    FROM 
        product
    LEFT JOIN 
        transaction_item ON product.product_name = transaction_item.product_name
    LEFT JOIN 
        transaction ON transaction.transaction_id = transaction_item.transaction_id
    GROUP BY 
        product.product_name, product.price;
";

    // Execute the query
    $result = $conn->query($query);

    // Prepare the data to be returned
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            'product_name' => $row['product_name'],
            'price' => $row['price'],
            'total_qty_sold_today' => $row['total_qty_sold_today'],
            'total_sales_today' => $row['total_sales_today']
        );
    }

    // Send the response back to the frontend as JSON
    header('Content-Type: application/json');
    echo json_encode($data);

    // Close the database connection
    $conn->close();
} catch (Exception $e) {
    // Handle any errors and return a JSON response
    echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
}
