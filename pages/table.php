<?php
include './include/dbConnection.php';

$mysqli = mysqli_connect('localhost', 'root', '', 'coffeenearme');

// Get the total number of records from our table "user".
$total_users = $mysqli->query('SELECT COUNT(*) as total FROM user')->fetch_assoc()['total'];

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
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>Table</title>
  <style>
    .container {
      padding: 100px;
    }

    .table {
      border: 1px solid;
      outline: 3px solid;
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
      background-color: #d76614;
      color: #fff;
      border: none;
    }

    .modal-content {
      background-color: rgba(0, 0, 0, 0.6);
    }

    .modal-header {
      -webkit-text-fill-color: #fff;
      border: rgba(0, 0, 0, 0.6);
    }

    .modal-body {
      margin-left: 90px;
      -webkit-text-fill-color: #fff;
    }

    .modal-footer {
      border: rgba(0, 0, 0, 0.6);
    }

    .modal-title {
      margin-left: 190px;
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
  color: #fff; /* Text color */
  border-radius: 4px;
}

.pagination li a:hover {
  background-color: #2d2b2b;
  color: #fff; /* Hover text color */
}

.pagination .currentpage a {
  background-color: #2d2b2b;
  color: #fff;
}

.pagination .currentpage a:hover {
  background-color: #2d2b2b ;
  
}


.pagination li a {
  color: #fff; 
}

.pagination li a:hover {
  text-decoration: none; 
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
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-4" id="ModalLabel">Add User</h1>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="user input-group mb-3 d-block">
                  Full Name
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
              <div class="modal-footer">
                <button type="button" class="btn btn-dark me-2" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark" id="saveChanges">Save changes</button>
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
          <th scope="col">Username</th>
          <th scope="col">Fullname</th>
          <th scope="col">Address</th>
          <th scope="col">Contact Number</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['user_name']; ?></td>
            <td><?php echo $row['full_name']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['contact_number']; ?></td>
            <td>
              <a class='btn btn-primary btn-sm' href='editUser.php?id=<?php echo $row['user_id']; ?>'>View</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    <?php if (ceil($total_users / $num_results_on_page) > 1): ?>
      <ul class="pagination">
        <?php if ($page > 1): ?>
          <li class="page-item"><a class="page-link"  href="table.php?page=<?php echo $page - 1; ?>">Prev</a></li>
        <?php endif; ?>
        
        <?php for ($i = max(1, $page - 2); $i <= min($page + 2, ceil($total_users / $num_results_on_page)); $i++): ?>
          <li class="page-item <?php if ($i == $page) echo 'active'; ?>"><a class="page-link" href="table.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php endfor; ?>
        
        <?php if ($page < ceil($total_users / $num_results_on_page)): ?>
          <li class="page-item"><a class="page-link" href="table.php?page=<?php echo $page + 1; ?>">Next</a></li>
        <?php endif; ?>
      </ul>
    <?php endif; ?>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    const myModal = document.getElementById('myModal');
    const myInput = document.getElementById('myInput');

    myModal.addEventListener('shown.bs.modal', () => {
      myInput.focus();
    });

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
  </script>
</body>

</html>