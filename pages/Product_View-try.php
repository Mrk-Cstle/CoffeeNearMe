<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingredients</title>
</head>

<body>
    <h2>List of Product</h2>

    <a class='btn btn-primary btn-sm' href='Product_Add-try.php'>Add</a>
    <br>

    <table class="table">
        <thead>
            <tr>
                <th>Picture</th>
                <th>Product</th>
                <th>Category</th>
                <th>Price</th>
                <th>Action</th>


            </tr>

        <tbody>

            <?php

            include '../pages/include/dbConnection.php';

            // Read all rows from the database
            $sql = "SELECT * FROM product ";
            $result = $conn->query($sql);

            if (!$result) {
                die("Invalid query: " . $conn->error);
            }

            // Read data for each row
            while ($row = $result->fetch_assoc()) {
                echo "
                        <tr>
                            <td>$row[picture]</td>
                            <td>$row[product_name]</td>
                            <td>$row[product_category]</td>
                            <td>$row[price]</td>
                            
                            
                            <td>
                                <a class='btn btn-primary btn-sm' href='Product_Edit-try.php?id=$row[product_id]'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='action/ingredienstsdelete_db.php?id=$row[product_id]'>Delete</a>
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