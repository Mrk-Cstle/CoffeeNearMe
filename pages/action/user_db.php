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
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
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
        }

        if ($user_id == $dbuser_id && $full_name == $dbfull_name && $user_name == $dbuser_name && $password == $dbpassword && $address == $dbaddress && $contact_number == $dbcontact_number && $account_type == $dbaccount_type && $dbaccount_date == $account_date) {

            echo json_encode(["status" => "error", "message" => "No changes to update. "]);
        } else {
            $sql = "UPDATE user SET full_name=?, user_name=?, password=?, address=?, contact_number=?, account_type=? WHERE user_id=?";
            $stmt = $conn->prepare($sql);




            $stmt->bind_param('ssssssi', $full_name, $user_name, $hashedPassword, $address, $contact_number, $account_type, $user_id);

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
            $conn->close();
        }
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
}
