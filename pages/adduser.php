<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
</head>

<body>
    <form action="action/adduser_db.php" method="post">
        <label for="full_name">Full Name</label>
        <input type="text" name="full_name" id="full_name" placeholder="Enter Full Name">
        <br><br>
        <label for="user_name">User Name</label>
        <input type="text" name="user_name" id="user_name" placeholder="Enter User Name">
        <br><br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter Password">
        <br><br>
        <label for="contact_number">Contact Number</label>
        <input type="text" name="contact_number" id="contact_number" placeholder="Enter Contact Number">
        <br><br>
        <label for="address">Address</label>
        <input type="text" name="address" id="address" placeholder="Enter Address">
        <br><br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>