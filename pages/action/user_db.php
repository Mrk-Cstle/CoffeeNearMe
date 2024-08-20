<?php

header("Content-Type: application/json");
$data = json_decode(file_get_contents('php://input'), true);
$action = isset($data['action']) ? $data['action'] : '';

function sanitizeInput($data)
{
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

try {

    if ($action === 'add') {
        include '../include/dbConnection.php';
        $user_name = sanitizeInput($data['user_name']);
        $full_name = sanitizeInput($data['full_name']);
        $passwords = sanitizeInput($data['password']);
        $address = sanitizeInput($data['address']);
        $contact_number = sanitizeInput($data['contact_number']);
        // Password hashing
        $hashedPassword = password_hash($passwords, PASSWORD_DEFAULT);

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
    } elseif ($action === 'delete') {
        include '../include/dbConnection.php';
        $user_id = sanitizeInput($data['user_id']);


        $stmt = $conn->prepare("DELETE FROM user WHERE user_id =?");
        $stmt->bind_param("i", $user_id);


        try {
            $stmt->execute();
            echo json_encode(["status" => "success", "message" => "New record created successfully"]);
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
        $stmt->close();
        $conn->close();
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
}
