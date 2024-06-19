<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>

    <?php
    // Check if user ID is provided through GET request
    if (isset($_GET['id'])) {
        $user_id = $_GET['id'];

        // Fetch existing user data from database
        include '../pages/include/dbConnection.php'; 
        $sql = "SELECT * FROM user WHERE user_id = $user_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
           
            ?>
            <form action="action/editUser_db.php" method="POST">
                <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                <label>Account Type:</label>
                <input type="text" name="account_type" value="<?php echo $row['account_type']; ?>"><br><br>
                <label>Full Name:</label>
                <input type="text" name="full_name" value="<?php echo $row['full_name']; ?>"><br><br>
                <label>Username:</label>
                <input type="text" name="user_name" value="<?php echo $row['user_name']; ?>"><br><br>
                <label>Password:</label>
                <input type="text" name="password" value="<?php echo $row['password']; ?>"><br><br>
                <label>Contact Number:</label>
                <input type="text" name="contact_number" value="<?php echo $row['contact_number']; ?>"><br><br>
                <label>Address:</label>
                <input type="text" name="address" value="<?php echo $row['address']; ?>"><br><br>
                
                <input type="submit" value="Update" >
            </form>
            <?php
        } else {
            echo "User not found.";
        }
    } 
    ?>

</body>
</html>
