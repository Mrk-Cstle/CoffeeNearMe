<?php include '../assets/template/navigation.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>Product Table</title>
  <link rel="stylesheet" href="../assets/design/expenses-table.css">
</head>
<body>
  <div class="container">
    <div class="top-bar">
      <button type="button" data-bs-toggle="modal" data-bs-target="#Add" class=" btn btn-dark me-1">Add Expenses Name</button>
      <div class="dropdown">
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

      </div>
      <input type="text" placeholder="Search" class="search-bar">
    </div>

    <table class="product-table">
      <thead>
        <tr>
          <th>Category</th>
          <th>Expenses Name</th>
          <th>Amount</th>
          <th>Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Electricity</td>
          <td><i>Meralco</i></td>
          <td><b>₱2500</b></td>
          <td>November 11, 2024</td>
          <td><button class="delete-btn"> <img src="../assets/images/delete.png" alt="" class="delete-icon"></button></td>
        </tr>
        <tr>
          <td>Electricity</td>
          <td><i>Meralco</i></td>
          <td><b>₱2500</b></td>
          <td>November 11, 2024</td>
          <td><button class="delete-btn"> <img src="../assets/images/delete.png" alt="" class="delete-icon"></button></td>
        </tr>
        <tr>
          <td>Electricity</td>
          <td><i>Meralco</i></td>
          <td><b>₱2500</b></td>
          <td>November 11, 2024</td>
          <td><button class="delete-btn"> <img src="../assets/images/delete.png" alt="" class="delete-icon"></button></td>
        </tr>
        <tr>
          <td>Electricity</td>
          <td><i>Meralco</i></td>
          <td><b>₱2500</b></td>
          <td>November 11, 2024</td>
          <td><button class="delete-btn"> <img src="../assets/images/delete.png" alt="" class="delete-icon"></button></td>
        </tr>
        <tr>
          <td>Electricity</td>
          <td><i>Meralco</i></td>
          <td><b>₱2500</b></td>
          <td>November 11, 2024</td>
          <td><button class="delete-btn"> <img src="../assets/images/delete.png" alt="" class="delete-icon"></button></td>
        </tr>
      </tbody>
    </table>

    <div id="paginationControls">
    <button id="prevPage" disabled>Previous</button>
    <span id="currentPage">1</span>
    <button id="nextPage" disabled>Next</button>
  </div>

    <!-- Modal for 3 TOP BUTTONS -->
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
      
      <div class="modal fade" id="Add" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="add-content modal-content">
            <div class="add modal-header header-Modal">
              <h3 class="add-title modal-title " id="modalLabel ">Add Expenses</h3>
              <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="add-body modal-body">
              <div class="add-expenses input-group mb-1 d-block">
                <p class="expenses-text">Expenses</p>
                <input type="text" class="t-input form-control w-75" aria-label="expenses" id="expenses" required>
              </div>
              <div class="add-expenses input-group mb-1 d-block">
              <p class="expenses-text">Category</p>

                <select class="t-input form-control w-75" aria-label="category" name="icategory" id="icategory">
                  <option value="">QWE</option>
                  <option value="">ZXC</option>
                </select>
              </div>


              <div class="add-expenses input-group mb-3 d-block">
              <p class="expenses-text">Payment</p>
                <input type="number" class="t-input form-control w-75" aria-label="qty" id="qty">

                
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

  </div>
</body>
</html>
