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
    * {
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
        padding: 10px;
        margin: 0 auto 0 350px;
        max-width: 900px;
        position: relative;
        margin-top: 100px;
        padding-left: 150px;

    }

    .table {
        border: 1px solid;
        margin-top: 40px;
        text-align: center;
        font-size: clamp(0.8rem, 1.5vw, 1rem);
        -webkit-text-fill-color: #fff;
    }

    

    .topbtn {
        display: flex;
        margin: 0 0 0 auto;
        justify-content: space-evenly;
        font-size: 1rem;
        margin-left: -54px;

    }

    .btn {
        background-color: #d76614;
        color: white;
        border: none;
        font-weight: 600;
        height: 40px;
        text-align: center;
        margin-top: 25px;
        font-size: clamp(0.7rem, 1vw, 1.5rem);
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
        background-color: #d9d9d9;
        height: 570px;
        width: 80%;
    }

    .modal-header {
        -webkit-text-fill-color: #000;
        border: rgba(0, 0, 0, 0.6);
        font-weight: 600;
        font-size: clamp(0.7rem, 1vw, 1rem);
    }

    .userbody {
        margin-left: 90px;
        -webkit-text-fill-color: #000;
        font-weight: 600;
        font-size: clamp(0.7rem, 1vw, 1rem);
        width: 80%;
    }

    .userfooter {
        border: rgba(0, 0, 0, 0.6);
    }

    .modal-title {
        margin-left: 120px;
    }

    .t-input {
        background-color: #fff;
        border: #d76614;
        -webkit-text-fill-color: #d76614;
    }

    .fprofile {
        width: 120px;
        height: 120px;
        border-radius: 150px;
        margin-left: 140px;
        margin-top: 20px;
    }

    .view {
        -webkit-text-fill-color: #fff;
        width: 70px;
        height: 32px;
    }

    .area {
        display: block;
        background-color: transparent;
    }

    .fname {
        background-color: #fff;
        margin-top: 30px;
        width: 74%;
        height: 270px;
        padding: 20px;
        padding-top: 30px;
        padding-bottom: 52px;
        border-radius: 20px;
        font-weight: 600;
        font-size: clamp(0.7rem, 1vw, 1rem);
        margin-bottom: 20px;
        margin-left: 27px;
    }

    .input {
        border-radius: 20px;
        background-color: #020202;
        -webkit-text-fill-color: #d76614;
        font-size: clamp(0.7rem, 1vw, 1rem);
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
        margin-top: -110px;
        margin-bottom: 0px;
        font-weight: 600;
        margin-left: 0px;
        font-size: clamp(0.7rem, 1vw, 1rem);
    }

    

    .update,
    .delete {
        background-color: #2d2b2b;
        border: none;
        margin-left: 10px;
        margin-right: 10px;
    }

    .viewcontent {
        height: 5vh;
        width: 72%;
        margin: 0;
        position: absolute;
        left: 55%;
        top: 20%;
        transform: translate(-50%, -50%);
    }

    .viewbody {
        width: 100%;
        height: 470px;
    }

    .t-input {
        background-color: rgba(0, 0, 0, 0.3);
        border: #d76614;
        -webkit-text-fill-color: #d76614;
        font-size: clamp(0.7rem, 1vw, 1rem);
    }

    .vbtn {
        -webkit-text-fill-color: #fff;
    }

    .btnn {
        font-size: 16px;
        margin-bottom: 155px;
        border: 2px solid transparent;
        border-radius: 5px;
        background-color: #d76614;
        color: #fff;
        height: 40px;
        width: 80px;
        margin-right: 15px;
    }

    .headerrr,
    .pooter,
    .bodyyy {
        background-color: #d9d9d9;
    }

    .pooter {
        height: 8vh;
        width: 100%;
    }

    .headerrr {
        width: 100%;
    }

    #search-user {
        height: 40px;
        margin-top: 24px;
        width: 25%;
    }

    /* File Image CSS */
    #users_image {
        margin-top: 10px;
        border: 5px #2c2c2c;
        border-radius: 50px;
        width: 110px;
        padding: 2px;
        font-size: clamp(0.7rem, 1vw, 1rem);
        color: #d76614;
    }

    #users_image::-webkit-file-upload-button {
        background-image: linear-gradient(45deg, rgb(215, 102, 20), #000);
        color: #fff;
        padding: 8px 16px;
        border: none;
        border-radius: 50px;
        cursor: pointer;
    }

    .user-imagebtn {
        border: 2px solid #d76614;
        width: 70px;
        height: 30px;
        margin-left: 40px;
        border-radius: 10px;
        background-color: #d76614;
        color: #fff;
        font-size: clamp(0.7rem, 1vw, 1rem);
    }

    #modal-header-edit {
        margin-left: 380px;
        font-size: clamp(0.7rem, 1vw, 1rem);
    }

    /* Users-tbl */
    .users-tbl {
        -webkit-text-fill-color: #000;
        font-weight: 600;
    }

    .view-btn {
        -webkit-text-fill-color: #fff;
        background-color: #d76614;
    }

    /* Pagination */
    #paginationControls {
        position: relative;
        float: left;
        padding: 10px;
        background-color: #f2f2f2;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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
            width: 100%;
            padding: 10px;
            margin: 0 auto 0 150px;
            max-width: 900px;
            position: relative;
            margin-top: 50px;
            padding-left: 220px;
            padding-right: auto;

        }

        .viewcontent {
            height: 0vh;
            background-color: transparent;
            width: 70%;
            margin: 0;
            position: absolute;
            left: 55%;
            top: 15%;
            transform: translate(-50%, -50%);
        }



        .viewbody {
            width: 100%;
            height: 450px;
        }
        .headerrr{
            width: 100%;
        }
        .pooter{
            width: 100%;
        }
        
        .fprofile {
            width: 100px;
            height: 100px;
            border-radius: 150px;
            margin-left: 110px;
            margin-top: 10px;
        }

        #users_image {
            margin-top: 10px;
            border: 5px #2c2c2c;
            border-radius: 50px;
            width: 95px;
            padding: 2px;
            
            
        }

        .user-imagebtn {
            border: 2px solid #d76614;
            width: 60px;
            height: 30px;
            border-radius: 10px;
            background-color: #d76614;
            color: #fff;
            margin-left: 20px;
        }

        #modal-header-edit {
            margin-left: 240px;
            
        }



        HEAD .table {
            font-size: 1rem;
        }

        .fname {
            margin-left: 20px;
            width: 95%;
            height: 253px;
            
        }

        .info {
            width: 90%;
            height: 395px;
            margin-left: -20px;
            top: 8px;
            
        }
    }

    

    /* Tablet */
    @media (min-width: 768px) and (max-width: 1023px) {
        .container {
            width: 100%;
            padding: 20px;
            margin: 0 auto 0 50px;
            max-width: 900px;
            position: relative;
            margin-top: 0px;
            padding-left: 220px;
            padding-right: auto;

        }

        .add-user {
            width: 100%;
        }

        .search {
            width: 60%;
        }

        .usercontent {
            width: 80%;
            padding: 10px;
            max-width: 500px;
            margin: auto;
        }

        .viewbody {
            width: 60vw;
            display: block;
        }

        .pooter {
            width: 60vw;
        }

        .headerrr {
            width: 60vw;
        }

        .fname {
            width: 100%;
            height: 80%;
            padding: 20px;
        }

        .info {
            width: 100%;
            right: 60px;
            margin-left: 50px;
        }

        .fprofile {
            width: 100px;
            height: 100px;
        }

        #modal-header-edit {
            margin-left: 250px;
        }
    }



    @media screen and (max-width: 853px) {
        .container {
            padding: 10px;
            margin: 0 auto 0 50px;
            max-width: 900px;
            position: relative;
            margin-top: 80px;
            padding-left: 220px;
            padding-right: auto;

        }

        .add-user {
            width: 100%;
        }

        .search {
            width: 60%;
        }

        .usercontent {
            width: 80%;
            height: 100%;
            padding: 10px;
            max-width: 500px;
            margin: auto;
        }

        .viewbody {
            width: 60vw;
            height: 48vh;
            display: block;
        }

        .pooter,
        .headerrr {
            width: 60vw;
        }

        .fname {
            width: 28vw;
            height: 80%;
            padding: 20px;
        }

        .info {
            width: 20vw;
            right: 22px;
            float: right;
            height: 365px;
            bottom: 350px;
            padding-left: 10px;
            margin-top: -395px;
        }

        .fprofile {
            width: 100px;
            height: 100px;
            margin-left: 90px;
        }

        #modal-header-edit {
            margin-left: 180px;
        }
    }

    .headDash{
            margin-left: 0px;
            margin-top: 0px;
            width: 15%;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
        }

          /* Hide spin buttons for Chrome, Edge, and Safari */
            #contactNum::-webkit-inner-spin-button,
            #contactNum::-webkit-outer-spin-button {
            -webkit-appearance: none;
            appearance: none;
            margin: 0;
            }

            /* Hide spin buttons for Firefox */
            #contactNum[type="number"] {
            -moz-appearance: textfield;
            appearance: textfield;
            }

            /* Hide spin buttons for Chrome, Edge, and Safari */
            #contact_number::-webkit-inner-spin-button,
            #contact_number::-webkit-outer-spin-button {
            -webkit-appearance: none;
            appearance: none;
            margin: 0;
            }

            /* Hide spin buttons for Firefox */
            #contact_number[type="number"] {
            -moz-appearance: textfield;
            appearance: textfield;
            }
</style>



</head>


<body>

    <div class="container">
        <h3 class="headDash">User</h3>
        <div>
            <div class="topbtn">
            <select class="btn btn-dark me-1" aria-label="categoryFilter" name="categoryFilter" id="categoryFilter">
                <option value="">Filter</option>
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>

            </select>
            
            
            
                <button type="button" data-bs-toggle="modal" data-bs-target="#Modal" class="btn btn-dark me-5 w-auto  add-user">Add User</button>
                <input id="search-user" class="form-control mr-sm-2 me-1" type="search" placeholder="Search" aria-label="Search">

                </div>
                <!-- Modal -->
                <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="usercontent modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-4" id="ModalLabel">Add User</h1>
                                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="userbody modal-body">
                                <div class="user input-group mb-1 d-block"> Full Name
                                    <input type="text" class="t-input form-control w-75 addInput" aria-label="full_name" id="full_name" required>
                                </div>
                                <div class="user input-group mb-1 d-block">
                                    Username
                                    <input type="text" class="t-input form-control w-75 addInput" aria-label="user_name" id="user_name" required>
                                </div>
                                <div class="name input-group mb-1 d-block">
                                    Password

                                    <input type="password" class="t-input form-control w-75" aria-label="Name" id="password">
                                </div>
                                <div class="contact input-group mb-1 d-block">
                                    Contact
                                    <input type="number" class="t-input form-control w-75" aria-label="Contact" id="contact_number">

                                </div>
                                <div class="contact input-group mb-1 d-block">
                                    Account Type
                                    <select class="t-input form-control w-75" aria-label="Account Type" name="account" id="account" required>

                                        <option value="admin">Admin</option>
                                        <option value="staff">Staff</option>

                                    </select>

                                </div>
                                <div class="address input-group mb-3 d-block">
                                    Address
                                    <input type="text" class="t-input form-control w-75 addInput" aria-label="Address" id="address" required>
                                </div>
                                <p id="errorhandling" style="color:red;"> </p>
                            </div>

                            <div class="userfooter modal-footer">

                                <button type="button" class="btnnnn btn-dark me-2" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btnnnn btn-dark" id="saveChanges">Add</button>
                            </div>
                        </div>
                    </div>
                </div>

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

        <!--VIEW MODAL-->
        <form class="user-image" id="view" method="POST">
            <div class="modal fade" id="View" tabindex="-1" aria-labelledby="Modal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="viewcontent modal-content">
                        <div class="modal-header headerrr">
                            <h1 class="modal-title fs-4" id="modal-header-edit">Edit User</h1>
                            <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="viewbody modal-body bodyyy">
                            <div class="area">
                                <img src="../assets/images/1x1.jpg" class="fprofile">


                                <div class="row gx-5">
                                    <div class="col">

                                        <div class="fname">


                                            <input type="file" name="users_image" id="users_image" required>
                                            <button type="submit" class="user-imagebtn">Submit</button>




                                            <input type="hidden" id="users-id" name="users_id">
                                            <div class="input-group mb-3 mt-2 
                                            d-block">Fullname
                                                <input type="text" class="input form-control w-100 mt-1" aria-label="Username" name="full_name" required>
                                            </div>

                                            <div class="input-group mb-3 d-block mt-2">Account Type
                                                <input type="text" class="input form-control w-100 mt-2" aria-label="Username" name="account_type" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="info col-6">
                                            <div class="input-group mb-1">Username
                                                <input type="text" class="input form-control w-100 mt-1" aria-label="Username" name="user_name" required>
                                            </div>
                                            <div class="input-group mb-1 mt-1">Password
                                                <input type="password" class="input form-control w-100 mt-1" aria-label="Username" name="password" required>
                                            </div>
                                            <div class="input-group mb-1 mt-1">Address
                                                <input type="text" class="input form-control w-100 mt-1" aria-label="Username" name="address" required>
                                            </div>
                                            <div class="input-group mb-1 mt-1">Contact Number
                                                <input type="number" class="input form-control w-100 mt-1" aria-label="Username" name="contact_number" id="contactNum" required>
                                            </div>
                                            <div class="input-group mb-1 mt-1">Account Date
                                                <input type="text" class="input form-control w-100 mt-1" aria-label="Username" name="account_date" required readonly>
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