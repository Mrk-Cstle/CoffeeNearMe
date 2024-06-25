<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
            }
        }
                ?>


    <form id="editUserForm" action="action/editUser_db.php" method="POST">
        <!-- Your form fields here -->
        <!-- Include a hidden field for user_id -->
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

        <!-- Submit button -->
        <input type="submit" value="Update" href="action/editUser_db.php">
    </form>

    <div id="notification"></div>

    <script>
        $(document).ready(function() {
            $('#editUserForm').submit(function(event) {
                event.preventDefault(); // Prevent the form from submitting normally

                // Perform AJAX request
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(), // Serialize the form data
                    dataType: 'json', // Expect JSON response
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#notification').text('Record updated successfully.');
                        } else if (response.status === 'nothing_changed') {
                            $('#notification').text('Nothing changed.');
                        } else {
                            $('#notification').text('Error updating user: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        $('#notification').text('Error updating user.');
                    }
                });
            });
        });
    </script>

</body>
</html>
