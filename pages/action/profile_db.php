<?php

header("Content-Type: application/json");
$data = json_decode(file_get_contents('php://input'), true);
$action = isset($data['action']) ? $data['action'] : '';

function sanitizeInput($data)
{
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}
include '../include/dbConnection.php';

try {
    switch ($action) {
        case 'fetchProfile':
            $userid = sanitizeInput($data['userid']);

            $sql = "SELECT * FROM user WHERE user_id = ?";
            $stmt = $conn->prepare($sql);

            $stmt->bind_param("i", $userid); // "i" indicates the type is integer
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $userData = $result->fetch_assoc(); // Fetch the user data as an associative array

                // Prepare the response
                echo json_encode(['status' => 'success', 'data' => $userData]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'User not found' . $id]);
            }

            $stmt->close(); // Close the statement

            break;

        case 'updateProfile':
            if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {

                $user_name = sanitizeInput($data['user_name']);
                $password = sanitizeInput($data['password']);
                $address = sanitizeInput($data['address']);
                $contact_number = sanitizeInput($data['contact_number']);
                $user_id = sanitizeInput($data['user_id']);
                // Assuming you send other profile data in the AJAX request
                $sql = "SELECT * FROM user WHERE user_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $existingData = $result->fetch_assoc();

                    // Build the update query dynamically based on changes
                    $fieldsToUpdate = [];
                    $params = [];
                    $types = '';

                    // Check each field for changes
                    if ($user_name != $existingData['user_name']) {
                        $fieldsToUpdate[] = "user_name = ?";
                        $params[] = $user_name;
                        $types .= 's'; // string
                    }

                    if ($password != $existingData['password']) {
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        $fieldsToUpdate[] = "password = ?";
                        $params[] = $hashedPassword; // Assuming plain text for simplicity, but should hash passwords
                        $types .= 's'; // string
                    }

                    if ($address != $existingData['address']) {
                        $fieldsToUpdate[] = "address = ?";
                        $params[] = $address;
                        $types .= 's'; // string
                    }

                    $newContactNumber = (string)$contact_number; // Ensure it's a string
                    $existingContactNumber = (string)$existingData['contact_number']; // Ensure it's a string
                    if ($newContactNumber !== $existingContactNumber) {
                        $fieldsToUpdate[] = "contact_number = ?";
                        $params[] = $newContactNumber; // Keep it as a string
                        $types .= 's'; // string
                    }

                    // If there are any changes, perform the update
                    if (!empty($fieldsToUpdate)) {
                        $params[] = $user_id;
                        $types .= 'i'; // integer for user_id

                        $updateQuery = "UPDATE user SET " . implode(", ", $fieldsToUpdate) . " WHERE user_id = ?";
                        $stmt = $conn->prepare($updateQuery);
                        $stmt->bind_param($types, ...$params);

                        if ($stmt->execute()) {
                            echo json_encode(['status' => 'success', 'message' => 'User updated successfully']);
                        } else {
                            echo json_encode(['status' => 'error', 'message' => 'Update failed']);
                        }
                    } else {
                        // No fields were changed
                        echo json_encode(['status' => 'error', 'message' => 'No changes detected']);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'User not found']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
            }
            break;

        default:
            echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
            break;
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
} finally {
    // Close database connection
    $conn->close();
}
