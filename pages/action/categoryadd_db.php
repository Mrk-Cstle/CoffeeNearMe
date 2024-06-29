<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $category = htmlspecialchars($_POST['category']);

    include '../include/dbConnection.php';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $stmt = $conn->prepare("INSERT INTO ingredients_category (category) VALUES (?)");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }
    $stmt->bind_param("s", $category);

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
