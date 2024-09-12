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

    .tableProductsInfo {
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

    #picture,
    img {
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

    #btn-action {
      background-color: #D76614;
      color: white;
      width: 80px;
      height: 40px;
      border: 2px solid #D76614;
      border-radius: 10px;
      margin: 10px;
    }

    #categoryModal {
      background-color: #2D2B2B;
      color: white;
    }

    #ingridientModal {
      background-color: #2D2B2B;
      color: white;
    }

    #categoryLabel {
      color: white;
    }

    #filterrModal {
      background-color: #2D2B2B;
      color: white;
    }

    .btn-dark,
    .btn-dark:hover,
    .btn-dark:active,
    .btn-dark:visited {
      background-color: #D76614 !important;
    }

    .search {
      width: 80px;
      text-align: center;
      float: right;
      margin-right: 130px;
    }

    .searchInput {
      display: flex;
      width: 350px;
      float: right;
    }

    /*Top btn*/
    .topbtn {
      margin: 10px;
    }

    /* Modal Category CSS */
    .modal {
      font-size: 20px;
      font-style: italic;
    }

    #plusbtn {
      float: right;
      border: 1px white;
      background-color: white;
      margin-left: 630px;
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
      width: 800px;
      height: 500px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    .product-Header {
      color: #2D2B2B;
      /* Adjusted for consistency */
      border: 2px solid #D9D9D9;
      justify-content: space-between;
      background-color: #D9D9D9;

    }

    #viewProductModalLabel {
      font-size: 20px;
      margin-left: 650px;
      font-weight: bold;
    }

    .modal-dialog {
      max-width: 1400px;
      /* Adjust to match the view form width */
    }

    .btn-close {
      background-color: #D9D9D9;
    }

    .category {
      color: #000;
      font-weight: 600;
      margin-bottom: 20px;
      background-color: #fff;
      border: 2px solid #fff;
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
      width: 800px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
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
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: #fff;
      border: 2px solid #d9d9d9;
      color: #000;
      width: 1000px;
    }

    .add {
      color: #000;
      border-bottom: 1px solid rgba(0, 0, 0, 0.6);
    }

    .add-body {
      margin-left: 90px;
      color: #000;
      font-weight: bold;
      width: 800px;
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
      border: 1px solid #D9D9D9;
      color: #000;
      font-weight: bold;
    }

    /* Additional Button Styling */
    .vbtn {
      color: #FFF;
      font-size: 15px;
      width: 70px;
    }

    /*VIEW and INGREDIENT CSS */

    .viewContent {
      width: 1200px;
      margin-left: 150px;
    }

    .prodHeading {
      text-align: center;
      color: #2D2B2B;
      margin-top: 15px;
      margin-left: 620px;
    }

    .viewProduct {
      border: 2px solid #D9D9D9;
      background-color: #D9D9D9;
      width: 1200px;
      height: 700px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      display: flex;
      position: absolute;
      margin-top: 330px;
    }

    /*Ingredient CSS*/
    .ingredientBody {
      border: 3px solid #2D2B2B;
      background-color: #d9d9d9;
      width: 540px;
      height: 535px;
      position: absolute;
      top: 80px;
      /* Adjust this value to move the div down */
      left: 630px;
      /* Adjust this value as needed */
    }

    .ingredientHeader {
      border-bottom: 2px solid #d9d9d9;
      color: #000;
      width: 536px;
      height: 80px;
      position: relative;
    }

    .ingredientHeading {
      text-align: center;
      font-size: 30px;
      margin-top: 23px;
    }

    .ingredientBtn {
      position: absolute;
      top: 10px;
      /* Adjust this value to move the div down */
      left: 480px;
      /* Adjust this value as needed */
      border: 1px solid #d76614;
      border-radius: 5px;
      width: 25px;
      height: 25px;
      background-color: #d76614;
      cursor: pointer;
    }

    .plusIcon {
      font-size: 25px;
      color: white;
      position: absolute;
      top: -8px;
      left: 0px;
    }

    .IngredientHeaderTwo {
      display: flex;
    }

    .ingredientLabel {
      border-bottom: 2px solid #d76614;
      height: 50px;
      color: white;
      font-size: 20px;
    }

    .tableIngredient {
      width: 100%;
      border-collapse: collapse;
    }

    .headerRow tr {
      text-align: center;
      display: grid;
      grid-template-columns: 180px 120px 1fr;
      gap: 25px;
    }

    .headerRow td {
      margin-left: 46px;
      padding: 10px;
      border-right: 1px solid #2D2B2B;
    }

    .ingredientLi {
      background-color: #fff;
      color: #000;
    }

    .ingredientBodyModal {
      font-size: 20px;
      font-weight: bold;
      font-style: normal;
      background-color: #d9d9d9;
    }

    .spanquantity {
      margin-left: 60px;
      font-size: large;
      font-weight: bold;
    }

    .trashIcon {
      font-size: 20px;
      margin-left: 150px;
    }

    /*View Picture Edit*/
    .productPicture {
      width: 182px;
      height: 182px;
      background-color: #D9D9D9;
      border-radius: 50%;
      margin-left: 230px;
      margin-top: 61px;
    }

    .ingredientProfile {
      width: 180px;
      height: 180px;
      border-radius: 50%;
    }

    /* View Form Edit*/
    .productDetails {
      border: 3px solid #2D2B2B;
      background-color: #EEEEEE;
      height: 320px;
      width: 540px;
      margin-top: 52px;
      margin-left: 60px;
    }

    .productInput {
      color: #2D2B2B;
      font-size: 18px;
      padding: 30px;
      font-weight: bold;
    }

    .productName {
      border: 2px solid #2D2B2B;
      background-color: #fff;
      color: black;
      width: 320px;
      height: 30px;
      border-radius: 15px;
      margin-left: 10px;
    }

    .productCategory {
      border: 2px solid #2D2B2B;
      background-color: #FFF;
      color: black;
      width: 290px;
      height: 30px;
      border-radius: 15px;
      margin-left: 10px;
    }

    .productPrice {
      border: 2px solid #2D2B2B;
      background-color: #fff;
      color: black;
      width: 325px;
      height: 30px;
      border-radius: 15px;
      margin-left: 10px;
    }

    .viewIngredient {
      border: 3px solid #D9D9D9;
      margin-top: 664px;
      background-color: #d9d9d9;
      width: 100%;
    }

    .btnIngredient {
      background-color: #d76614;
      margin-top: 20px;
      font-size: 20px;
      font-weight: normal;
    }

    /*Plus Icon Modal css */
    .fade-up {
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.5s ease-out, transform 0.5s ease-out;
    }

    .fade-up.show {
      opacity: 1;
      transform: translateY(0);
    }

    .plusIconModalContent {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      margin-top: 500px;
      width: 800px;
      height: 400px;
    }

    .plusIconModal {
      background-color: #d9d9d9;
      border: 2px solid #D9D9D9;
      color: #000;
      font-size: 20px;
      font-style: italic;
      font-weight: bold;
    }

    .plusInput {
      border: 2px solid #2D2B2B;
      border-radius: 10px;
      color: #000;
      background-color: #FFF;
    }

    .btn-plus {
      background-color: #d76614;
      color: white;
      font-size: 18px;
      font-style: italic;
      margin-left: 680px;
      margin-top: 60px;
    }
  </style>

</head>

<body>

  <div class="container">
    <form action="">
      <div class="productTable">
        <button type="button" data-bs-toggle="modal" data-bs-target="#Modal" class="topbtn btn btn-dark me-1">Category</button>
        <button type="button" data-bs-toggle="modal" data-bs-target="#Add" class="topbtn btn btn-dark me-1">Add Product</button>
        <select class="topbtn btn btn-dark me-1" aria-label="categoryFilter" name="categoryFilter" id="categoryFilter">
          <option value="">Filter</option>
          <?php

          include '../pages/include/dbConnection.php';

          // Read all rows from the database
          $sql = "SELECT * FROM product_category";
          $results = $conn->query($sql);

          if (!$results) {
            die("Invalid query: " . $conn->error);
          }

          // Read data for each row
          while ($rows = $results->fetch_assoc()) {
            echo '<option value ="' . $rows["category"] . '">' . $rows["category"] . '</option> ';
          }
          ?>

        </select>

        <input id="searchInput" class="form-control mr-sm-2 me-1 my-sm-2 searchInput" type="search" placeholder="Search" aria-label="Search">
    </form>
  </div>
  <table class="tableProductsInfo" id="products">
    <thead class="tableProductsInfo" id="theadProducts">
      <tr class="tableRowProductsInfo">
        <td class="tableProductsInfo">Picture</td>
        <td class="tableProductsInfo">Product Category</td>
        <td class="tableProductsInfo">Product Name</td>
        <td class="tableProductsInfo">Price</td>
        <td class="tableProductsInfo">Action</td>
      </tr>
    </thead>
    <tbody class="product-tbl tableProductsInfo">

    </tbody>

  </table>




  <div id="paginationControls">
    <button id="prevPage" disabled>Previous</button>
    <span id="currentPage">1</span>
    <button id="nextPage" disabled>Next</button>
  </div>

  </div>

  <!-- Modal of View and Ingredient -->
  <div class="modal fade" id="viewProductModal" tabindex="-1" aria-labelledby="viewProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content viewContent">
        <div class="modal-header product-Header">
          <h5 class="modal-title" id="viewProductModalLabel">Product Edit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="viewProduct">
            <form action="">
              <div class="productBody">
                <div class="ingredientBody">
                  <div class="ingredientHeader">
                    <h2 class="ingredientHeading">Ingredients</h2>
                    <a type="button" class="ingredientBtn btn btn-primary" data-bs-toggle="modal" data-bs-target="#ingredientModal">
                      <i class="plusIcon bi bi-plus"></i>
                    </a>
                  </div>
                  <div class="ingredientHeaderTwo">
                    <div class="ingredientLabel">
                      <table class="tableIngredient">
                        <thead class="headerRow">
                          <tr>
                            <td class="ingred">Ingredients</td>
                            <td class="ingred">Quantity</td>
                            <td class="ingredientAction">Action</td>
                          </tr>
                        </thead>
                      </table>
                    </div>

                    <div class="ingredientBodyModal modal-body">
                      <ul class="ingredientBodyMowdal product-ingredients">


                      </ul>
                    </div>


                  </div>
                </div>

                <div class="productPicture">
                  <img src="../assets/images/1x1.jpg" class="productImg">
                </div>

                <div class="productDetails">
                  <div class="productInput">
                    <input type="hidden" id="productId" name="productId">
                    <label for="prodName" class="productLabel">Product Name:</label>
                    <input type="text" name="productName" id="productName" class="productName">
                  </div>
                  <div class="productInput">
                    <label for="prodCategory" class="productLabel">Product Category: </label>
                    <select class="t-input form-control w-75" aria-label="category" name="productCategory" id="productCategory">
                      <?php
                      include '../pages/include/dbConnection.php';

                      // Read all rows from the database
                      $sql = "SELECT * FROM product_category";
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
                  <div class="productInput">
                    <label for="prodPrice" class="productLabel">Product Price:</label>
                    <input type="text" id="productPrice" name="productPrice" class="productPrice">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer viewIngredient">
          <button type="button" class="btnIngredient deletebtn  btn btn-secondary" data-dismiss="modal">Delete</button>
          <button type="button" class="btnIngredient updatebtn btn btn-secondary" data-bs-dismiss="modal">Update</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for plus Icon -->
  <div class="modal fade" id="ingredientModal" tabindex="-1" aria-labelledby="ingredientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content plusIconModalContent">
        <div class="modal-header">
          <h5 class="modal-title" id="ingredientModalLabel">Add Ingredients</h5>
          <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#viewProductModal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body fade-up plusIconModal">
          <form id="ingredientForm">
            <div class="mb-3">
              <label for="ingredientName" class="form-label ">Product</label>

              <select class="t-input form-control w-75" aria-label="category" name="product_ingredients" id="product_ingredients">
                <?php
                include '../pages/include/dbConnection.php';

                // Read all rows from the database
                $sql = "SELECT * FROM ingredients";
                $result = $conn->query($sql);

                if (!$result) {
                  die("Invalid query: " . $conn->error);
                }

                // Read data for each row
                while ($row = $result->fetch_assoc()) {
                  echo '<option value="' . $row["ingredients_id"] . '">' . $row["raw_name"] . '</option>';
                }
                ?>
              </select>

            </div>
            <div class="mb-3">
              <label for="ingredientQuantity" class="form-label ">Quantity</label>
              <input type="text" class="form-control plusInput" id="productingredientQuantity" placeholder="Enter quantity">
            </div>
            <button id="add_ingredientsbtn" data-bs-toggle="modal" data-bs-target="#viewProductModal" class="btn btn-dark btn-plus">Add</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Include Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Modal for Category List -->
  <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="categorycontent modal-content">
        <div class="modal-header categoryMowdal">
          <h1 class="modal-title fs-4" id="ModalLabel">Category</h1>
          <button type="button" id="plusbtn" class=" bi bi-plus-lg mt-1" data-bs-target="#Category" data-bs-toggle="modal"></button>
        </div>
        <div class="category modal-body">
          <ul class="list-group">

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
          <button type="button" class="btn btn-dark" id="add_category" data-bs-target="#Category" data-bs-toggle="modal">Add</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for Adding Ingredients -->
  <div class="modal fade" id="Add" tabindex="-1" aria-labelledby="AddLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="add-content modal-content">
        <div class="add modal-header">
          <h1 class="add-title modal-title fs-4" id="AddLabel">Add Product</h1>
          <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="add-body modal-body">
          <div class="add-ingredient input-group mb-3 d-block">
            Product
            <input type="text" class="t-input form-control w-75" aria-label="product-add" id="product-add">
          </div>
          <div class="add-category input-group mb-3 d-block">
            Category
            <select class="t-input form-control w-75" aria-label="category" name="product_categoryadd" id="product_categoryadd">
              <?php
              include '../pages/include/dbConnection.php';

              // Read all rows from the database
              $sql = "SELECT * FROM product_category";
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
            Price
            <input type="text" class="t-input form-control w-75" aria-label="priceadd" id="priceadd">
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

  <script>
    // JavaScript to handle the fade-up effect
    document.addEventListener('shown.bs.modal', function(event) {
      var modalBody = document.querySelector('#ingredientModal .modal-body');
      modalBody.classList.add('show');
    });

    document.addEventListener('hidden.bs.modal', function(event) {
      var modalBody = document.querySelector('#ingredientModal .modal-body');
      modalBody.classList.remove('show');
    });
  </script>


  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script src="script/product.js"></script>
  <script src="script/product_ingredients.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>