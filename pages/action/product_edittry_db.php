<?php
// Ensure this PHP script has access to your database connection
include '../include/dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $price = $_POST['price'];
    $picture = $_POST['picture'];


    // Prepare query to fetch existing data
    $select_sql = "SELECT * FROM product WHERE product_id = ?";
    $select_stmt = $conn->prepare($select_sql);
    $select_stmt->bind_param("i", $product_id);
    $select_stmt->execute();

    $result = $select_stmt->get_result();
    $row = $result->fetch_assoc();

    // Check if any data has been fetched
    if ($row) {
        // Extract specific columns from the result set
        $db_product_name = $row['product_name'];
        $db_category = $row['product_category'];
        $db_price = $row['price'];
        $db_picture = $row['picture'];
    }


    if ($db_product_name == $product_name && $db_category == $product_category && $db_price == $price && $picture == $db_picture) {
        // No changes, so skip the update
        echo "No changes to update.";
    } else {
        // Prepare update query

        $sql = "UPDATE product SET 
            product_name = ? ,product_category = ? ,price = ?, picture = ?
 
            WHERE product_id = $product_id";

        $stmt = $conn->prepare($sql);

        // Bind parameters to statement
        $stmt->bind_param("ssis", $product_name, $product_category, $price, $picture);

        if ($stmt->execute()) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    }
}

$conn->close();
