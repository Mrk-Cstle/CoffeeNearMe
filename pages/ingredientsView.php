<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingredients</title>
</head>

<body>
    <h2>List of Ingredients</h2>

    <br>

    <table class="table">
        <thead>
            <tr>
                <th>Picture</th>
                <th>Ingredients</th>
                <th>Quantity</th>
                <th>Ideal Quantity</th>
                <th>Action</th>


            </tr>

        <tbody>

            <?php

            include '../pages/include/dbConnection.php';

            // Read all rows from the database
            $sql = "SELECT * FROM ingredients ";
            $result = $conn->query($sql);

            if (!$result) {
                die("Invalid query: " . $conn->error);
            }

            // Read data for each row
            while ($row = $result->fetch_assoc()) {
                echo "
                        <tr>
                            <td>$row[picture]</td>
                            <td>$row[raw_name]</td>
                            <td>$row[quantity]</td>
                            <td>$row[ideal_quantity]</td>
                            
                            
                            <td>
                                <a class='btn btn-primary btn-sm' href='ingredients_edit.php?id=$row[ingredients_id]'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='action/ingredientsdelete_db.php?id=$row[ingredients_id]'>Delete</a>
                            </td>
                        </tr>
                    ";
            }
            ?>



        </tbody>
        </thead>
    </table>
</body>

</html>