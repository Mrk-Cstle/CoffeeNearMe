<?php
// Ensure this PHP script has access to your database connection
include '../include/dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $user_id = $_POST['user_id'];
    $account_type = $_POST['account_type'];
    $full_name = $_POST['full_name'];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];

    // Check if any data is updated
    $sql_check = "SELECT * FROM user WHERE user_id = $user_id";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        $row_check = $result_check->fetch_assoc();
        
        // Compare existing data with updated data
        if (
            $row_check['account_type'] == $account_type &&
            $row_check['full_name'] == $full_name &&
            $row_check['user_name'] == $user_name &&
            $row_check['password'] == $password &&
            $row_check['contact_number'] == $contact_number &&
            $row_check['address'] == $address
        ) {
            // Nothing changed
            echo json_encode(array('status' => 'nothing_changed'));
            exit();
        }
    }

    // Password hashing
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare update query
    $sql = "UPDATE user SET 
            account_type = '$account_type',
            full_name = '$full_name',
            user_name = '$user_name',
            password = '$hashedPassword',
            contact_number = '$contact_number',
            address = '$address'
            WHERE user_id = $user_id";

    if ($conn->query($sql) === TRUE) {
        // Record updated successfully
        echo json_encode(array('status' => 'success'));
    } else {
        // Error updating user
        echo json_encode(array('status' => 'error', 'message' => $conn->error));
    }
}

$conn->close();
?>
