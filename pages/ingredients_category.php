<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingredients Category</title>
</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th>category</th>



            </tr>

        <tbody>

            <?php

            include '../pages/include/dbConnection.php';

            // Read all rows from the database
            $sql = "SELECT * FROM ingredients_category ";
            $result = $conn->query($sql);

            if (!$result) {
                die("Invalid query: " . $conn->error);
            }

            // Read data for each row
            while ($row = $result->fetch_assoc()) {
                echo "
                        <tr>
                            <td>$row[category]</td>
                            
                            
                            
                            <td>
                                
                                <a class='btn btn-danger btn-sm' href='action/categorydelete_db.php?id=$row[category_id]'>Delete</a>
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