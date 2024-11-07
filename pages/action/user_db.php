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
        $account = sanitizeInput($data['account']);
        // Password hashing
        $hashedPassword = password_hash($passwords, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO user (full_name, user_name, password, contact_number, address,account_type) VALUES (?, ?, ?, ?, ?,?)");
        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param("ssssss", $full_name, $user_name, $hashedPassword, $contact_number, $address, $account);

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


        $sql = "SELECT picture FROM user WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $stmt->bind_result($fileName);
        $stmt->fetch();
        $stmt->close();
        if ($fileName) {
            // Construct the full path to the image file
            $uploadDir = '../uploads/user/';
            $filePath = $uploadDir . $fileName;

            // Check if the file exists and delete it
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $stmt = $conn->prepare("DELETE FROM user WHERE user_id =?");
        $stmt->bind_param("i", $user_id);


        try {
            $stmt->execute();
            echo json_encode(["status" => "success", "message" => "Record deleted successfully"]);
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
        $stmt->close();
        $conn->close();
    } elseif ($action === 'reload') {
        include '../include/dbConnection.php';

        $category = sanitizeInput($data['category']);
        $search_user = sanitizeInput($data['search_user']);
        $page =  sanitizeInput($data['page']);
        $itemsPerPage =  sanitizeInput($data['itemsPerPage']);

        $offset = ($page - 1) * $itemsPerPage;


        $sql = "SELECT * FROM user WHERE 1=1";

        if (!empty($category)) {
            $sql .= " AND account_type = '$category'";
        }
        if (!empty($search_user)) {
            $sql .= " AND full_name LIKE '%$search_user%'";
        }

        $result = $conn->query($sql);

        $totalItems = $result->num_rows;

        $sql .= "  LIMIT $offset,$itemsPerPage";
        $result = $conn->query($sql);


        if (!$result) {
            die(json_encode(["status" => "error", "message" => "Invalid Query:" . $conn->error]));
        }

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $conn->close();
        $totalPages = ceil($totalItems / $itemsPerPage);
        echo json_encode([
            "status" => "success",
            "message" => 'success',
            "data" => $data,
            "totalPages" => $totalPages


        ]);
    } elseif ($action === "editmodal") {
        include '../include/dbConnection.php';


        $userid = sanitizeInput($data['usersid']);
        $sql = "SELECT * FROM user WHERE user_id = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $userid);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                echo json_encode(['status' => 'success', 'data' => $user, 'modalview' => 'modalview']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'User not found']);
            }
        }
    } elseif ($action === 'edit') {
        include '../include/dbConnection.php';

        $user_id = sanitizeInput($data['user_id']);
        $full_name = sanitizeInput($data['full_name']);
        $user_name = sanitizeInput($data['user_name']);
        $password = sanitizeInput($data['password']);
        $address = sanitizeInput($data['address']);
        $contact_number = sanitizeInput($data['contact_number']);
        $account_type = sanitizeInput($data['account_type']);
        $account_date = sanitizeInput($data['account_date']);

        $sql = "SELECT * FROM user WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $dbuser_id = $row['user_id'];
            $dbfull_name = $row['full_name'];
            $dbuser_name = $row['user_name'];
            $dbpassword = $row['password'];
            $dbaddress = $row['address'];
            $dbcontact_number = $row['contact_number'];
            $dbaccount_type = $row['account_type'];
            $dbaccount_date = $row['account_date'];

            // Check if any field has changed
            // Verify the input password with the stored hash
            $noChanges = (
                $full_name == $dbfull_name &&
                $user_name == $dbuser_name &&
                $password == $dbpassword &&
                $address == $dbaddress &&
                $contact_number == $dbcontact_number &&
                $account_type == $dbaccount_type &&
                $account_date == $dbaccount_date
            );

            if ($noChanges) {
                echo json_encode(["status" => "error", "message" => "No changes to update."]);
            } else {
                // Dynamically build the SQL query based on changes
                $updateFields = [];
                $updateValues = [];

                if ($full_name != $dbfull_name) {
                    $updateFields[] = "full_name = ?";
                    $updateValues[] = $full_name;
                }
                if ($user_name != $dbuser_name) {
                    $updateFields[] = "user_name = ?";
                    $updateValues[] = $user_name;
                }
                if ($password != $dbpassword) {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $updateFields[] = "password = ?";
                    $updateValues[] = $hashedPassword;
                }
                if ($address != $dbaddress) {
                    $updateFields[] = "address = ?";
                    $updateValues[] = $address;
                }
                if ($contact_number != $dbcontact_number) {
                    $updateFields[] = "contact_number = ?";
                    $updateValues[] = $contact_number;
                }
                if ($account_type != $dbaccount_type) {
                    $updateFields[] = "account_type = ?";
                    $updateValues[] = $account_type;
                }

                // Prepare the update query
                $updateFields = implode(", ", $updateFields);
                $updateValues[] = $user_id;  // Add user_id for the WHERE clause

                $sql = "UPDATE user SET $updateFields WHERE user_id = ?";
                $stmt = $conn->prepare($sql);

                // Bind the parameters dynamically
                $types = str_repeat('s', count($updateValues) - 1) . 'i';  // 's' for strings, 'i' for user_id (integer)
                $stmt->bind_param($types, ...$updateValues);

                try {
                    $stmt->execute();
                    echo json_encode([
                        "status" => "success",
                        "message" => "Record updated successfully"
                    ]);
                } catch (Exception $e) {
                    echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
                }

                $stmt->close();
            }
        }

        $conn->close();
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
}
