<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ingredients</title>
</head>

<body>
    <h2>Edit Ingredients</h2>

    <?php
    // Check if user ID is provided through GET request
    if (isset($_GET['id'])) {
        $ingredients_id = $_GET['id'];

        // Fetch existing user data from database
        include '../pages/include/dbConnection.php';
        $sql = "SELECT * FROM ingredients WHERE ingredients_id = 
        $ingredients_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

    ?>
            <form action="action/ingredientsedit_db.php" method="POST">
                <input type="hidden" name="ingredients_id" value="<?php echo $row['ingredients_id']; ?>">
                <label>Ingredients Name:</label>
                <input type="text" name="raw_name" value="<?php echo $row['raw_name']; ?>"><br><br>
                <label>Quantity:</label>
                <input type="text" name="qty" value="<?php echo $row['quantity']; ?>"><br><br>
                <label>ideal_quantity:</label>
                <input type="text" name="ideal_qty" value="<?php echo $row['ideal_quantity']; ?>"><br><br>
                <label>Picture:</label>
                <input type="text" name="picture" value="<?php echo $row['picture']; ?>"><br><br>
                <label>Contact Number:</label>


                <input type="submit" value="Update">
            </form>
    <?php
        } else {
            echo "User not found.";
        }
    }
    ?>

</body>

</html>