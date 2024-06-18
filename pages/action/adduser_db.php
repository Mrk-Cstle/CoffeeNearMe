<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input (you can add more validation as needed)
    $full_name = htmlspecialchars($_POST['full_name']);
    $user_name = htmlspecialchars($_POST['user_name']);
    $password = htmlspecialchars($_POST['password']);
    $contact_number = htmlspecialchars($_POST['contact_number']);
    $address = htmlspecialchars($_POST['address']);

    // Database connection details (replace with your actual database credentials)
    include '../include/dbConnection.php';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //password convert to hash
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind SQL statement using prepared statement

    $stmt = $conn->prepare("INSERT INTO user (full_name, user_name, password, contact_number, address) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $full_name, $user_name, $hashedPassword, $contact_number, $address);

    // Execute the statement
    try {
        $stmt->execute();
        echo "New record created successfully";
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            // Duplicate entry error
            echo "Error: Duplicate entry for user name.";
        } else {
            // Other errors
            echo "Error: " . $e->getMessage();
        }
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
