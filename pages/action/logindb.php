<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function sanitizeInput($data)
    {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }

    $data = json_decode(file_get_contents("php://input"), true);



    $user_name = sanitizeInput($data['user']);
    $inputpassword = sanitizeInput($data['password']);



    include '../include/dbConnection.php';

    if ($conn->connect_error) {
        echo json_encode(["success" => false, "message" => "Database connection failed."]);
        exit;
    }


    $stmt = $conn->prepare("SELECT user_id, full_name, password, account_type FROM user WHERE user_name = ?");
    $stmt->bind_param("s", $user_name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $full_name, $hashedPassword, $account_type);
        $stmt->fetch();

        if (password_verify($inputpassword, $hashedPassword)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['full_name'] = $full_name;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['account_type'] = $account_type;

            echo json_encode([
                "success" => true,
                "message" => "Login successful. Welcome, $full_name!",
                "user" => [
                    "user_id" => $user_id,
                    "full_name" => $full_name,
                    "account_type" => $account_type
                ]
            ]);
        } else {
            echo json_encode(["success" => false, "message" => "Invalid username or password."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid username or password."]);
    }

    $stmt->close();
    $conn->close();
}
