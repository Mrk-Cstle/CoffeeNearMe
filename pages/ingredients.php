<!DOCTYPE html>
<?php include '../assets/template/navigation.php'; ?>
<?php include 'include/access.php'; ?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Google Fonts Link -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


  <!-- INGREDIENT CSS-->
   <link rel="stylesheet" href="../assets/design/ingredient.css">
  <title>Table 2</title>
</head>


<body>
  <div class="container">

    <h3 class="headDash">Ingredient</h3>
    <div class="topbtn">
      <!-- <a href="actionInventory.php" class=" btn btn-dark me-1">Inventory Actions</a> -->
      <button <?php echo hasAccess('admin') ? '' : 'disabled'; ?> type="button" data-bs-toggle="modal" data-bs-target="#Modal" class=" btn btn-dark me-1">Category</button>

      <button <?php echo hasAccess('admin') ? '' : 'disabled'; ?> type="button" data-bs-toggle="modal" data-bs-target="#Add" class=" btn btn-dark me-1">Add Ingredients</button>

      <select class=" btn btn-dark me-1" aria-label="categoryFilter" name="categoryFilter" id="categoryFilter">
        <option value="">Filter</option>
        <?php

        include '../pages/include/dbConnection.php';

        // Read all rows from the database
        $sql = "SELECT * FROM ingredients_category";
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
      <input id="searchInput" class="form-control mr-sm-2 me-1" type="search" placeholder="Search" aria-label="Search">
      <form class="search form-inline">

    </div>
    <div>
      <!-- Modal -->
      <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="categorycontent modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-4" id="ModalLabel">Category</h1>
              <a type="button" class="plusbtn bi bi-plus-lg mt-1" data-bs-target="#Category" data-bs-toggle="modal"></a>
            </div>
            <div class="category modal-body">
              <ul class="list-group">

                <!-- <li class="items list-group-item">aad
                    <a href="" class="dots bi bi-three-dots-vertical text-dark"></a> -->
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="Category" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="pluscontent modal-content">
            <div class="plusheader modal-header">
              <h1 class="modal-title fs-4" id="ModalLabel">Add New Category</h1>
            </div>
            <div class="plusbody modal-body">
              <div class="userbody modal-body">
                <div class="user input-group mb-3 d-block"> Category
                  <input type="text" class="t-input form-control w-100" aria-label="category" id="category" required>
                </div>
              </div>
              <p id="errorhandlingcategory" style="color: red"></p>
            </div>
            <div class="plusfooter modal-footer">
              <button type="button" class="btn btn-dark" id="add_category">Add</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="Add" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="add-content modal-content">
            <div class="add modal-header header-Modal">
              <h3 class="add-title modal-title fs-5" id="modalLabel ">Add Ingredients</h3>
              <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="add-body modal-body">
              <div class="add-ingredient input-group mb-1 d-block">
                Ingredients
                <input type="text" class="t-input form-control w-75" aria-label="ingredients" id="ingredients" required>
              </div>
              <div class="add-category input-group mb-1 d-block">
                Category

                <select class="t-input form-control w-75" aria-label="category" name="icategory" id="icategory">
                  <?php

                  include '../pages/include/dbConnection.php';

                  // Read all rows from the database
                  $sql = "SELECT * FROM ingredients_category";
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
              </div>


              <div class="add-quantity input-group mb-3 d-block">
                Quantity
                <input type="number" class="t-input form-control w-75" aria-label="qty" id="qty">

                Unit
                <select class="t-input form-control w-75" aria-label="a_unit" name="a_unit" id="a_unit" required>

                  <option value="kg">kg</option>
                  <option value="pcs">pcs</option>
                  <option value="gal">gal</option>

                </select>
              </div>


              <div class="add-ideal input-group mb-1 d-block">
                Ideal Quantity
                <input type="number" class="t-input form-control w-75" aria-label="ideal_qty" id="ideal_qty" required>
              </div>

              <p id="errorhandling" style="color:red;"></p>
            </div>


            <div class="add-footer modal-footer">
              <button type="button" class="btn btn-dark me-2 btn-Ingredient" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-dark btn-Ingredient" id="saveChanges">Add</button>
            </div>
          </div>
        </div>
      </div>


      </form>
    </div>
    <table class=" table table-hover table-bordered">
      <thead>
        <tr>
          <th style="background-color: #2c2c2c;" scope="col">Picture</th>
          <th style="background-color: #2c2c2c;" scope="col">Ingredient</th>
          <th style="background-color: #2c2c2c;" scope="col">Quantity</th>
          <th style="background-color: #2c2c2c;" scope="col">Ideal Quantity</th>
          <th style="background-color: #2c2c2c;" scope="col">Action</th>
        </tr>
      </thead>
      <tbody class="ingredients-tbl">



      </tbody>

      <!-- Modal Ingredient Edit -->
      <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header" id="modal-header">
              <h5 class="modal-title" id="editModalLabel">Ingredients Edit</h5>
              <button type="button" class=" btn-dark close " id="close-btn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="form modal-body" id="modal-body">

              <div class="" id="ingredientPicture">

                <img src="" class="ingredientProfile">
                <form class="ingredients-image" role="form" autocomplete="off" enctype="multipart/form-data">
                  <div class="ingr_mage">
                    <input type="file" name="ingredients_image" id="ingredients_image" placeholder="Enter something" required>
                    <button class="imageButton" type="submit" data-ingredients-id="">Submit</button>
                  </div>
                </form>
              </div>
              <div>
                <div class="borderr">
                  <div class="form-group">
                    <input type="hidden" id="ingredient-id" name="ingredient_id" required>
                    <label for="names">Ingredients Name</label>
                    <input type="text" name="names" id="names" placeholder="Enter Ingredients Name" required>
                  </div>
                  <div class="form-group">

                    <label for="categorys">Category</label>
                    <select class="t-input form-control w-75" aria-label="categorys" name="categorys" id="categorys" required>


                      <?php

                      include '../pages/include/dbConnection.php';


                      $sql = "SELECT * FROM ingredients_category ";
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
                  </div>
                  <div class="form-group">
                    <label for="qtys">Quantity</label>
                    <input type="number" name="qtys" id="qtys" placeholder="Enter Quantity" readonly>

                  </div>
                  <div class="form-group">
                    <label for="ideal_qtys">Ideal Quantity</label>
                    <input type="number" name="ideal_qtys" id="ideal_qtys" placeholder="Enter Ideal Quantity" required>
                  </div>
                  <div class="btnn">
                    <a class='deletebtn btn-dark' id="btn" data-dismiss="modal">Delete</a>

                    <a class="updatebtn btn-dark" id="btn">Update</a>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        <!-- Bootstrap and jQuery JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </table>

    <div id="paginationControls">
      <button id="prevPage" disabled>Previous</button>
      <span id="currentPage">1</span>
      <button id="nextPage" disabled>Next</button>
    </div>

    <!-- Bootstrap Modal For Stock In -->
    <div class="modal fade" id="stockINModal" tabindex="-1" aria-labelledby="stockModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content stockIn">
          <div class="modal-header">
            <h5 class="modal-title stockINHeader" id="stockModalLabel">Stock In</h5>
            <button type="button" class="stockclose" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="stockIn-FirstForm">

              <div class="stockInput">
                <p class="ingre">Stock</p>
                <p class="ingreText"></p>
                <span class="spanQty">Quantity:</span>
                <input type="number" id="stockinQty" class="stockQty" required>
                <input type="text" id="stockinunit" class="stockinunit" readonly>
                <br>
                <div class="stockBtn">
                  <button class="stockBtnClose" data-dismiss="modal">Close</button>
                  <button class="stockBtnUpdate">Update</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap Modal For Stock Out -->
    <div class="modal fade" id="stockOUTModal" tabindex="-1" aria-labelledby="stockModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content stockIn">
          <div class="modal-header">
            <h5 class="modal-title stockINHeader" id="stockModalLabel">Stock Out</h5>
            <button type="button" class="stockclose" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="stockIn-FirstForm">
              <div class="stockInput">
                <p class="ingre">Stock</p>
                <p class="ingreText">Mango Cake</p>
                <span class="spanQty">Quantity:</span>
                <input id="stockoutQty" type="number" class="stockQty" required>
                <input type="text" id="stockoutunit" class="stockoutunit" readonly><br>
                <div class="stockBtn">
                  <button class="stockBtnClose" data-dismiss="modal">Close</button>
                  <button class="stockBtnUpdate">Update</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <script>
    const hasAdminAccess = <?php echo json_encode(hasAccess('admin')); ?>;
  </script>
  <script src="script/ingredients.js"></script>
  <script src="script/imageupload.js"></script>
</body>

</html>