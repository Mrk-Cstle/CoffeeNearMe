<!DOCTYPE html>
<?php include '../assets/template/navigation.php'; ?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Table 2</title>
</head>
<style>
  body {
    background-color: #d9d9d9;
  }

  .container {
    padding: 50px;
    margin-left: 420px;
    margin-top: 120px;
  }

  .table {
    border: 1px solid;
    margin-top: 60px;
    text-align: center;
    font-size: 18px;
    -webkit-text-fill-color: #d76614;
  }

  .search {
    height: 10%;
    width: 30%;
    display: flex;
    float: right;
  }

  .btn {
    background-color: #d76614;
    border: none;
  }

  .topbtn {
    background-color: #d76614;
    border: none;
    float: left;
    margin-left: 50px;
  }

  .categorycontent {
    background-color: #fff;
  }

  .modal-header {
    -webkit-text-fill-color: #000;
    border: rgba(0, 0, 0, 0.6);
    justify-content: space-between;
  }

  .category {
    text-decoration: none;
    -webkit-text-fill-color: #000;
    font-weight: 600;
    margin-bottom: 20px;
  }

  .plusheader {
    -webkit-text-fill-color: #000;
    border: rgba(0, 0, 0, 0.6);
    justify-content: center;
  }

  .pluscontent {
    background-color: #fff;
  }

  .plusbody {
    text-decoration: none;
    -webkit-text-fill-color: #000;
    font-weight: 600;
    padding: 0;
  }

  .items {
    background-color: #d9d9d9;
  }

  .dots {
    float: right;
  }

  .plusfooter {
    padding-right: 30px;
  }

  .t-input {
    background-color: rgba(0, 0, 0, 0.3);
    border: #d76614;
    -webkit-text-fill-color: #d76614;
  }

  .add-content {
    background-color: rgba(0, 0, 0, 0.6);
  }

  .add {
    -webkit-text-fill-color: #fff;
    border: rgba(0, 0, 0, 0.6);
  }

  .add-body {
    margin-left: 90px;
    -webkit-text-fill-color: #fff;
  }

  .add-footer {
    border: rgba(0, 0, 0, 0.6);
  }

  .add-title {
    margin-left: 145px;
  }


  .vbtn {
    -webkit-text-fill-color: #FFF;
  }
</style>

<body>
  <div class="container">

    <div>
      <button type="button" data-bs-toggle="modal" data-bs-target="#Modal" class="topbtn btn btn-dark me-1">Category</button>
      <button type="button" data-bs-toggle="modal" data-bs-target="#Add" class="topbtn btn btn-dark me-1">Add Ingredients</button>
      <button type="button" class="topbtn btn btn-dark me-1">Filter</button>
      <form class="search form-inline">
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
        <div class="modal fade" id="Add" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="add-content modal-content">
              <div class="add modal-header">
                <h1 class="add-title modal-title fs-4" id="ModalLabel">Add Ingredients</h1>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="add-body modal-body">
                <div class="add-ingredient input-group mb-3 d-block">
                  Ingredients
                  <input type="text" class="t-input form-control w-75" aria-label="ingredients" id="ingredients">
                </div>
                <div class="add-category input-group mb-3 d-block">
                  Category

                  <select class="t-input form-control w-75" aria-label="category" name="category" id="category">
                    <?php

                    include '../pages/include/dbConnection.php';

                    // Read all rows from the database
                    $sql = "SELECT * FROM ingredients_category  ";
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
        <input class="form-control mr-sm-2 me-1" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-dark my-2 my-sm-0" type="submit">Search</button>
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
    </table>
  </div>
  <script>
    $(document).ready(function() {
      function loadCategories() {

        var data = {

          action: 'reload'
        };

        $.ajax({
          type: 'POST',
          url: 'action/category_db.php', // Replace with correct path to fetch categories
          contentType: 'application/json',
          data: JSON.stringify(data),
          success: function(response) {

            if (response.status === 'success') {
              var categories = response.categories;
              var listItems = '';
              categories.forEach(function(category) {
                listItems += `
            <li class='items list-group-item'>
              ${category.category}
              <a href='#' data-category-id='${category.category_id}'  class='dots bi bi-three-dots-vertical text-dark category-delete'></a>
            </li>
          `;
              });
              $('.list-group').html(listItems); // Update DOM with new categories
              console.error('loading categories: ' + response.message);

            } else {
              console.error('Error loading categories: ' + response.message);
            }
          },
          error: function(xhr, status, error) {
            console.error('Error loading categories:', status, error);
            console.log('XHR object:', xhr); // Log the entire XHR object for more details
            if (xhr.responseText) {
              console.log('Response text:', xhr.responseText); // Log the response text if available
            }
            // Handle any additional error details as needed
          }
        });
      }

      $('#add_category').click(function() {
        var category = $('#category').val();
        var data = {
          category: category,
          action: 'add'
        }
        sendAjaxRequest(data);
      });

      $(document).on('click', '.dots', function() {

        var categoryId = $(this).data('category-id');

        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            var data = {
              categoryId: categoryId,
              action: 'delete'
            };
            sendAjaxRequest(data);
          }
          // var data = {
          //   categoryId: categoryId,
          //   action: 'delete'
          // }
          // sendAjaxRequest(data);
        });
      });

      function sendAjaxRequest(data) {
        $.ajax({
          type: 'POST',
          url: 'action/category_db.php', // replace with your server endpoint
          data: JSON.stringify(data),
          contentType: 'application/json',

          success: function(response) {

            console.log(response);
            // Optionally close the modal
            if (response.status === 'success') {
              Swal.fire({
                title: 'Success',
                text: response.message,
                icon: 'success',
                confirmButtonText: 'OK'
              });
              loadCategories();

            } else {

              Swal.fire({
                title: 'Error',
                text: response.message,
                icon: 'error',
                confirmButtonText: 'OK'
              });
            }
            $('#Category').modal('hide');
          },
          error: function(error) {
            // Handle any errors
            console.error(error);
          }
        });
      }
      loadCategories();


      //for ingredients ajax

      function loadIngredients() {
        var data = {

          action: 'reload'
        };
        $.ajax({
          type: 'POST',
          url: 'action/ingredients_db.php', // Replace with correct path to fetch categories
          contentType: 'application/json',
          data: JSON.stringify(data),
          success: function(response) {

            if (response.status === 'success') {
              var ingredients = response.ingredients;
              var listItems = '';

              ingredients.forEach(function(ingredient) {
                var lowStock = ingredient.quantity < 0.8 * ingredient.ideal_quantity;
                var BackgroundColor = lowStock ? '#FA8072' : '';
                listItems += `
                    <tr >
                            <td>${ingredient.picture}</td>
                            <td style="background-color: ${BackgroundColor};" >${ingredient.raw_name}</td>
                            <td >${ingredient.quantity}</td>
                            <td>${ingredient.ideal_quantity}</td>
                            
                            
                            <td>
                                <a data-ingredients-id='${ingredient.ingredients_id}' class='vbtn btn btn-primary btn-sm' href='ingredients_edit.php?id=${ingredient.ingredients_id}'>Edit</a>
                                <a data-ingredients-id='${ingredient.ingredients_id}' class='deletebtn vbtn btn btn-dark btn-sm' >Delete</a>
                            </td>
                        </tr>

          `;
              });
              $('.ingredients-tbl').html(listItems); // Update DOM with new categories
              console.error('loading categories: ' + response.message);

            } else {
              console.error('Error loading categories: ' + response.message);
            }
          },
          error: function(xhr, status, error) {
            console.error('Error loading categories:', status, error);
            console.log('XHR object:', xhr); // Log the entire XHR object for more details
            if (xhr.responseText) {
              console.log('Response text:', xhr.responseText); // Log the response text if available
            }
            // Handle any additional error details as needed
          }
        });
      }
      $(document).on('click', '.deletebtn', function() {

        var ingredients_id = $(this).data('ingredients-id');
        // var data = {
        //   ingredients_id: ingredients_id,
        //   action: 'delete'
        // }
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            var data = {
              ingredients_id: ingredients_id,
              action: 'delete'
            }
            ingredientsAjaxRequest(data);
          }
          // var data = {
          //   categoryId: categoryId,
          //   action: 'delete'
          // }
          // sendAjaxRequest(data);
        });
        // ingredientsAjaxRequest(data);
      });

      $('#saveChanges').click(function() {
        var ingredients = $('#ingredients').val();
        var category = $('#category').val();
        var qty = $('#qty').val();
        var ideal_qty = $('#ideal_qty').val();

        var data = {
          ingredients: ingredients,
          category: category,
          qty: qty,
          ideal_qty: ideal_qty,
          action: 'add'
        }
        ingredientsAjaxRequest(data);
      });

      function ingredientsAjaxRequest(data) {
        $.ajax({
          type: 'POST',
          url: 'action/ingredients_db.php', // replace with your server endpoint
          data: JSON.stringify(data),
          contentType: 'application/json',

          success: function(response) {

            console.log(response);
            // Optionally close the modal
            if (response.status === 'success') {
              Swal.fire({
                title: 'Success',
                text: response.message,
                icon: 'success',
                confirmButtonText: 'OK'
              });

              loadIngredients();
            } else {
              Swal.fire({
                title: 'Error',
                text: response.message,
                icon: 'error',
                confirmButtonText: 'OK'
              });
            }
            $('#Add').modal('hide');
          },
          error: function(error) {
            // Handle any errors
            console.error(error);
          }
        });
      }
      loadIngredients();
    });
  </script>
</body>

</html>