
<?php
header("Content-Type: application/json");

// Decode the input from the client
$data = json_decode(file_get_contents('php://input'), true);

// Sanitize input
function sanitizeInput($data)
{
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

try {
    include '../include/dbConnection.php';

    // Get the start and end dates from POST request
    $startDate = isset($_POST['startDate']) ? sanitizeInput($_POST['startDate']) : null;
    $endDate = isset($_POST['endDate']) ? sanitizeInput($_POST['endDate']) : null;

    // Prepare the SQL query for products and sales information
    // Adjust the SQL to query data between start and end dates
    $productQuery = "
    SELECT 
        product.product_name,
        product.price,
        product.cost,
        IFNULL(SUM(CASE WHEN DATE(transaction.timestamp) BETWEEN '$startDate' AND '$endDate' THEN transaction_item.quantity ELSE 0 END), 0) AS total_qty_sold_between,
        IFNULL(SUM(CASE WHEN DATE(transaction.timestamp) BETWEEN '$startDate' AND '$endDate' THEN transaction_item.quantity * transaction_item.price ELSE 0 END), 0) AS total_sales_between,
        IFNULL(SUM(CASE WHEN DATE(transaction.timestamp) BETWEEN '$startDate' AND '$endDate' THEN transaction_item.quantity * product.cost ELSE 0 END), 0) AS total_cost_between
    FROM
        product
    LEFT JOIN
        transaction_item ON product.product_name = transaction_item.product_name
    LEFT JOIN
        transaction ON transaction.transaction_id = transaction_item.transaction_id
    WHERE
        DATE(transaction.timestamp) BETWEEN '$startDate' AND '$endDate'
    GROUP BY
        product.product_name, product.price, product.cost;
";


    // Execute the product query
    $productResult = $conn->query($productQuery);

    // Prepare the product data to be returned
    $productData = array();
    while ($row = $productResult->fetch_assoc()) {
        // Calculate the total cost as cost * total_qty_sold_between
        $totalCostBetween = $row['total_cost_between']; // Already computed in the query

        $productData[] = array(
            'product_name' => $row['product_name'],
            'price' => $row['price'],
            'cost' => $row['cost'],
            'total_qty_sold_between' => $row['total_qty_sold_between'],
            'total_sales_between' => $row['total_sales_between'],
            'total_cost_between' => $totalCostBetween // Add the total cost data
        );
    }

    // Prepare the SQL query for expenses details
    $expensesQuery = "
SELECT
expenses.expenses,
expenses.category,
expenses.payment,
expenses.date
FROM
expenses
WHERE
DATE(expenses.date) BETWEEN '$startDate' AND '$endDate'
";

    // Execute the expenses query
    $expensesResult = $conn->query($expensesQuery);

    // Prepare the expenses data to be returned
    $expensesData = array();
    while ($row = $expensesResult->fetch_assoc()) {
        $expensesData[] = array(
            'expenses_id' => $row['expenses'],
            'category' => $row['category'],
            'amount' => $row['payment'],
            'payment_date' => $row['date']
        );
    }

    // Combine both product and expenses data
    $response = array(
        'products' => $productData,
        'expenses' => $expensesData
    );

    // Send the response back to the frontend as JSON
    echo json_encode($response);

    // Close the database connection
    $conn->close();
} catch (Exception $e) {
    // Handle any errors and return a JSON response
    echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
}
