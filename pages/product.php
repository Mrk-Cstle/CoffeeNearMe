<?php include '../assets/template/navigation.php'; ?>
<?php include 'include/access.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <title>Document</title>

  <link rel="stylesheet" href="../assets/design/product.css">

</head>

<body>

  <div class="container">
    <h3 class="headDash">Product</h3>
    <form action="">
      <div class="productTable">

        <div class="topbtn">
          <button <?php echo hasAccess('admin') ? '' : 'disabled'; ?> type="button" data-bs-toggle="modal" data-bs-target="#Modal" class=" btn btn-dark me-1">Category</button>
          <button <?php echo hasAccess('admin') ? '' : 'disabled'; ?> type="button" data-bs-toggle="modal" data-bs-target="#Add" class=" btn btn-dark me-1">Add Product</button>
          <!-- <a href="transactionDetails.php" class=" btn btn-dark me-1">Transaction History</a> -->
          <select class=" btn btn-dark me-1" aria-label="categoryFilter" name="categoryFilter" id="categoryFilter">
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

          <input id="searchInput" class="form-control mr-sm-2 me-1 searchInput" type="search" placeholder="Search" aria-label="Search">
    </form>
  </div>
  </div>
  <table class="tableProductsInfo" id="products">
    <thead class="tableProductsInfo" id="theadProducts">
      <tr class="tableRowProductsInfo">
        <td class="tableProductsInfo">Picture</td>
        <td class="tableProductsInfo">Product Category</td>
        <td class="tableProductsInfo">Product Name</td>
        <td class="tableProductsInfo">Price</td>
        <td class="tableProductsInfo">Cost</td>

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
            <form class="product-image" role="form" autocomplete="off" enctype="multipart/form-data">
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
                            <td>
                              <div class="grid-cell">Ingredients</div>
                            </td>
                            <td>
                              <div class="grid-cell">Quantity</div>
                            </td>
                            <td>
                              <div class="grid-cell">Action</div>
                            </td>
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


                <input type="file" name="product_image" id="product_image" placeholder="Enter something" required>
                <button class="imageButton" type="submit" data-ingredients-id="">Submit</button>

                <div class="productDetails">
                  <div class="productInput">
                    <input type="hidden" id="productId" name="productId" required>
                    <label for="prodName" class="productLabel">Product Name:</label>
                    <input type="text" name="productName" id="productName" class="productName" required>
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
                    <input type="number" id="productPrice" name="productPrice" class="productPrice" required>
                  </div>
                  <div class="productInput">
                    <label for="prodCost" class="productLabel">Product Cost:</label>
                    <input type="number" id="productCost" name="productCost" class="productCost" required>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer viewIngredient">
          <button type="button" class="btnIngredient deletebtn  btn btn-secondary">Delete</button>
          <button type="button" class="btnIngredient updatebtn btn btn-secondary">Update</button>
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

              <!--LABEL INGREDIENT-->
              <div class="labelIngredient">
                <label for="ingredientName" class="form-label ">Ingredient</label>
                <label for="ingredientQuantity" class="form-label ">Quantity</label>
                <label for="ingredientGrams" class="form-label" id="unitMeasure">Unit of Measures</label>
              </div>

              <div class="mb-3 inputIngredientCategory">
                <!--PRODUCT CATEGORY-->
                <select class="t-input form-control prod-cat" aria-label="category" name="product_ingredients" id="product_ingredients">
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
                    echo '<option value="' . $row["ingredients_id"] . '" data-unit="' . $row["unit"] . '">' . $row["raw_name"] . '</option>';
                  }
                  ?>
                </select>




                <!--QUANTITY CATEGORY-->

                <input type="text" class="form-control plusInput" id="productingredientQuantity" placeholder="Enter quantity" required>

                <!--UNIT OF MEASURES CATEGORY-->

                <select class="t-input form-control a-unit" aria-label="a_unit" name="a_unit" id="a_unit">

                  <option value="g">g</option>
                  <option value="pcs">pcs</option>
                  <option value="mL">mL</option>

                </select>
              </div>
              <p id="errorhandlingi" style="color:red;"></p>
            </div>
            <button id="add_ingredientsbtn" class="btn btn-dark btn-plus">Add</button>
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
          <h1 class="modal-title fs-5" id="ModalLabel">Category</h1>
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
              <input type="text" class="t-input form-control w-100" aria-label="category" id="category" required>
            </div>
            <p id="errorhandlingcategory" style="color:red;"></p>
          </div>

        </div>

        <div class="plusfooter modal-footer">
          <button type="button" class="btn btn-dark" id="add_category" data-bs-target="#Category">Add</button>
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
            <input type="text" class="t-input form-control w-50 add-prod" aria-label="product-add" id="product-add" required>
          </div>
          <div class="add-category input-group mb-3 d-block">
            Category
            <select class="t-input form-control w-50" aria-label="category" name="product_categoryadd" id="product_categoryadd">
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
            <input type="number" class="t-input form-control w-50" aria-label="priceadd" id="priceadd">
          </div>
          <div class="add-cost input-group mb-3 d-block">
            Cost
            <input type="number" class="t-input form-control w-50" aria-label="costadd" id="costadd">
          </div>
          <p id="errorhandling" style="color:red;"></p>
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
    const hasAdminAccess = <?php echo json_encode(hasAccess('admin')); ?>;
  </script>

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
  <script src="script/imageupload.js"></script>
  <script>
    const unitOptions = {
      kg: ['g'],
      pcs: ['pcs'],
      gal: ['mL'],

    };

    document.getElementById('product_ingredients').addEventListener('change', function() {
      const selectedIngredient = this.options[this.selectedIndex];
      const unitType = selectedIngredient.getAttribute('data-unit'); // Get unit type

      const aUnitSelect = document.getElementById('a_unit');
      aUnitSelect.innerHTML = ''; // Clear current options

      if (unitOptions[unitType]) {
        unitOptions[unitType].forEach(unit => {
          const option = document.createElement('option');
          option.value = unit;
          option.textContent = unit;
          aUnitSelect.appendChild(option);
        });
      }
    });

    // Trigger change event on page load to set initial units
    document.getElementById('product_ingredients').dispatchEvent(new Event('change'));
  </script>
</body>

</html>