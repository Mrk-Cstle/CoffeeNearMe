<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>
<body>
        

        <h2>List of Users</h2>
        <a class="btn btn-primary" href="adduser.php" role="button">New User</a>
        <br>

        <table class="table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Account Type</th>
                    <th>FullName</th>
                    <th>Username</th>
                    <th>Contact Number</th>
                    <th>Address</th>
                    <th>Picture</th>
                    <th>Account Date</th>
                    <th>Action</th>
                </tr>

                <tbody>

                <?php

                include '../pages/include/dbConnection.php';

                // Read all rows from the database
                $sql = "SELECT * FROM user ";
                $result = $conn->query($sql);

                if (!$result) {
                    die("Invalid query: " . $conn->error);
                }

                // Read data for each row
                while ($row = $result->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>$row[user_id]</td>
                            <td>$row[account_type]</td>
                            <td>$row[full_name]</td>
                            <td>$row[user_name]</td>
                            <td>$row[contact_number]</td>
                            <td>$row[address]</td>
                            <td>$row[picture]</td>
                            <td>$row[account_date]</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='editUser.php?id=$row[user_id]'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='action/delete_db.php?id=$row[user_id]'>Delete</a>
                            </td>
                        </tr>
                    ";
                }
                ?>


                  
                </tbody>
            </thead>
        </table>
        </div>
</body>
</html>