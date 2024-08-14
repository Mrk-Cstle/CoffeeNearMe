<?php
// Include the database connection file
$server = "localhost";
$username = "root";
$password = "";
$db = "coffeenearme";

// Establish connection
$conn = mysqli_connect($server, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    $response = array(
        'status' => 'error',
        'message' => 'Connection failed: ' . $conn->connect_error
    );
    echo json_encode($response);
    exit; // Stop further execution
}

// Get JSON data
$data = json_decode(file_get_contents('php://input'), true);

// Check if all required fields are present in $data
if (!isset($data['user_id']) || !isset($data['full_name']) || !isset($data['user_name']) || !isset($data['password'])
    || !isset($data['address']) || !isset($data['contact_number']) || !isset($data['account_type']) || !isset($data['account_date'])) 
{
    $response = array(
        'status' => 'error',
        'message' => 'Missing required fields.'
    );
    echo json_encode($response);
    exit; // Stop further execution
}

// Extract data
$user_id = $data['user_id'];
$full_name = $data['full_name'];
$user_name = $data['user_name'];
$password = $data['password'];
$address = $data['address'];
$contact_number = $data['contact_number'];
$account_type = $data['account_type'];
$account_date = $data['account_date'];

// Update query
$sql = "UPDATE user SET full_name=?, user_name=?, password=?, address=?, contact_number=?, account_type=?, account_date=? WHERE user_id=?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    $response = array(
        'status' => 'error',
        'message' => 'Prepare statement error: ' . $conn->error
    );
    echo json_encode($response);
    exit; // Stop further execution
}

$stmt->bind_param('sssssssi', $full_name, $user_name, $password, $address, $contact_number, $account_type, $account_date, $user_id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        // If at least one row was affected, it means data was updated
        $response = array(
            'status' => 'success',
            'message' => 'User updated successfully.',
            'updated' => true
        );
    } else {
        // No rows were affected, indicating no changes were made
        $response = array(
            'status' => 'success',
            'message' => 'No changes made.',
            'updated' => false
        );
    }
} else {
    // Error executing the SQL statement
    $response = array(
        'status' => 'error',
        'message' => 'Error updating user: ' . mysqli_stmt_error($stmt)
    );
}

echo json_encode($response);
?>
