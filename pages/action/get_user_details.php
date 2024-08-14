<?php
include '../pages/include/dbConnection.php'; // Siguraduhing tama ang path papunta sa iyong database connection file

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $sql = "SELECT * FROM user WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // I-return ang mga detalye ng user sa JSON format
        echo json_encode($row);
    } else {
        echo json_encode(array('error' => 'No user found'));
    }
} else {
    echo json_encode(array('error' => 'User ID not provided'));
}
?>
