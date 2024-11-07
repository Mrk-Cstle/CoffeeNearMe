<?php include 'dbConnection.php';

$sql = "
    SELECT 
        COUNT(*) AS total_transactions_today, 
        SUM(total_amount) AS total_sales_today 
    FROM transaction
    WHERE DATE(timestamp) = CURDATE()
";

$result = $conn->query($sql);

// Initialize counts
$total_transactions_today = 0;
$total_sales_today = 0.00;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_transactions_today = $row['total_transactions_today'];
    $total_sales_today = $row['total_sales_today'];
}


$sql2 = "
    SELECT 
        COUNT(*) AS total_ingredients,
        SUM(CASE WHEN quantity < (0.8 * ideal_quantity) THEN 1 ELSE 0 END) AS low_stock_count
    FROM ingredients
";

$result2 = $conn->query($sql2);

// Initialize counts
$total_ingredients = 0;
$low_stock_count = 0;

if ($result2->num_rows > 0) {
    $row = $result2->fetch_assoc();
    $total_ingredients = $row['total_ingredients'];
    $low_stock_count = $row['low_stock_count'];
}


// Close connection
$conn->close();
