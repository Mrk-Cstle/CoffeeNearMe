<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>

<body>
    <h2>Edit Ingredients</h2>

    <?php
    // Check if user ID is provided through GET request
    if (isset($_GET['id'])) {
        $product_id = $_GET['id'];

        // Fetch existing user data from database
        include '../pages/include/dbConnection.php';
        $sql = "SELECT * FROM product WHERE product_id = 
        $product_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

    ?>
            <form action="action/product_edittry_db.php" method="POST">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                <label>Product :</label>
                <input type="text" name="product_name" value="<?php echo $row['product_name']; ?>"><br><br>
                <label>Category:</label>
                <input type="text" name="product_category" value="<?php echo $row['product_category']; ?>"><br><br>
                <label>Price:</label>
                <input type="text" name="price" value="<?php echo $row['price']; ?>"><br><br>
                <label>Picture:</label>
                <input type="text" name="picture" value="<?php echo $row['picture']; ?>"><br><br>



                <input type="submit" value="Update">
            </form>
    <?php
        } else {
            echo "Product not found.";
        }
    }
    ?>

</body>

</html>