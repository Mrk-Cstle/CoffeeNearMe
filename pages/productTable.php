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
#btn-action{
    background-color: #D76614;
    color: white;
    width: 80px;
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

/*Top btn*/
.topbtn{
    margin: 10px;
} 
/* Modal Category CSS */
.modal{
    font-size: 20px;
    font-style: italic;
}
#plusbtn{
    float: right;
    border: 1px white;
    background-color: white;
}
/* Button Styling */
.topbtn {
  background-color: #d76614;
  border: none;
  float: left;
  margin-left: 20px;
}

/* Category List Modal Styling */
.categorycontent {
  background-color: #fff;
}

.modal-header {
  color: #000; /* Adjusted for consistency */
  border-bottom: 1px solid rgba(0, 0, 0, 0.6);
  justify-content: space-between;
}

.category {
  color: #000;
  font-weight: 600;
  margin-bottom: 20px;
}

.items {
  background-color: #d9d9d9;
}

.dots {
  float: right;
}

/* Add New Category Modal Styling */
.pluscontent {
  background-color: #fff;
}

.plusheader {
  color: #000;
  border-bottom: 1px solid rgba(0, 0, 0, 0.6);
  justify-content: center;
}

.plusbody {
  color: #000;
  font-weight: 600;
  padding: 0;
}

.plusfooter {
  padding-right: 30px;
}

/* Add Ingredients Modal Styling */
.add-content {
  background-color: rgba(0, 0, 0, 0.6);
}

.add {
  color: #fff;
  border-bottom: 1px solid rgba(0, 0, 0, 0.6);
}

.add-body {
  margin-left: 90px;
  color: #fff;
}

.add-footer {
  border-top: 1px solid rgba(0, 0, 0, 0.6);
}

.add-title {
  margin-left: 145px;
}

/* Input Styling */
.t-input {
  background-color: rgba(0, 0, 0, 0.3);
  border: 1px solid #d76614;
  color: #d76614;
}

/* Additional Button Styling */
.vbtn {
  color: #FFF;
  font-size: 15px;
  width: 70px;
}

    </style>
    
</head>
<body>

    <div class="container">
        <form action="">
            <div class="productTable">
            <button type="button" data-bs-toggle="modal" data-bs-target="#Modal" class="topbtn btn btn-dark me-1">Category</button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#Add" class="topbtn btn btn-dark me-1">Add Ingredients</button>
            <button type="button" class="topbtn btn btn-dark me-1">Filter</button>
                    
                <button class="btn btn-dark my-2 my-sm-2 search" type="submit" id="seachBar">Search</button>
                <input class="form-control mr-sm-2 me-1 my-sm-2 searchInput" type="search" placeholder="Search" aria-label="Search">

                <table id="products">
                    <thead id="theadProducts">
                        <tr>
                            <td>Picture</td>
                            <td>Product Category</td>
                            <td>Product Name</td>
                            <td>Price</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td id="picture"><img src="../assets/images/1x1.jpg" class="fprofile"></td>
                            <td>Coffee</td>
                            <td>Nescafe</td>
                            <td>₱120</td>
                            <td><button type="button" id="btn-action" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                            <button type="button" id="btn-action" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button></td>
                        </tr>
                        <tr>
                        <td id="picture"><img src="../assets/images/Maloi.jpg" class="fprofile"></td>
                            <td>Coffee</td>
                            <td>Nescafe</td>
                            <td>₱120</td>
                            <td><button type="button" id="btn-action" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                            <button type="button" id="btn-action" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button></td>
                        </tr>
                        <tr>
                        <td id="picture"><img src="../assets/images/Maloi.jpg" class="fprofile"></td>
                            <td>Coffee</td>
                            <td>Nescafe</td>
                            <td>₱120</td>
                            <td><button type="button" id="btn-action" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                            <button type="button" id="btn-action" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>

    

<!-- Modal for Category List -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="categorycontent modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-4" id="ModalLabel">Category</h1>
        <button type="button" id="plusbtn" class=" bi bi-plus-lg mt-1" data-bs-target="#Category" data-bs-toggle="modal"></button>
      </div>
      <div class="category modal-body">
        <ul class="list-group">
          <!-- Category items will be dynamically inserted here -->
          <!-- Example: -->
          <!-- <li class="items list-group-item">Example Category
            <a href="#" class="dots bi bi-three-dots-vertical text-dark"></a>
          </li> -->
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Adding New Category -->
<div class="modal fade" id="Category" tabindex="-1" aria-labelledby="CategoryLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="pluscontent modal-content">
      <div class="plusheader modal-header">
        <h1 class="modal-title fs-4" id="CategoryLabel">Add New Category</h1>
      </div>
      <div class="plusbody modal-body">
        <div class="userbody modal-body">
          <div class="user input-group mb-3 d-block">
            Category
            <input type="text" class="t-input form-control w-100" aria-label="category" id="category">
          </div>
        </div>
      </div>
      <div class="plusfooter modal-footer">
        <button type="button" class="btn btn-dark" id="add_category">Add</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Adding Ingredients -->
<div class="modal fade" id="Add" tabindex="-1" aria-labelledby="AddLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="add-content modal-content">
      <div class="add modal-header">
        <h1 class="add-title modal-title fs-4" id="AddLabel">Add Ingredients</h1>
        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="add-body modal-body">
        <div class="add-ingredient input-group mb-3 d-block">
          Ingredients
          <input type="text" class="t-input form-control w-75" aria-label="ingredients" id="ingredients">
        </div>
        <div class="add-category input-group mb-3 d-block">
          Category
          <select class="t-input form-control w-75" aria-label="category" name="category" id="ingredient_category">
            <?php
            include '../pages/include/dbConnection.php';

            // Read all rows from the database
            $sql = "SELECT * FROM ingredients_category";
            $result = $conn->query($sql);

            if (!$result) {
              die("Invalid query: " . $conn->error);
            }

            // Read data for each row
            while ($row = $result->fetch_assoc()) {
              echo '<option value="' . $row["category"] . '">' . $row["category"] . '</option>';
            }
            ?>
          </select>
        </div>
        <div class="add-quantity input-group mb-3 d-block">
          Quantity
          <input type="text" class="t-input form-control w-75" aria-label="qty" id="qty">
        </div>
        <div class="add-ideal input-group mb-3 d-block">
          Ideal Quantity
          <input type="text" class="t-input form-control w-75" aria-label="ideal_qty" id="ideal_qty">
        </div>
      </div>
      <div class="add-footer modal-footer">
        <button type="button" class="btn btn-dark me-2" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-dark" id="saveChanges">Add</button>
      </div>
    </div>
  </div>
</div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
