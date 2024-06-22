<?php
// Ensure this PHP script has access to your database connection
include '../include/dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $ingredients_id = $_POST['ingredients_id'];
    $raw_name = $_POST['raw_name'];
    $qty = $_POST['qty'];
    $ideal_qty = $_POST['ideal_qty'];
    $picture = $_POST['picture'];


    // Prepare query to fetch existing data
    $select_sql = "SELECT * FROM ingredients WHERE ingredients_id = ?";
    $select_stmt = $conn->prepare($select_sql);
    $select_stmt->bind_param("i", $ingredients_id);
    $select_stmt->execute();

    $result = $select_stmt->get_result();
    $row = $result->fetch_assoc();

    // Check if any data has been fetched
    if ($row) {
        // Extract specific columns from the result set
        $db_raw_name = $row['raw_name'];
        $db_qty = $row['quantity'];
        $db_ideal_qty = $row['ideal_quantity'];
        $db_picture = $row['picture'];
    }


    if ($raw_name == $db_raw_name && $qty == $db_qty && $ideal_qty == $db_ideal_qty && $picture == $db_picture) {
        // No changes, so skip the update
        echo "No changes to update.";
    } else {
        // Prepare update query

        $sql = "UPDATE ingredients SET 
            raw_name = ? ,quantity = ? ,ideal_quantity = ?, picture = ?
 
            WHERE ingredients_id = $ingredients_id";

        $stmt = $conn->prepare($sql);

        // Bind parameters to statement
        $stmt->bind_param("siis", $raw_name, $qty, $ideal_qty, $picture);

        if ($stmt->execute()) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    }
}

$conn->close();
