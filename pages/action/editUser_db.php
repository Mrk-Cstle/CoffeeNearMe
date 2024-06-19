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
        echo "User updated successfully.";
        // Redirect to the list of users or wherever appropriate
        header("Location: ../editUser.php"); // Redirect to user list page after successful update
        exit();
    } else {
        echo "Error updating user: " . $conn->error;
    }
}

$conn->close();
?>
