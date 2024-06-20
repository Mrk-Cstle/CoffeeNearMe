<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ingredients_name = htmlspecialchars($_POST['name']);
    $ingredients_qty = htmlspecialchars($_POST['qty']);
    $ingredients_ideal = htmlspecialchars($_POST['ideal_qty']);
    $ingredients_picture = htmlspecialchars($_POST['picture']);

    include '../include/dbConnection.php';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO ingredients (raw_name,quantity,ideal_quantity,picture) VALUES (?,?,?,?)");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }
    $stmt->bind_param("siis", $ingredients_name, $ingredients_qty, $ingredients_ideal, $ingredients_picture);

    try {
        $stmt->execute();
        echo "New record created successfully";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
