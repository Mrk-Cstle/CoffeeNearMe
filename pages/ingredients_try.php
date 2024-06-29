<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Ingredients</title>
</head>

<body>
    <form action="action/addingredients_db.php" method="post">
        <label for="name">Ingredients Name</label>
        <input type="text" name="name" id="name" placeholder="Enter Ingredients Name">
        <br><br>
        <label for="qty">Quantity</label>
        <input type="number" name="qty" id="qty" placeholder="Enter Quantity">
        <br><br>
        <label for="qty">Category</label>
        <select name="category" id="category">
            <?php

            include '../pages/include/dbConnection.php';

            // Read all rows from the database
            $sql = "SELECT * FROM ingredients_category  ";
            $result = $conn->query($sql);

            if (!$result) {
                die("Invalid query: " . $conn->error);
            }

            // Read data for each row
            while ($row = $result->fetch_assoc()) {
                echo '<option value ="' . $row["category"] . '">' . $row["category"] . '</option> ';
            }
            ?>
        </select>

        <br><br>
        <label for="ideal_qty">Ideal Quantity</label>
        <input type="text" name="ideal_qty" id="ideal_qty" placeholder="Enter Ideal Quantity">
        <br><br>
        <label for="picture">Picture</label>
        <input type="text" name="picture" id="picture" placeholder="Enter Ingredients Picture">
        <br><br>

        <input type="submit" value="Submit">
    </form>
</body>

</html>