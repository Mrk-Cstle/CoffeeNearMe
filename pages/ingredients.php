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
  *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    
  }
  body {
    background-color: #d9d9d9;
    position: fixed;
    overflow: hidden;
  }
  

  .container {
    width: 80%;
    max-width: 1200px;
    padding: 10px;
    margin: 0 auto;
    padding-left: 100px;
    margin-top: 100px;
    margin-left: 400px;
  }

  .table {
    position: relative;
    border: 1px solid;
    width: 80%;
    min-width: 400px;
    height: auto;
    margin-top: 30px;
    text-align: center;
    font-size: 1em;
    -webkit-text-fill-color: #fff;
  }

  .search {
    height: 10%;
    width: 5%;
    display: flex;
    float: right;
    margin-right: 220px;
  }

  .btn {
    background-color: #d76614;
    border: none;
  }

  .topbtn {
    display: flex;
    margin: 0 0 0 auto;
    justify-content: space-evenly;
    font-size: 1rem;
    
  }

  #searchInput{
    width: 20%;
    height: 40px;
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

.add-quantity{
    display: flex;
  }

  #add-qty{
    border: none;
    border-radius: 10px;
  }

  #a_unit{
    margin-top: 0px;
    border: none;
    border-radius: 10px;
  }

  .add-footer {
    border: rgba(0, 0, 0, 0.6);
  }

  .add-title {
    margin-left: 145px;
    -webkit-text-fill-color: #000;
  }


  .vbtn {
    -webkit-text-fill-color: #d76614;
    font-size: 20px;
  }

  /* Edit Modal overall styles */
  .modal-content {
    border-radius: 10px;
    padding: 10px;
    background-color: #f9f9f9;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    margin-top: 120px;
  }

  /* Header styles */
  .modal-header {
    border-bottom: 1px solid #ddd;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 15px;
  }

  .modal-title {
    font-size: 1.5rem;
    font-weight: bold;
  }

  .close {
    font-size: 1.5rem;
  }

  #close-btn{
    font-size: 2rem;
    border: none;
    background-color: transparent;
  }

  /* Body styles */
  #modal-body {
    display: flex;
    flex-direction: column;
    gap: 15px;
    padding: 15px;
  }

  /* Image styles */
  .ingredientProfile {
    display: block;
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 50%;
    margin: 0 auto 20px;
  }

  /* Form group styles */
  .form-group {
    display: flex;
    flex-direction: column;
    gap: 5px;
  }

  .form-group label {
    font-weight: bold;
  }

  

  /* Button styles */
  .btnn {
    display: flex;
    justify-content: space-between;
    margin-top: 15px;
  }

  .btn {
    padding: 10px 15px;
    font-size: 1rem;
    border-radius: 5px;
    width: 20%;
    height: 40px;
  }
  
  .imageButton{
    background-color: #d76614;
    border: 1px solid  #d76614;
    width: 5vw;
    height: 4vh;
    color: #fff;
    border-radius: 10px;

  }
  #ingredients_image::-webkit-file-upload-button {
      background-image: linear-gradient(45deg, rgb(215, 102, 20), #000);
      color: #fff;
      padding: 8px 16px;
      border: none;
      border-radius: 50px;
      cursor: pointer;
    }


  /*Drop Down CSS */

  .dropdown {
    position: relative;
    display: inline-block;
  }

  .dropdown-btn {
    padding: 10px;
    font-size: 18px;
    margin-top: 10px;
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
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
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


  .threeIcon {
    height: 35px;
    width: 35px;
  }

  /*Table Revise CSS */
  td {
    text-align: center;
  }

  /* STOCKS CSS */

  .stockIn {
    background-color: #d9d9d9;
    border: 1px solid #d9d9d9;
    border-radius: 10px;
    height: 400px;
    width: 400px;
    position: absolute;
    margin-top: 450px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  .stockINHeader {
    margin-left: 150px;
    font-size: 20px;
    margin-top: 20px;
  }

  .stockIn-FirstForm {
    display: inline-flex;
  }


  .stockInput {
    position: fixed;
    border: 2px solid #d9d9d9;
    border-radius: 10px;
    height: 180px;
    width: 80%;
    margin-left: 20px;
    margin-top: 0px;
    background-color: #fff;
  }

  .spanQty {
    margin-left: 40px;
    font-weight: bold;

  }

  .stockQty {
    background-color: #D9D9D9;
    margin-left: 10px;
    margin-top: 10px;
    width: 30%;
    height: 35px;
    border: 2px solid #d9d9d9;
    border-radius: 10px;
    text-align: center;
    font-weight: bold;
  }

  .stockinunit{
    width: 15%;
    height: 35px;
    background-color: #d9d9d9;
    font-size: 1em;
    color: #000;
    border: 1px solid transparent;
    border-radius: 10px;
    font-weight: bold;
    text-align: center;
  }

  .stockoutunit{
    width: 15%;
    height: 35px;
    background-color: #d9d9d9;
    font-size: 1em;
    color: #000;
    border: 1px solid transparent;
    border-radius: 10px;
    font-weight: bold;
    text-align: center;
  }

  .stockIn-SecondForm {
    background-color: #fff;
    border: 2px solid black;
    border-radius: 10px;
    height: 167px;
    width: 290px;
    margin-left: 70px;
    margin-top: 30px;
  }

  .ingre {
    margin-left: 20px;
    font-size: 18px;
    font-weight: normal;
    margin-top: 20px;
  }

  .ingreText {
    font-size: 20px;
    font-weight: bold;
    margin-left: 40px;
  }

  .stockBtnClose {
    color: #fff;
    background-color: #D76614CC;
    border: 2px solid #D76614CC;
    border-radius: 10px;
    height: 35px;
    width: 90px;
    margin-top: 0px;
  }

  .stockBtnUpdate {
    color: #fff;
    background-color: #D76614CC;
    border: 2px solid #D76614CC;
    border-radius: 10px;
    height: 35px;
    width: 90px;
    margin-top: 0px;
  }

  .stockBtn {
    text-align: center;
    float: right;
    margin-right: 20px;
    margin-top: 70px;
  }

  .stockclose {
    border: 1px solid #d9d9d9;
    height: 50px;
    width: 30px;
    font-size: 30px;
    background-color: #d9d9d9;
    margin-right: 20px;
  }

  .updatebtn{
    border: 1px solid #d9d9d9;
    border-radius: 5px;
    width: 80px;
    height: 35px;
    background-color: #d76614;
    color: #fff;
    text-align: center;
    font-size: 1em;
    text-decoration: none;
  }

  .deletebtn{
    border: 1px solid #d9d9d9;
    border-radius: 5px;
    width: 80px;
    height: 35px;
    background-color: #d76614;
    color: #fff;
    text-align: center;
    font-size: 1em;
    text-decoration: none;
  }

  /*Table CSS */

  .ingredients-tbl,
  td {
    -webkit-text-fill-color: #000;
    font-weight: 700;
  }

  /*Pagination*/

  #paginationControls {
        position: relative;
        float: left;
        padding: 10px;
        background-color: #f2f2f2;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    #prevPage, #nextPage {
        background-color: #d76614; 
        color: white; 
        border: none; 
        border-radius: 5px; 
        padding: 5px 10px; 
        margin: 0 5px; 
        cursor: pointer; 
        transition: background-color 0.3s; 
    }

    #prevPage:disabled, #nextPage:disabled {
        background-color: #ccc; 
        cursor: not-allowed; 
    }

    #prevPage:not(:disabled):hover, #nextPage:not(:disabled):hover {
        background-color: #2c2c2c; 
    }

    #currentPage {
        margin: 0 10px; 
        font-weight: bold; 
        font-size: 16px; 
    }
    

    /* Responsive design */

    @media (max-width: 1400px) {
    .container{
      width: 80%;
      height: 700px;
      margin: 100px auto 0 300px; 
      padding: 10px;
      max-width: 900px;
      margin-top: 100px;
      margin-right: auto;
      overflow: hidden;
    }

    .table{
      width: 80%;
      padding: 10px;
    }

    .topbtn{
      display: flex;
      margin: 0 auto 0 40px;
      width: 100%;
      overflow: hidden;
    }

    #searchInput{
      width: 100%;
      height: 40px;
    }
    .modal-dialog {
      width: 80%; /* Adjust modal width for laptops */
      max-width: 600px; /* Limit maximum width */
    }
    .modal-content {
      width: 80%;
      height: 590px;
      overflow: hidden;
    }

    .modal-title {
      font-size: 1.3rem;
    }

    .btn {
      width: 80%; /* Make buttons slightly smaller */
      height: 40px;
    }

    #close-btn{
    font-size: 2rem;
    border: none;
    background-color: transparent;
    } 

    .stockIn {
    background-color: #d9d9d9;
    border: 1px solid #d9d9d9;
    border-radius: 10px;
    height: 400px;
    width: 400px;
    position: absolute;
    margin-top: 400px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    overflow: hidden;
  }


  /*FOR ADD CATEGORY MODAL */
  .categorycontent{
    height: 350px;
    bottom: 100px;
  }
  .pluscontent{
    width: 80%;
    height: 250px;
    bottom: 100px;
  }
  #add_category{
    width: 60px;
  }

  /*FOR ADD INGREDIENT MODAL */

  .add-content{
    width: 40vw;
    height: 460px;
    font-size: 0.8rem;
    margin: 0px;
    
  }
  .btn-Ingredient{
    width: 60px;
  }
  }


  @media (max-width: 1024px) {
    .container{
      width: 80%;
      height: 700px;
      margin: 100px auto 0 230px; 
      padding: 10px;
      max-width: 900px;
      margin-top: 100px;
      margin-right: auto;
    }

    .table{
      width: 80%;
      padding: 10px;
    }

    .topbtn{
      display: flex;
      margin: 0 auto 0 40px;
      width: 100%;
      overflow: hidden;
    }

    #searchInput{
      width: 100%;
      height: 40px;
    }

    .modal-content{
      width: 80%;
      height: 620px;
      overflow: hidden;
    }

    #ingredients_image{
      height:40px;
    }
    .imageButton{
      width: 60px;
    }
    .modal-dialog {
      width: 80%; /* Adjust modal width for laptops */
      max-width: 600px; /* Limit maximum width */
    }

    .modal-title {
      font-size: 1.3rem;
    }

    .btn {
      width: 80%; /* Make buttons slightly smaller */
      height: 40px;
    }

    .stockIn {
      background-color: #d9d9d9;
      border: 1px solid #d9d9d9;
      border-radius: 10px;
      height: 400px;
      width: 400px;
      position: absolute;
      margin-top: 400px;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      overflow: hidden;
    }

  .categorycontent{
    height: 250px;
    bottom: 100px;
  }
  .pluscontent{
    width: 80%;
    height: 250px;
    bottom: 100px;
  }
  #add_category{
    width: 60px;
  } 

  .add-content{
    width: 40vw;
    height: 480px;
    font-size: 0.8rem;
    margin: 0px;
    
  }

  .btn-Ingredient{
    width: 60px;
  }

}

  @media (max-width: 968px) {

  .container{
    width: 90%;
    height: 700px;
    margin: 100px auto 0 230px; 
    padding: 10px;
    max-width: 800px;
    margin-top: 100px;
    margin-right: auto;
  }

  .topbtn{
    display: flex;
    margin: 0 auto 0 5px;
    width: 100%;
    overflow: hidden;
  }

  #searchInput{
    width: 100%;
    height: 40px;
  }

  .modal-dialog {
    width: 80%; /* Adjust modal width for laptops */
    max-width: 600px; /* Limit maximum width */
  }

  .btn {
    width: 100%; /* Make buttons slightly smaller */
    height: 40px;
  }

  .modal-content {
    padding: 15px; /* Reduce padding on smaller screens */
  }

  .modal-content{
      width: 80%;
      height: 570px;
      overflow: hidden;
    }

    #ingredients_image{
      height:40px;
    }
    .imageButton{
      width: 60px;
    }

  .ingredientProfile {
    width: 80px; /* Smaller image on smaller screens */
    height: 80px;
  }

  .modal-header,
  .modal-body {
    padding: 10px; /* Further reduce padding */
  }

  .stockIn {
    background-color: #d9d9d9;
    border: 1px solid #d9d9d9;
    border-radius: 10px;
    height: 400px;
    width: 400px;
    position: absolute;
    margin-top: 400px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    overflow: hidden;
  }

  
  .categorycontent{
    height: 350px;
    bottom: 100px;
  }
  .pluscontent{
    width: 80%;
    height: 250px;
    bottom: 100px;
  }
  #add_category{
    width: 60px;
  }

  /*ADD INGREDIENT MODAL */
  .add-content{
    width: 40vw;
    height: 490px;
    font-size: 0.8rem;
    margin: 0px;
    
  }
  .btn-Ingredient{
    width: 60px;
  }
  
  }

  @media (max-width: 768px) {

    .container{
      width: 80%;
      margin: 100px auto 0 210px; 
      padding: 10px;
      max-width: 900px;
      margin-top: 100px;
      margin-right: auto;
      overflow: hidden;
    }

    .topbtn{
      display: flex;
      margin: 0 auto 0 10px;
      width: 100%;
      overflow: hidden;
    }

    #searchInput{
      width: 100%;
      height: 40px;
    }

    .modal-dialog {
      width: 80%; /* Adjust modal width for laptops */
      max-width: 600px; /* Limit maximum width */
    }

    .btn {
      width: 100%; /* Make buttons slightly smaller */
      height: 40px;
    }

    .modal-content{
      width: 80%;
      height: 570px;
      overflow: hidden;
      margin-left: 25px;
      padding: 15px;
    }

    #ingredients_image{
      height:40px;
      font-size: 0.8rem;
    }
    .imageButton{
      width: 60px;
    }

    .ingredientProfile {
      width: 80px; /* Smaller image on smaller screens */
      height: 80px;
    }

    .modal-header,
    .modal-body {
      padding: 10px; /* Further reduce padding */
    }
    .stockIn {
    background-color: #d9d9d9;
    border: 1px solid #d9d9d9;
    border-radius: 10px;
    height: 400px;
    width: 350px;
    position: absolute;
    margin-top: 400px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    overflow: hidden;
  }
  .stockINHeader{
    margin-left: 100px;
  } 
  
  .categorycontent{
    height: 350px;
    bottom: 100px;
  }
  .pluscontent{
    width: 80%;
    height: 250px;
    bottom: 100px;
  }
  #add_category{
    width: 60px;
  }

  /*ADD INGREDIENT MODAL */
  .add-content{
    width: 40vw;
    height: 490px;
    font-size: 0.8rem;
    margin: 0px;
    
  }

  .btn-Ingredient{
    width: 60px;
  }
}

</style>

<body>
  <div class="container">

  <div class="topbtn">
  <a href="actionInventory.php" class=" btn btn-dark me-1">Inventory Actions</a>
      <button type="button" data-bs-toggle="modal" data-bs-target="#Modal" class=" btn btn-dark me-1">Category</button>

      <button type="button" data-bs-toggle="modal" data-bs-target="#Add" class=" btn btn-dark me-1">Add Ingredients</button>

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
                <h3 class="add-title modal-title fs-4" id="modalLabel ">Add Ingredients</h3>
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
                  <input type="text" class="t-input form-control w-75" aria-label="qty" id="qty">

                  Unit
                  <select class="t-input form-control w-75" aria-label="a_unit" name="a_unit" id="a_unit" required>

                    <option value="kg">kg</option>
                    <option value="pcs">pcs</option>
                    <option value="gal">gal</option>

                  </select>
                </div>


                <div class="add-ideal input-group mb-1 d-block">
                  Ideal Quantity
                  <input type="text" class="t-input form-control w-75" aria-label="ideal_qty" id="ideal_qty" required>
                </div>
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
                    <a class='deletebtn btn-dark' id="btn">Delete</a>

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
          <div class="modal-body" >
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
  <script src="script/ingredients.js"></script>
  <script src="script/imageupload.js"></script>
</body>

</html>