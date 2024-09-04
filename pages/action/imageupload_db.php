<?php
header('Content-Type: application/json');
$action = isset($_POST['action']) ? $_POST['action'] : '';
if ($action === 'ingredients') {
    include '../include/dbConnection.php';
    $uploadDir = '../uploads/ingredients/';

    // Get the ingredient ID
    $ingredientId = $_POST['id'];

    // Extract the file extension from the original file name
    $fileExtension = pathinfo($_FILES['ingredients_image']['name'], PATHINFO_EXTENSION);

    // Create a new file name using the ingredient ID
    $newFileName = $ingredientId . '.' . $fileExtension;

    // Set the full path for the new file
    $uploadFile = $uploadDir . $newFileName;

    // Create the upload directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (move_uploaded_file($_FILES['ingredients_image']['tmp_name'], $uploadFile)) {
        // Prepare and execute the SQL query to update image details in the database
        $sql = "UPDATE ingredients SET picture = ? WHERE ingredients_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $newFileName, $ingredientId);

        try {
            $stmt->execute();
            $response = [
                "status" => "success",
                "message" => "File uploaded and database updated successfully"
            ];
        } catch (Exception $e) {
            $response = ["status" => "error", "message" => "Database error: " . $e->getMessage()];
        }

        $stmt->close();
    } else {
        $response = ["status" => "error", "message" => "File upload failed"];
    }

    // Send the response as JSON

    echo json_encode($response);
} elseif ($action === 'user') {
    include '../include/dbConnection.php';
    $uploadDir = '../uploads/user/';

    // Get the ingredient ID
    $usersId = $_POST['id'];

    // Extract the file extension from the original file name
    $fileExtension = pathinfo($_FILES['users_image']['name'], PATHINFO_EXTENSION);

    // Create a new file name using the ingredient ID
    $newFileName = $usersId . '.' . $fileExtension;

    // Set the full path for the new file
    $uploadFile = $uploadDir . $newFileName;

    // Create the upload directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (move_uploaded_file($_FILES['users_image']['tmp_name'], $uploadFile)) {
        // Prepare and execute the SQL query to update image details in the database
        $sql = "UPDATE user SET picture = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $newFileName, $usersId);

        try {
            $stmt->execute();
            $response = [
                "status" => "success",
                "message" => "File uploaded and database updated successfully"
            ];
        } catch (Exception $e) {
            $response = ["status" => "error", "message" => "Database error: " . $e->getMessage()];
        }

        $stmt->close();
    } else {
        $response = ["status" => "error", "message" => "File upload failed"];
    }

    // Send the response as JSON

    echo json_encode($response);
}
