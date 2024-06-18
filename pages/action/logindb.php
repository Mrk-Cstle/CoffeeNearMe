<?php
session_start(); // Start a session

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $user_name = htmlspecialchars($_POST['user_name']);
    $inputpassword = $_POST['password'];

    // Database connection details (replace with your actual database credentials)
    include '../include/dbConnection.php';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind SQL statement using prepared statement
    $stmt = $conn->prepare("SELECT user_id, full_name, password, account_type FROM user WHERE user_name = ?");
    $stmt->bind_param("s", $user_name);

    // Execute the statement
    $stmt->execute();
    $stmt->store_result();

    // Check if the user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $full_name, $hashedPassword, $account_type);
        $stmt->fetch();

        // Verify the password
        if (password_verify($inputpassword, $hashedPassword)) {
            // Password is correct, start a session
            $_SESSION['user_id'] = $user_id;
            $_SESSION['full_name'] = $full_name;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['account_type'] = $account_type;

            echo "Login successful. Welcome, " . $full_name .  $user_id .  $user_name .  $account_type . "!";
            // Redirect to a protected page or dashboard
            // header("Location: dashboard.php");
            exit;
        } else {

            // Invalid password
            echo "Invalid username or password." . $inputpassword . $hashedPassword;
        }
    } else {
        // User not found
        echo "Invalid username or password.";
    }

    // Close statement and connection
    var_dump($user_name, $inputpassword, $hashedPassword);
    $stmt->close();
    $conn->close();
}
