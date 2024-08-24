<?php
include './include/dbConnection.php';

$mysqli = new mysqli('localhost', 'root', '', 'coffeenearme');

if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

// Get the total number of records from our table "user".
$stmt = $mysqli->prepare('SELECT COUNT(*) as total FROM user');
$stmt->execute();
$total_users = $stmt->get_result()->fetch_assoc()['total'];

// Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Number of results to show on each page.
$num_results_on_page = 10;

// Calculate the page to get the results we need from our table.
$calc_page = ($page - 1) * $num_results_on_page;

// Prepare SQL statement with pagination
$sql = "SELECT * FROM user ORDER BY user_id LIMIT ?, ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('ii', $calc_page, $num_results_on_page);
$stmt->execute();
$result = $stmt->get_result();
?>





<!DOCTYPE html>

<?php include '../assets/template/navigation.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- SweetAlert CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

  <!-- jQuery (ensure it is included before SweetAlert) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- SweetAlert JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

  <title>Table</title>
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
    width: 40%;
    display: flex;
    float: right;
  }

  .btn {
    background-color: #2d2b2b;
    color: white;
    border: none;
    font-weight: bolder;
    height: 35px;
    text-align: center;
  }
  .btnnnn{
    background-color: #d76614;
    color: white;
    border: none;
    font-style: italic;
    font-weight: bold;
    height: 35px;
    text-align: center;
    width: 120px;
  }

  .usercontent {
    background-color: rgba(0, 0, 0, 0.6);
  }

  .modal-header {
    -webkit-text-fill-color: #fff;
    border: rgba(0, 0, 0, 0.6);
  } 

  .userbody {
    margin-left: 90px;
    -webkit-text-fill-color: #fff;
  }

  .userfooter {
    border: rgba(0, 0, 0, 0.6);
  }

  .modal-title {
    margin-left: 200px;
  }

  .t-input {
    background-color: rgba(0, 0, 0, 0.3);
    border: #d76614;
    -webkit-text-fill-color: #d76614;
  }

  .fprofile {
    width: 200px;
    height: 200px;
    border-radius: 150px;
    margin-left: 120px;
    margin-top: 20px;
  }

  .view {
    -webkit-text-fill-color: #fff;
    width: 70px;
    height: 32px;
  }

  .area {
    display: block;
  }

  .fname {
    background-color: #fff;
    margin-top: 30px;
    width: 75%;
    padding: 20px;
    padding-top: 30px;
    padding-bottom: 52px;
    border-radius: 20px;
    font-weight: 600;
    margin-bottom: 20px;
    margin-left: 25px;
  }

  .input {
    border-radius: 20px;
    background-color: #020202;
    -webkit-text-fill-color: #d76614;
  }

  .info {
    display: flex;
    background-color: #fff;
    border-radius: 20px;
    padding: 20px;
    width: 75%;
    flex-direction: row;
    flex-wrap: wrap;
    position: relative;
    margin-top: -188px;
    margin-bottom: 30px;
    font-weight: 600;
  }

  .update {
    background-color: #2d2b2b;
    border: none;
    margin-left: 10px;
    margin-right: 10px;
  }

  .delete {
    background-color: #2d2b2b;
    border: none;
    margin-left: 10px;
    margin-right: 10px;
  }

  .viewcontent {
    height: 750px;
  }

  .viewbody {
    width: 100%;
  }

  .t-input {
    background-color: rgba(0, 0, 0, 0.3);
    border: #d76614;
    -webkit-text-fill-color: #d76614;
  }

  .pagination {
    list-style-type: none;
    padding: 10px 0;
    display: inline-flex;
    justify-content: center;
    box-sizing: border-box;
    margin-top: 20px;
  }

  .pagination li {
    box-sizing: border-box;
    padding-right: 10px;
  }

  .pagination li a {
    box-sizing: border-box;
    background-color: #d76614;
    padding: 8px;
    text-decoration: none;
    font-size: 12px;
    font-weight: bold;
    color: #fff;
    /* Text color */
    border-radius: 4px;
  }

  .pagination li a:hover {
    background-color: #2d2b2b;
    color: #fff;
    /* Hover text color */
  }

  .pagination .currentpage a {
    background-color: #2d2b2b;
    color: #fff;
  }

  .pagination .currentpage a:hover {
    background-color: #2d2b2b;
  }

  .pagination li a {
    color: #fff;
  }

  .pagination li a:hover {
    text-decoration: none;
  }

  .vbtn {
    -webkit-text-fill-color: #fff;
  }
  .btnn{
    font-size: 16px;
    margin-bottom: 155px;
    border: 2px solid #2c2c2c;
    border-radius: 5px;
    background-color: #d76614;
    color: #fff;
    height: 40px;
    width: 80px;
    margin-right: 15px;
  }
  .headerrr{
    background-color: #2c2c2c;
  }
  .pooter{
    background-color: #2c2c2c;
    height: 75px;
    border: #2c2c2c;
  }
  .bodyyy{
    background-color: #2c2c2c;
  }

  
</style>



</head>


<body>

  <div class="container">

    <div>
      <form class="search form-inline">
        <button type="button" data-bs-toggle="modal" data-bs-target="#Modal" class="btn btn-dark me-5 w-50">Add User</button>
        <!-- Modal -->
        <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="usercontent modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-4" id="ModalLabel">Add User</h1>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="userbody modal-body">
                <div class="user input-group mb-3 d-block"> Full Name
                  <input type="text" class="t-input form-control w-75" aria-label="full_name" id="full_name">
                </div>
                <div class="user input-group mb-3 d-block">
                  Username
                  <input type="text" class="t-input form-control w-75" aria-label="user_name" id="user_name">
                </div>
                <div class="name input-group mb-3 d-block">
                  Password
                  <input type="text" class="t-input form-control w-75" aria-label="Name" id="password">
                </div>
                <div class="contact input-group mb-3 d-block">
                  Contact
                  <input type="text" class="t-input form-control w-75" aria-label="Contact" id="contact_number">
                </div>
                <div class="address input-group mb-3 d-block">
                  Address
                  <input type="text" class="t-input form-control w-75" aria-label="Address" id="address">
                </div>
              </div>
              <div class="userfooter modal-footer">
                <button type="button" class="btnnnn btn-dark me-2" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btnnnn btn-dark" id="saveChanges">Save changes</button>
              </div>
            </div>
          </div>
        </div>
        <input class="form-control mr-sm-2 me-1" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-dark my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th style="background-color: #2c2c2c;" scope="col">Username</th>
          <th style="background-color: #2c2c2c;" scope="col">Fullname</th>
          <th style="background-color: #2c2c2c;" scope="col">Address</th>
          <th style="background-color: #2c2c2c;" scope="col">Contact Number</th>
          <th style="background-color: #2c2c2c;" scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()) : ?>
          <tr>
            <td><?php echo $row['user_name']; ?></td>
            <td><?php echo $row['full_name']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['contact_number']; ?></td>
            <td>
              <a class='btn btn-dark  view-btn '
                href='#View'
                data-bs-toggle='modal'
                data-user_id='<?php echo $row['user_id']; ?>'
                data-user_name='<?php echo $row['user_name']; ?>'
                data-full_name='<?php echo $row['full_name']; ?>'
                data-address='<?php echo $row['address']; ?>'
                data-contact_number='<?php echo $row['contact_number']; ?>'
                data-account_type='<?php echo $row['account_type']; ?>'
                data-password='<?php echo $row['password']; ?>'
                data-account_date='<?php echo $row['account_date']; ?>'>
                View
              </a>


            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    <?php if (ceil($total_users / $num_results_on_page) > 1) : ?>
      <ul class="pagination">
        <?php if ($page > 1) : ?>
          <li class="page-item"><a class="page-link" href="table.php?page=<?php echo $page - 1; ?>">Prev</a></li>
        <?php endif; ?>

        <?php for ($i = max(1, $page - 2); $i <= min($page + 2, ceil($total_users / $num_results_on_page)); $i++) : ?>
          <li class="page-item <?php if ($i == $page) echo 'active'; ?>"><a class="page-link" href="table.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php endfor; ?>

        <?php if ($page < ceil($total_users / $num_results_on_page)) : ?>
          <li class="page-item"><a class="page-link" href="table.php?page=<?php echo $page + 1; ?>">Next</a></li>
        <?php endif; ?>
      </ul>
    <?php endif; ?>

    <form id="view" method="POST">
      <div class="modal fade" id="View" tabindex="-1" aria-labelledby="Modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="viewcontent modal-content">
            <div class="modal-header headerrr">
              <h1 class="modal-title fs-4" id="Modal">Edit User</h1>
              <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="viewbody modal-body bodyyy">
              <div class="area">
                <img src="../assets/images/1x1.jpg" class="fprofile">
                <div class="row gx-5">
                  <div class="col">
                    <div class="fname">
                      <div class="input-group mb-3 d-block">Fullname
                        <input type="text" class="input form-control w-100 mt-2" aria-label="Username" name="full_name">
                      </div>

                      <div class="input-group mb-3 d-block mt-4">Account Type
                        <input type="text" class="input form-control w-100 mt-2" aria-label="Username" name="account_type">
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="info col-6">
                      <div class="input-group mb-3">Username
                        <input type="text" class="input form-control w-100 mt-2" aria-label="Username" name="user_name">
                      </div>
                      <div class="input-group mb-3 mt-3">Password
                        <input type="password" class="input form-control w-100 mt-2" aria-label="Username" name="password">
                      </div>
                      <div class="input-group mb-3 mt-3">Address
                        <input type="text" class="input form-control w-100 mt-2" aria-label="Username" name="address">
                      </div>
                      <div class="input-group mb-3 mt-3">Contact Number
                        <input type="text" class="input form-control w-100 mt-2" aria-label="Username" name="contact_number">
                      </div>
                      <div class="input-group mb-3 mt-3">Account Date
                        <input type="text" class="input form-control w-100 mt-2" aria-label="Username" name="account_date">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="viewfooter modal-footer pooter">
              <button type="button" class=" btn-dark delete-btn btnn" data-bs-dismiss="modal">Delete</button>
              <button type="button" class=" btn-dark update-btn btnn">Update</button>
            </div>
          </div>
        </div>
      </div>
  </div>
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    //const myModal = document.getElementById('myModal');
    // const myInput = document.getElementById('myInput');

    //myModal.addEventListener('shown.bs.modal', () => {
    //  myInput.focus();
    //});

    $(document).ready(function() {
      $('#saveChanges').click(function() {
        // Collect the input data
        var full_name = $('#full_name').val();
        var user_name = $('#user_name').val();
        var password = $('#password').val();
        var address = $('#address').val();
        var contact_number = $('#contact_number').val();

        // Prepare the data to be sent
        var userData = {
          full_name: full_name,
          user_name: user_name,
          password: password,
          address: address,
          contact_number: contact_number
        };

        // Send the data using AJAX
        $.ajax({
          type: 'POST',
          url: 'action/adduser_db.php', // replace with your server endpoint
          data: JSON.stringify(userData),
          contentType: 'application/json',
          success: function(response) {
            // Handle the response from the server
            console.log(response);
            // Optionally close the modal
            if (response.status === 'success') {
              alert(response.message);
            } else {
              alert('Error: ' + response.message);
            }
            $('#Modal').modal('hide');
          },
          error: function(error) {
            // Handle any errors
            console.error(error);
          }
        });
      });
    });



    //View Modal Scrip

    document.addEventListener('DOMContentLoaded', function() {
      // Get all elements with class 'view-btn'
      var viewButtons = document.querySelectorAll('.view-btn');

      viewButtons.forEach(function(button) {
        button.addEventListener('click', function() {
          // Extract data from the button's data attributes
          var user_name = this.getAttribute('data-user_name');
          var full_name = this.getAttribute('data-full_name');
          var address = this.getAttribute('data-address');
          var contact_number = this.getAttribute('data-contact_number');
          var account_type = this.getAttribute('data-account_type');
          var password = this.getAttribute('data-password');
          var account_date = this.getAttribute('data-account_date');

          // Update modal content with the extracted data
          

          document.querySelector('.viewcontent input[name="full_name"]').value = full_name;
          document.querySelector('.viewcontent input[name="user_name"]').value = user_name;
          document.querySelector('.viewcontent input[name="address"]').value = address;
          document.querySelector('.viewcontent input[name="contact_number"]').value = contact_number;
          document.querySelector('.viewcontent input[name="account_type"]').value = account_type;
          document.querySelector('.viewcontent input[name="password"]').value = password;
          document.querySelector('.viewcontent input[name="account_date"]').value = account_date;
        });
      });
    });



    //Script for Update and Delete Button

    $(document).ready(function() {
      $('.view-btn').click(function() {
        // Set user_id on #View modal
        $('#View').data('user_id', $(this).data('user_id'));
      });

      // Store original values when the page loads
      var originalData = {
        full_name: '',
        user_name: '',
        password: '',
        address: '',
        contact_number: '',
        account_type: '',
        account_date: ''
      };

      // Flag to track changes
      var changesMade = false;

      // Function to initialize originalData with current values
      function initializeOriginalData() {
        originalData.full_name = $('input[name="full_name"]').val().trim();
        originalData.user_name = $('input[name="user_name"]').val().trim();
        originalData.password = $('input[name="password"]').val().trim();
        originalData.address = $('input[name="address"]').val().trim();
        originalData.contact_number = $('input[name="contact_number"]').val().trim();
        originalData.account_type = $('input[name="account_type"]').val().trim();
        originalData.account_date = $('input[name="account_date"]').val().trim();
      }

      // Call initializeOriginalData when the page loads
      $(document).ready(function() {
        initializeOriginalData();

        // Debounce function to limit the rate of execution
        function debounce(func, delay) {
          var timer;
          return function() {
            var context = this;
            var args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function() {
              func.apply(context, args);
            }, delay);
          };
        }

        // Debounce function for checking changes
        var checkChanges = debounce(function() {
          // Collect updated data
          var updatedData = {
            full_name: $('input[name="full_name"]').val().trim(),
            user_name: $('input[name="user_name"]').val().trim(),
            password: $('input[name="password"]').val().trim(),
            address: $('input[name="address"]').val().trim(),
            contact_number: $('input[name="contact_number"]').val().trim(),
            account_type: $('input[name="account_type"]').val().trim(),
            account_date: $('input[name="account_date"]').val().trim()
          };

          // Check if any data has changed
          var hasChanges =
            updatedData.full_name !== originalData.full_name ||
            updatedData.user_name !== originalData.user_name ||
            updatedData.password !== originalData.password ||
            updatedData.address !== originalData.address ||
            updatedData.contact_number !== originalData.contact_number ||
            updatedData.account_type !== originalData.account_type ||
            updatedData.account_date !== originalData.account_date;

          // Update changesMade flag
          changesMade = hasChanges;

          // Enable/disable update button based on changes
          $('.update-btn').prop('disabled', !hasChanges);
        }, 300); // 300ms debounce delay

        // Bind input change event to checkChanges function
        $('input[name="full_name"], input[name="user_name"], input[name="password"], input[name="address"], input[name="contact_number"], input[name="account_type"], input[name="account_date"]').on('input', checkChanges);

        // Initialize originalData when clicking the view button
        $('#View').click(function() {
          initializeOriginalData();
          changesMade = false; // Reset changesMade flag
        });

        // Click handler for update button
        $('.update-btn').click(function() {
          // If no changes made, show info alert and return
          if (!changesMade) {
            Swal.fire({
              icon: 'info',
              title: 'No Changes Made',
              text: 'You have not made any changes.',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK'
            });
            return;
          }

          // Confirm update with user
          Swal.fire({
            title: 'Confirm Update',
            text: 'Are you sure you want to update the user data?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
          }).then(function(result) {
            if (result.isConfirmed) {
              // Proceed with update
              var user_id = $('#View').data('user_id');
              var updatedData = {
                full_name: $('input[name="full_name"]').val().trim(),
                user_name: $('input[name="user_name"]').val().trim(),
                password: $('input[name="password"]').val().trim(),
                address: $('input[name="address"]').val().trim(),
                contact_number: $('input[name="contact_number"]').val().trim(),
                account_type: $('input[name="account_type"]').val().trim(),
                account_date: $('input[name="account_date"]').val().trim(),
                user_id: user_id
              };

              // Send AJAX request
              $.ajax({
                  type: 'POST',
                  url: 'action/update_user.php',
                  data: JSON.stringify(updatedData),
                  contentType: 'application/json'
                })
                .then(function(response) {
                  console.log(response);

                  if (typeof response === 'string') {
                    response = JSON.parse(response);
                  }

                  if (response.status === 'success') {
                    Swal.fire({
                      title: 'Success',
                      text: response.message,
                      icon: 'success',
                      confirmButtonText: 'OK'
                    });

                    // Update originalData after successful update
                    initializeOriginalData(); // Update originalData with new values
                    changesMade = false; // Reset changesMade flag
                  } else {
                    Swal.fire({
                      icon: 'info',
                      title: 'Update Failed',
                      text: response.message,
                      confirmButtonColor: '#d33',
                      confirmButtonText: 'OK'
                    });
                  }
                })
                .fail(function(xhr, status, error) {
                  console.error('AJAX Error:', error);
                  Swal.fire({
                    icon: 'error',
                    title: 'Update Failed',
                    text: 'Failed to update user. Please try again later.',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                  });
                });
            }
          });
        });
      });




    });






    $('.delete-btn').click(function() {
      var user_id = $('#View').data('user_id');

      Swal.fire({
        icon: 'warning',
        title: 'Are you sure?',
        text: 'You are about to delete this user.',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: 'POST',
            url: 'action/delete_user.php',
            data: {
              user_id: user_id
            },
            success: function(response) {
              console.log(response);
              if (response.status == 'success') {
                Swal.fire({
                  icon: 'success',
                  title: 'Deleted!',
                  text: 'User deleted successfully.',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
                }).then((result) => {
                  if (result.isConfirmed) {
                    location.reload(); // Reload the page or update specific elements
                  }
                });
              }
            },
            error: function(error) {
              console.error('Error deleting user:', error);
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to delete user. Please try again later.',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
              });
            }
          });
        }
      });
    });
  </script>



</body>

</html>