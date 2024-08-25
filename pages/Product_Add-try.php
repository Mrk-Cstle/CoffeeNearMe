<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>

<body>
    <form id="myForm" action="action/product_addtry_db.php" method="POST">
        <label for="product">Product</label>
        <input type="text" name="product" id="product" placeholder="Enter Full Name">
        <br><br>
        <label for="category">Category</label>
        <input type="text" name="category" id="category" placeholder="Enter User Name">
        <br><br>
        <label for="price">Price</label>
        <input type="number" name="price" id="price" placeholder="Enter Password">
        <BR>
        <label for="picture">Picture</label>

        <input type="text" name="picture" id="picture" placeholder="Enter Password">
        <br><br>

        <input type="submit" value="Submit">
    </form>
    <script>
        document.getElementById('myForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting the traditional way

            const formData = new FormData(this);
            const data = Object.fromEntries(formData);

            fetch('action/product_addtry_db.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => console.log(result))
                .catch(error => console.error('Error:', error));
        });
    </script>
</body>

</html>