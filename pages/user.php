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
        margin-top: 58px;
    }

    .btnnnn {
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

    .btnn {
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

    .headerrr {
        background-color: #2c2c2c;
    }

    .pooter {
        background-color: #2c2c2c;
        height: 75px;
        border: #2c2c2c;
    }

    .bodyyy {
        background-color: #2c2c2c;
    }

    #search-user{
        height: 40px;
        margin-top: 58px;
    }
</style>



</head>


<body>

    <div class="container">

        <div>
            <select class="topbtn btn btn-dark me-1" aria-label="categoryFilter" name="categoryFilter" id="categoryFilter">
                <option value="">Filter</option>
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>

            </select>
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
                <input id="search-user" class="form-control mr-sm-2 me-1" type="search" placeholder="Search" aria-label="Search">

            </form>
        </div>
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th style="background-color: #2c2c2c;" scope="col">Picture</th>
                    <th style="background-color: #2c2c2c;" scope="col">Fullname</th>
                    <th style="background-color: #2c2c2c;" scope="col">Address</th>
                    <th style="background-color: #2c2c2c;" scope="col">Contact Number</th>
                    <th style="background-color: #2c2c2c;" scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="users-tbl">



            </tbody>
        </table>
        <div id="paginationControls">
            <button id="prevPage" disabled>Previous</button>
            <span id="currentPage">1</span>
            <button id="nextPage" disabled>Next</button>
        </div>


        <form class="user-image" id="view" method="POST">
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


                                            <input type="file" name="users_image" id="users_image">
                                            <button type="submit" class="user-imagebtn">Submit</button>




                                            <input type="hidden" id="users-id" name="users_id">
                                            <div class="input-group mb-3 
                                            d-block">Fullname
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
                            <button type="button" class="updates-btn btn-dark update-btn btnn">Update</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="script/user.js"></script>
    <script src="script/imageupload.js">
    </script>



</body>

</html>