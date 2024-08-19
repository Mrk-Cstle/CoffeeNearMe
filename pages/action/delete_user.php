<?php
include './include/dbConnection.php';

$mysqli = mysqli_connect('localhost', 'root', '', 'coffeenearme');

if (isset($_POST['user_id'])) {
  $user_id = $_POST['user_id'];

  $stmt = $mysqli->prepare("DELETE FROM user WHERE user_id =?");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();

  if ($stmt->affected_rows > 0) {
    $response = array(
      'status' => 'success',
      'message' => 'User deleted successfully.'
    );
  } 
} else {
  $response = array(
    'status' => 'error',
    'message' => 'Error deleting user: user_id not provided.'
  );
}

echo json_encode($response);
?>


