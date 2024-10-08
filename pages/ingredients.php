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

  <!-- Google Fonts Link -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

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
    -webkit-text-fill-color: #000;
    font-weight: normal;
  }

  .add-content {
    background-color: #d9d9d9
  }

  .add {
    -webkit-text-fill-color: #fff;
    border: rgba(0, 0, 0, 0.6);
  }

  .add-body {
    margin-left: 90px;
    font-weight: bold;
    -webkit-text-fill-color: #000;
  }

  .add-footer {
    border: rgba(0, 0, 0, 0.6);
  }

  .add-title {
    margin-left: 145px;
  }


  .vbtn {
    -webkit-text-fill-color: #d76614;
    font-size: 20px;
  }

  /*Edit Modal Form CSS*/
  #editModal {
    border: 2px solid #d9d9d9;
    border-radius: 25px;
    height: 590px;
    width: 1070px;
    background-color: #d9d9d9;
    position: absolute;
    top: 50%;
    left: 52%;
    transform: translate(-50%, -50%);
  }

  #modal-body {
    background-color: #d9d9d9;
    height: 430px;
    width: 750px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    margin-top: 288px;
    display: flex;
  }

  #modal-header {
    background-color: #d9d9d9;
    width: 750px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    margin-top: 40px;
  }

  .modal-title {
    font-family: "Poppins", sans-serif;
    font-weight: 700;
    font-style: italic;
    margin-left: 5px;
    -webkit-text-fill-color: #000;
  }

  #editModalLabel {
    margin-left: 306px;
  }

  .form-group {
    margin-left: 60px;
    font-family: "Poppins", sans-serif;
    font-weight: 500;
    font-style: italic;
    font-size: 18px;
    margin-top: 20px;
  }

  .ingredientProfile {
    border-radius: 50%;
    height: 150px;
    width: 150px;
    margin-top: 20px;
    margin-left: 14px;
  }

  #ingredientPicture {
    border: 2px solid white;
    height: 190px;
    width: 190px;
    border-radius: 10px;
    background-color: #fff;
    margin-left: 15px;
    margin-top: 15px;
  }

  #name {
    margin-left: 5px;
    border: 2px solid #000;
    border-radius: 10px;
    width: 250px;
  }

  #qty {
    margin-left: 5px;
    border: 2px solid #000;
    border-radius: 10px;
    width: 333px;
  }

  #ideal_qty {
    margin-left: 5px;
    border: 2px solid #000;
    border-radius: 10px;
    width: 282px;
  }

  #picture {
    margin-left: 5px;
    border: 2px solid #d76614;
    border-radius: 10px;
    width: 345px;
  }

  .btnn {
    margin-top: 120px;
    float: right;
    height: 15px;
  }

  #btn {
    height: 35px;
    margin: 5px;
  }

  .borderr {
    border: 2px solid white;
    border-radius: 15px;
    background-color: white;
    height: 300px;
    width: 450px;
    margin-left: 125px;
  }

  #category {
    border: 2px solid #000;
  }

  #ingredients {
    border: 2px solid #000;
  }

  #ingredients_image{
    margin-top: 50px;
  }
  .imageButton{
    margin-top: 20px;
    border: 2px solid #d76614;
    background-color: #d76614;
    color: white;
    height: 35px;
    width: 80px;
    border-radius: 10px;
  }

  /*Drop Down CSS */

  .dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-btn {
    padding: 10px;
    font-size: 18px;
    margin-top: 50px;
    border: transparent;
    background-color: transparent;
}

.dropdown-content {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    background-color: #fff;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: #d76614;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    font-weight: bold;
}

.dropdown-content a:hover {
    background-color: #2c2c2c;
    color: #fff; 
}


.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropdown-btn {
    background-color: transparent;
}


.threeIcon{
  height: 35px;
  width: 35px;
}

/*Table Revise CSS */
td{
  text-align: center;
}

/* STOCKS CSS */

.stockIn{
    background-color: #d9d9d9;
    border: 1px solid #d9d9d9;
    border-radius: 10px;
    height: 430px;
    width: 450px;
    position: absolute;
    margin-top: 450px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.stockINHeader{
    margin-left: 150px;
    font-size: 20px;
    margin-top: 20px;
}
.stockIn-FirstForm{
    display: inline-flex;
}   
.stockInput{
    position: fixed;
    border: 2px solid #d9d9d9;
    border-radius: 10px;
    height: 200px;
    width: 352px;
    margin-left: 30px;
    margin-top: 0px;
    background-color: #fff;
}
.spanQty{
    margin-left: 40px;
    font-weight: bold;
    
}
.stockQty{
    background-color: #D9D9D9;
    margin-left: 10px;
    margin-top: 10px;
    width: 200px;
    height: 35px;
    border: 2px solid #d9d9d9;
    border-radius: 10px;
    text-align: center;
    font-weight: bold;
}

.stockIn-SecondForm{
    background-color: #fff;
    border: 2px solid black;
    border-radius: 10px;
    height: 167px;
    width: 290px;
    margin-left: 70px;
    margin-top: 30px;
}
.ingre{
    margin-left: 20px;
    font-size: 18px;
    font-weight: normal;
    margin-top: 20px;
}
.ingreText{
    font-size: 20px;
    font-weight: bold;
    margin-left: 40px;
}
.stockBtnClose{
    color: #fff;
    background-color: #D76614CC;
    border: 2px solid #D76614CC;
    border-radius: 10px;
    height: 35px;
    width: 90px;
    margin-top: 20px;
}
.stockBtnUpdate{
    color: #fff;
    background-color: #D76614CC;
    border: 2px solid #D76614CC;
    border-radius: 10px;
    height: 35px;
    width: 90px;
    margin-top: 20px; 
}
.stockBtn{
    text-align: center;
    float: right;
    margin-right: 20px;
    margin-top: 70px;
}
.stockclose{
  border: 1px solid #d9d9d9;
  height: 50px;
  width: 30px;
  font-size: 30px;
  background-color: #d9d9d9;
  margin-right: 20px;
}


</style>

<body>
  <div class="container">

    <div>
      <button type="button" data-bs-toggle="modal" data-bs-target="#Modal" class="topbtn btn btn-dark me-1">Category</button>
      <button type="button" data-bs-toggle="modal" data-bs-target="#Add" class="topbtn btn btn-dark me-1">Add Ingredients</button>

      <select class="topbtn btn btn-dark me-1" aria-label="categoryFilter" name="categoryFilter" id="categoryFilter">
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
              <div class="add modal-header header-Modal">
                <h1 class="add-title modal-title fs-4" id="modalLabel">Add Ingredients</h1>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="add-body modal-body">
                <div class="add-ingredient input-group mb-3 d-block">
                  Ingredients
                  <input type="text" class="t-input form-control w-75" aria-label="ingredients" id="ingredients">
                </div>
                <div class="add-category input-group mb-3 d-block">
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
        <input id="searchInput" class="form-control mr-sm-2 me-1" type="search" placeholder="Search" aria-label="Search">

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
              <button type="button" class="btn btn-dark close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="form modal-body" id="modal-body">

              <div class="" id="ingredientPicture">

                <img src="" class="ingredientProfile">
                <form class="ingredients-image" role="form" autocomplete="off" enctype="multipart/form-data">
                  <div class="ingr_mage">
                  <input type="file" name="ingredients_image" id="ingredients_image" placeholder="Enter something">
                  <button class="imageButton" type="submit" data-ingredients-id="">Submit</button>
                  </div>
                </form>
              </div>
              <div>
                <div class="borderr">
                  <div class="form-group">
                    <input type="hidden" id="ingredient-id" name="ingredient_id">
                    <label for="names">Ingredients Name</label>
                    <input type="text" name="names" id="names" placeholder="Enter Ingredients Name" required>
                  </div>
                  <div class="form-group">

                    <label for="categorys">Category</label>
                    <select class="t-input form-control w-75" aria-label="categorys" name="categorys" id="categorys">


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
                    <input type="number" name="qtys" id="qtys" placeholder="Enter Quantity" required>

                  </div>
                  <div class="form-group">
                    <label for="ideal_qtys">Ideal Quantity</label>
                    <input type="number" name="ideal_qtys" id="ideal_qtys" placeholder="Enter Ideal Quantity" required>
                  </div>
                  <div class="btnn">
                    <a class='deletebtn btn btn-dark' id="btn">Delete</a>

                    <a class="updatebtn btn btn-dark" id="btn">Update</a>
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
                            <p class="ingreText">Mango Cake</p>
                            <span class="spanQty">Quantity:</span>
                            <input type="number" class="stockQty" required><br>
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
                            <input type="number" class="stockQty" required><br>
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
  <script src="script/ingredients.js"></script>
  <script src="script/imageupload.js"></script>
</body>

</html>