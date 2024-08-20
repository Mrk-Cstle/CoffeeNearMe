<?php include '../assets/template/navigation.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>

    <style>
        * {
    margin: 0;
    padding: 0;
}
.container {
    margin: 0;
    position: absolute;
    top: 50%;
    left: 58%;
    transform: translate(-50%, -50%);
}
table, thead, tbody, tr, td {
    border: 1px solid black;
    outline: 1px solid black;
    width: 1200px;
    height: 70px;
    text-align: center;
}
thead {
    background-color: #2D2B2B;
    color: white;
    font-size: 20px;
    font-weight: bold;
}
tbody {
    background-color: #D9D9D9;
    font-size: 20px;
    font-weight: bold;
    font-style: italic;
}
#picture, img {
    height: 120px;
    width: 120px;
    padding: 5px;
}
#btn {
    background-color: #D76614;
    color: white;
    width: 150px;
    height: 40px;
    border: 2px solid #D76614;
    border-radius: 10px;
    margin: 10px;
}

#categoryModal{
    background-color: #2D2B2B;
    color: white;
}
#ingridientModal{
    background-color: #2D2B2B;
    color: white;
}
#filterrModal{
    background-color: #2D2B2B;
    color: white;
}

.btn-dark, .btn-dark:hover, .btn-dark:active, .btn-dark:visited {
background-color: #D76614 !important;
}
.search{
    width: 80px;
    text-align: center;
    float: right;
    margin-right: 130px;
}
.searchInput{
    display: flex;
    width: 350px;
    float: right;
}
    </style>
    
</head>
<body>

    <div class="container">
        <form action="">
            <div class="productTable">
                <button type="button" id="btn" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category</button>
                <button type="button" id="btn" data-bs-toggle="modal" data-bs-target="#addIngredientsModal">Add Ingredients</button>
                <button type="button" id="btn" data-bs-toggle="modal" data-bs-target="#filterModal">Filter</button>
                    
                <button class="btn btn-dark my-2 my-sm-2 search" type="submit" id="seachBar">Search</button>
                <input class="form-control mr-sm-2 me-1 my-sm-2 searchInput" type="search" placeholder="Search" aria-label="Search">

                <table id="products">
                    <thead id="theadProducts">
                        <tr>
                            <td>Product Category</td>
                            <td>Product Name</td>
                            <td>Price</td>
                            <td>Picture</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Coffee</td>
                            <td>Nescafe</td>
                            <td>₱120</td>
                            <td id="picture"><img src="../assets/images/1x1.jpg" class="fprofile"></td>
                        </tr>
                        <tr>
                            <td>Coffee</td>
                            <td>Nescafe</td>
                            <td>₱120</td>
                            <td id="picture"><img src="../assets/images/Maloi.jpg" class="fprofile"></td>
                        </tr>
                        <tr>
                            <td>Coffee</td>
                            <td>Nescafe</td>
                            <td>₱120</td>
                            <td id="picture"><img src="../assets/images/Maloi.jpg" class="fprofile"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="categoryModal">
                    <form>
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" required>
                        </div>
                        <button type="submit" class="btn btn-dark">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Ingredients Modal -->
    <div class="modal fade" id="addIngredientsModal" tabindex="-1" aria-labelledby="addIngredientsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addIngredientsModalLabel">Add Ingredients</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="ingridientModal">
                    <form>
                        <div class="mb-3">
                            <label for="ingredientName" class="form-label">Ingredient Name</label>
                            <input type="text" class="form-control" id="ingredientName" required>
                        </div>
                        <div class="mb-3">
                            <label for="ingredientQuantity" class="form-label">Quantity</label>
                            <input type="text" class="form-control" id="ingredientQuantity" required>
                        </div>
                        <button type="submit" class="btn btn-dark">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="filterrModal">
                    <form>
                        <div class="mb-3">
                            <label for="filterCategory" class="form-label">Category</label>
                            <input type="text" class="form-control" id="filterCategory">
                        </div>
                        <div class="mb-3">
                            <label for="filterPrice" class="form-label">Price Range</label>
                            <input type="text" class="form-control" id="filterPrice">
                        </div>
                        <button type="submit" class="btn btn-dark">Apply Filter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
