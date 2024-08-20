<?php
header("Content-Type: application/json");
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // // Validate and sanitize input (you can add more validation as needed)
    // $full_name = htmlspecialchars($_POST['full_name']);
    // $user_name = htmlspecialchars($_POST['user_name']);
    // $passwords = htmlspecialchars($_POST['password']);
    // $full_name = htmlspecialchars($_POST['full_name']); // Ensure this field is collected from the form
    // $user_name = htmlspecialchars($_POST['user_name']); // Ensure this field is collected from the form
    // $contact_number = htmlspecialchars($_POST['contact_number']);
    // $address = htmlspecialchars($_POST['address']);

    // Include database connection details (replace with your actual database credentials)
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

    $data = json_decode(file_get_contents('php://input'), true);



    // Extract and sanitize data
    $user_name = sanitizeInput($data['user_name']);
    $full_name = sanitizeInput($data['full_name']);
    $passwords = sanitizeInput($data['password']);
    $address = sanitizeInput($data['address']);
    $contact_number = sanitizeInput($data['contact_number']);
    // Password hashing
    $hashedPassword = password_hash($passwords, PASSWORD_DEFAULT);

    // Prepare and bind SQL statement using prepared statement
    $stmt = $conn->prepare("INSERT INTO user (full_name, user_name, password, contact_number, address) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sssss", $full_name, $user_name, $hashedPassword, $contact_number, $address);

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
