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

    body {
      background-color: #D9D9D9;
    }

    .container {
      margin: 0 auto;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 100%;
      max-width: 900px;
    }

    .tableProductsInfo {
      border: 1px solid #000;
      outline: 1px solid #000;
      width: 900px;
      height: 40px;
      text-align: center;
      margin-top: 40px;
      margin-left: 0px;
      overflow: hidden;
    }

    thead {
      background-color: #2D2B2B;
      color: #fff;
      font-size: 15px;
      font-weight: bold;
    }

    tbody {
      background-color: #fff;
      font-size: 15px;
      font-weight: bold;
      font-style: italic;
    }

    #picture,
    img {
      height: 100px;
      width: 100px;
      padding: 5px;
      margin: 15px;
      object-fit: cover;
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
    }

    .searchInput {
      width: 20%;
      height: 40px;
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
      margin-left: 76%;
    }

    /* Button Styling */
    .topbtn {
      display: flex;
      margin: 0 0 0 auto;
      justify-content: start;
      font-size: 1em;
      height: 40px;
    }


    /* Category List Modal Styling */
    .categorycontent {
      background-color: #fff;
      width: 600px;
      height: 500px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    .product-Header {
      color: #2D2B2B;
      /* Adjusted for consistency */
      border: 2px solid #d9d9d9;
      justify-content: space-between;
      background-color: #D9D9D9;
      width: 100%;
    }

    #viewProductModalLabel {
      font-size: 25px;
      margin-left: 550px;
      font-weight: bold;
      margin-left: 40%;
    }

    .modal-dialog {
      max-width: 1400px;
      /* Adjust to match the view form width */
    }

    .btn-close {
      background-color: #fff;
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
      width: 40%;
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
      background-color: #fff;
      border: 1px solid #000;
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
      width: 50vw;
      margin-left: 15%;
      margin-top: 120px;
      background-color: #d9d9d9;
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
      width: 90%;
      height: 0px;
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
      background-color: #D9D9D9;
      width: 20vw;
      height: 500px;
      min-height: max-content;
      position: absolute;
      left: 53%;
      margin: 25px 0 50px 0;
    }

    .ingredientHeader {
      border-bottom: 2px solid #d9d9d9;
      color: #000;
      width: auto;
      height: 80px;
      position: relative;
      background-color: transparent;
    }

    .ingredientHeading {
      text-align: center;
      font-size: 1.2rem;
      margin-top: 23px;
      left: 80%;
    }

    .ingredientBtn {
      position: relative;
      top: -40px;
      /* Adjust this value to move the div down */
      left: 300px;
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
      border: 1px solid #d9d9d9;
      height: 50px;
      color: white;
      font-size: 20px;
    }

    .tableIngredient {
      width: 100%;
      border-collapse: collapse;
      table-layout: fixed;
    }

    .headerRow tr {
      text-align: center;
      display: grid;
      grid-template-columns: 150px 120px 1fr;
      gap: 0px;
    }

    .headerRow {
      width: 100%;
      text-align: center;
    }

    .grid-cell {
      display: grid;
      grid-template-columns: 100px 120px 1fr;
      gap: 0px;
      padding: 10px;
    }

    .grid-cell {
      display: grid;
      grid-template-columns: 20px 120px 1fr;
      gap: 0px;
      padding: 10px;
    }

    .headerRow td {
      border-right: 1px solid transparent;
    }

    .ingredientLi {
      background-color: transparent;
      color: #000;
      margin: 0px;
      display: flex;
      justify-content: start;

    }

    .ingredientBodyModal {
      font-size: 20px;
      font-weight: bold;
      font-style: normal;
      background-color: #d9d9d9;
      height: 36vh;
      background-color: transparent;
      height: auto;
      max-height: fit-content;
    }

    .prod-ingredients {
      margin-left: 20px;
    }

    .spanquantity {
      font-size: large;
      font-weight: bold;
      position: fixed;
      margin-left: 17%;
    }

    .trashIcon {
      font-size: 20px;
      margin-left: 32%;
      position: fixed;
    }

    /*View Picture Edit*/
    .productPicture {
      width: 182px;
      height: 182px;
      background-color: #D9D9D9;
      border-radius: 50%;
      margin-left: 160px;
      margin-top: -310px;
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
      height: 240px;
      width: 20vw;
      margin-top: 52px;
    }

    .productInput {
      color: #2D2B2B;
      font-size: 15px;
      padding: 15px;
      font-weight: bold;
      display: flex;
    }

    .productName {
      border: 2px solid #2D2B2B;
      background-color: #fff;
      color: black;
      width: 15vw;
      height: 30px;
      border-radius: 15px;
      margin-left: 10px;
      text-align: center;
    }

    .productCategory {
      border: 2px solid #2D2B2B;
      background-color: #FFF;
      color: black;
      width: 10vw;
      height: 10px;
      border-radius: 15px;
      margin-left: 10px;
    }

    .productPrice {
      border: 2px solid #2D2B2B;
      background-color: #fff;
      color: black;
      width: 40%;
      height: 30px;
      border-radius: 15px;
      margin-left: 10px;
      text-align: center;
    }

    .viewIngredient {
      border: 3px solid #D9D9D9;
      margin-top: 525px;
      background-color: #d9d9d9;
      width: 100%;
    }

    .btnIngredient {
      background-color: #d76614;
      margin-top: 20px;
      font-size: 15px;
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
      margin-top: 400px;
      width: 40vw;
      height: auto;
    }

    .plusIconModal {
      background-color: #d9d9d9;
      border: 2px solid #D9D9D9;
      color: #000;
      font-size: 20px;
      font-style: italic;
      font-weight: bold;
    }

    .prod-cat {
      border: 2px solid #2D2B2B;
      border-radius: 10px;
      width: 10vw;
    }

    .plusInput {
      border: 2px solid #2D2B2B;
      border-radius: 10px;
      color: #000;
      background-color: #FFF;
      width: 10vw;
      margin-left: 30px;
    }

    .a-unit {
      border: 2px solid #2D2B2B;
      border-radius: 10px;
      width: 10vw;
      margin-left: 70px;
    }

    #add_ingredientsbtn {
      float: right;
    }

    /* LABEL INGREDIENT CSS */
    .labelIngredient {
      display: flex;
      justify-content: space-between;
      margin: 0 50px 0 50px;
    }

    /*IngredientCategory CSS */
    .inputIngredientCategory {
      display: flex;
    }

    .btn-plus {
      background-color: #d76614;
      color: white;
      font-size: 18px;
      font-style: italic;
      margin-left: 680px;
      margin-top: 60px;
    }


    .imageButton {
      border: 2px solid #D76614;
      background-color: #D76614;
      border-radius: 10px;
      margin-top: 0px;
      height: 40px;
      width: 80px;
      color: white;
      font-size: 15px;
    }

    #product_image {
      margin-left: 10px;
      border: 5px #2c2c2c;
      border-radius: 50px;
      width: 280px;
      padding: 2px;
      font-size: 20px;
      color: #d76614;
    }

    #product_image::-webkit-file-upload-button {
      background-image: linear-gradient(45deg, rgb(215, 102, 20), #000);
      color: #fff;
      padding: 8px 16px;
      border: none;
      border-radius: 50px;
      cursor: pointer;
    }

    #productCategory {
      border-radius: 15px;
      height: 45px;
      text-align: center;
    }



    /* Pagination */
    #paginationControls {
      position: absolute;
      bottom: -70px;
      left: 10%;
      transform: translateX(-50%);
      padding: 10px;
      background-color: #f2f2f2;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      display: flex;
      align-items: center;
    }

    #prevPage,
    #nextPage {
      background-color: #d76614;
      color: white;
      border: none;
      border-radius: 5px;
      padding: 5px 10px;
      margin: 0 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    #prevPage:disabled,
    #nextPage:disabled {
      background-color: #ccc;
      cursor: not-allowed;
    }

    #prevPage:not(:disabled):hover,
    #nextPage:not(:disabled):hover {
      background-color: #2c2c2c;
    }

    #currentPage {
      margin: 0 10px;
      font-weight: bold;
      font-size: 16px;
    }


    @media screen and (max-width: 1200px) {
      .container {
        margin: 20px 0 0 130px;
        position: relative;
        width: 80%;
        max-width: 900px;
        position: fixed;
        overflow: hidden;
      }

      .tableProductsInfo {
        width: 70vw;

      }

      .topbtn {
        display: flex;
      }

      .viewProduct {
        width: 50vw;
      }

      .viewContent {
        width: 65%;
        height: 570px;
      }

      .viewIngredient {
        margin-top: 409px;
      }

      .ingredientBody {
        width: 55%;
        height: 450px;
        margin-left: 20px;
      }

      .headerRow tr {
        text-align: center;
        display: grid;
        grid-template-columns: 100px 90px 1fr;
        gap: 0px;
      }

      .grid-cell {
        display: grid;
        grid-template-columns: 80px 120px 1fr;
        gap: 0px;
        padding: 10px;
      }

      .trashIcon {
        font-size: 20px;
        margin-left: 33%;
        position: fixed;
      }

      .ingredientBtn {
        left: 260px;
      }

      /*View Picture Edit*/
      .productPicture {
        width: 182px;
        height: 182px;
        background-color: #D9D9D9;
        border-radius: 50%;
        margin-left: 50px;
        margin-top: -360px;
      }

      #product_image {
        margin-left: -40px;
        border-radius: 50px;
        width: 200px;
        padding: 2px;
        font-size: 0.9rem;
      }

      .productDetails {
        border: 3px solid #2D2B2B;
        background-color: #EEEEEE;
        height: 240px;
        width: 30vw;
        margin-top: 18px;
        margin-left: -45px;
      }

      #paginationControls {
        margin-left: 50px;
      }

      .add-ingredient {
        max-width: 600px;
      }

      .add-category {
        max-width: 600px;
      }

      .add-quantity {
        max-width: 600px;
      }

    }

    @media screen and (max-width: 1024px) {
      .container {
        margin: 20px 0 0 130px;
        position: relative;
        width: 80%;
        max-width: 900px;
        position: fixed;
        overflow: hidden;
      }

      .tableProductsInfo {
        width: 70vw;

      }

      .topbtn {
        display: flex;
      }

      .viewProduct {
        width: 50vw;
      }

      .viewContent {
        width: 65%;
        height: 570px;
      }

      .viewIngredient {
        margin-top: 409px;
      }

      .ingredientBody {
        width: 55%;
        height: 450px;
        margin-left: 20px;
      }

      .headerRow tr {
        text-align: center;
        display: grid;
        grid-template-columns: 100px 90px 1fr;
        gap: 0px;
      }

      .grid-cell {
        display: grid;
        grid-template-columns: 80px 120px 1fr;
        gap: 0px;
        padding: 10px;
      }

      .trashIcon {
        font-size: 20px;
        margin-left: 33%;
        position: fixed;
      }

      .ingredientBtn {
        left: 230px;
      }

      /*View Picture Edit*/
      .productPicture {
        width: 182px;
        height: 182px;
        background-color: #D9D9D9;
        border-radius: 50%;
        margin-left: 50px;
        margin-top: -360px;
      }

      #product_image {
        margin-left: -40px;
        border-radius: 50px;
        width: 200px;
        padding: 2px;
        font-size: 0.9rem;
      }

      .productDetails {
        border: 3px solid #2D2B2B;
        background-color: #EEEEEE;
        height: 240px;
        width: 30vw;
        margin-top: 18px;
        margin-left: -45px;
      }


      .add-ingredient {
        max-width: 500px;
      }

      .add-category {
        max-width: 500px;
      }

      .add-quantity {
        max-width: 500px;
      }

      #paginationControls {
        margin-left: 50px;
      }

    }



    @media screen and (max-width: 968px) {
      .container {
        margin: 20px 0 0 130px;
        position: relative;
        width: 80%;
        max-width: 900px;
        position: fixed;
        overflow: hidden;
      }

      .tableProductsInfo {
        width: 66vw;
      }

      .topbtn {
        display: flex;

      }

      .viewProduct {
        width: 50vw;
      }

      .viewContent {
        width: 65%;
        height: 570px;
      }

      .viewIngredient {
        margin-top: 409px;
      }

      .ingredientBody {
        width: 55%;
        height: 450px;
        margin-left: 20px;
      }

      .headerRow tr {
        text-align: center;
        display: grid;
        grid-template-columns: 100px 70px 1fr;
        gap: 0px;
      }

      .grid-cell {
        display: grid;
        grid-template-columns: 80px 120px 1fr;
        gap: 0px;
        padding: 10px;
      }

      .trashIcon {
        font-size: 20px;
        margin-left: 32%;
        position: fixed;
      }

      .ingredientBtn {
        left: 230px;
      }

      /*View Picture Edit*/
      .productPicture {
        width: 182px;
        height: 182px;
        background-color: #D9D9D9;
        border-radius: 50%;
        margin-left: 50px;
        margin-top: -360px;
      }

      #product_image {
        margin-left: -40px;
        border-radius: 50px;
        width: 200px;
        padding: 2px;
        font-size: 0.9rem;
      }

      .productDetails {
        border: 3px solid #2D2B2B;
        background-color: #EEEEEE;
        height: 240px;
        width: 30vw;
        margin-top: 18px;
        margin-left: -45px;
      }

      .add-content {
        width: 60%;
      }

      .ingredientHeading {
        text-align: center;
        font-size: 1.2rem;
      }

      .ingredientBtn {
        left: 200px;
      }

      .add-ingredient {
        max-width: 600px;
      }

      .add-category {
        max-width: 600px;
      }

      .add-quantity {
        max-width: 600px;
      }


      #paginationControls {
        margin-left: 50px;
      }

    }

    @media screen and (max-width: 768px) {
      .container {
        margin: 0px 0 0 130px;
        position: relative;
        width: 80%;
        max-width: 900px;
        overflow: hidden;
        position: fixed;
      }

      .tableProductsInfo {
        width: 66vw;
      }

      .topbtn {
        display: flex;
        overflow: hidden;
        height: 37px;
      }

      .viewProduct {
        width: 50vw;
      }

      .viewContent {
        width: 80%;
        height: 570px;
      }

      .viewIngredient {
        margin-top: 409px;
      }

      .ingredientBody {
        width: 60%;
        height: 450px;
        margin-left: 50px;
      }

      .headerRow tr {
        text-align: center;
        display: grid;
        grid-template-columns: 80px 60px 1fr;
        gap: 0px;
      }

      .grid-cell {
        display: grid;
        grid-template-columns: 80px 120px 1fr;
        gap: 0px;
        padding: 10px;
      }

      .trashIcon {
        font-size: 20px;
        margin-left: 32%;
        position: fixed;
      }

      .ingredientBtn {
        left: 230px;
      }

      /*View Picture Edit*/
      .productPicture {
        width: 182px;
        height: 182px;
        background-color: #D9D9D9;
        border-radius: 50%;
        margin-left: 50px;
        margin-top: -360px;
      }

      #product_image {
        margin-left: -40px;
        border-radius: 50px;
        width: 200px;
        padding: 2px;
        font-size: 0.9rem;
      }

      .productDetails {
        border: 3px solid #2D2B2B;
        background-color: #EEEEEE;
        height: 240px;
        width: 30vw;
        margin-top: 18px;
        margin-left: -45px;
      }

      .add-content {
        width: 60%;
      }

      #paginationControls {
        margin-left: 50px;
      }

    }
  </style>

</head>

<body>

  <div class="container">
    <form action="">
      <div class="productTable">

        <div class="topbtn">
          <button type="button" data-bs-toggle="modal" data-bs-target="#Modal" class=" btn btn-dark me-1">Category</button>
          <button type="button" data-bs-toggle="modal" data-bs-target="#Add" class=" btn btn-dark me-1">Add Product</button>
          <a href="transactionDetails.php" class=" btn btn-dark me-1">Transaction History</a>
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

          <input id="searchInput" class="form-control mr-sm-2 me-1 my-sm-2 searchInput" type="search" placeholder="Search" aria-label="Search">
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
                    <input type="text" id="productPrice" name="productPrice" class="productPrice" required>
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

              <!--LABEL INGREDIENT-->
              <div class="labelIngredient">
                <label for="ingredientName" class="form-label ">Product</label>
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
              <input type="text" class="t-input form-control w-100" aria-label="category" id="category" required>
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
            <input type="text" class="t-input form-control w-50" aria-label="priceadd" id="priceadd">
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