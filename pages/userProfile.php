<?php include '../assets/template/navigation.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <title>Document</title>

    <style>
        * {
            margin: 0;
            padding: 0;

        }

        .user-form {
            border: 2px solid #D9D9D9;
            background-color: #D9D9D9;
            height: 655px;
            width: 35vw;
            position: absolute;
            top: 54%;
            left: 58%;
            transform: translate(-50%, -50%);

        }

        .user-profile {
            display: flex;
        }

        .user-image-container {
            display: flex;
            flex-direction: column;
            margin-top: 80px;
            margin-left: 50px;
        }

        .user-image {
            background-color: #2D2B2B;
            border: 2px solid #2D2B2B;
            border-radius: 10px;
            height: 150px;
            width: 150px;
            margin-left: 45px;
        }

        .profile-image {
            max-width: 150px;
            max-height: 150px;
            height: 120px;
            width: 120px;
            border-radius: 50%;
            margin-top: 15px;
            margin-left: 15px;
        }

        .user-info {
            font-family: "Poppins", system-ui;
            font-weight: 600;
            font-style: normal;
            color: #fff;
            background-color: #2D2B2B;
            border: 2px solid #2D2B2B;
            border-radius: 10px;
            height: 488px;
            width: 40%;
            margin-top: 83px;
            margin-left: 70px;
        }

        .info {
            margin-top: 36px;
            margin-left: 30px;
            font-weight: bold;
            font-size: clamp(1rem, 1vw, 1.5rem);
        }

        .info-text {
            color: black;
            font-family: "Roboto", sans-serif;
            font-weight: 900;
            font-style: normal;
            font-size: clamp(0.9rem, 1vw, 1rem);
            margin-left: 47px;
            margin-top: 6px;
            text-align: center;
            height: 30px;
            width: 70%;
            border: 2px solid #fff;
            border-radius: 10px;

        }

        .user-acc {
            background-color: #2D2B2B;
            border: 2px solid #2D2B2B;
            border-radius: 10px;
            height: 230px;
            width: 100%;
            margin-top: -25px;
            color: black;
            font-family: "Roboto", sans-serif;
            font-weight: 900;
            font-style: normal;
            margin-left: 10px;
            
        }

        .user-para {
            font-family: "Poppins", system-ui;
            font-weight: 600;
            font-size: clamp(1rem, 1vw, 1.5rem);
            font-style: normal;
            color: #fff;
            margin-top: 20px;
            margin-left: 30px;
        }

        .user-name {
            color: black;
            font-family: "Roboto", sans-serif;
            font-weight: 900;
            font-style: normal;
            margin-left: 20px;
            margin-top: 5px;
            text-align: center;
            height: 30px;
            width: 85%;
            border: 2px solid #fff;
            border-radius: 10px;
        }

        #users_image {
            margin-top: 30px;
            border: 5px #2c2c2c;
            border-radius: 50px;
            width: 6vw;
            padding: 2px;
            font-size: clamp(0.9rem, 1vw, 1rem);
            color: #d76614;
            margin-left: 0px;
        }

        #users_image::-webkit-file-upload-button {
            background-image: linear-gradient(45deg, rgb(215, 102, 20), #000);
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
        }

        .imageButton {
            border: 2px solid #d76614;
            border-radius: 10px;
            width: 100px;
            height: 35px;
            background-color: #d76614;
            color: #fff;
            margin-top: 34px;
            margin-left: 55px;
            font-size: clamp(0.9rem, 1vw, 1rem);
        }

        .image-btn {
            display: flex;
        }
        .updates-btn{
            height: 35px;
            width: 70px;
            background-color: #d76614;
            color: #fff;
            border: 2px solid #d76614;
            border-radius: 5px;
            margin-right: 50px;
            margin-top: 20px;
        }

        @media screen and (max-width: 1200px) {
            .user-form {
            border: 2px solid #D9D9D9;
            background-color: #D9D9D9;
            height: 655px;
            width: 60vw;
            position: absolute;
            top: 54%;
            left: 58%;
            transform: translate(-50%, -50%);

        }

        #users_image {
            margin-top: 30px;
            border: 5px #2c2c2c;
            border-radius: 50px;
            width: 10vw;
            padding: 2px;
            font-size: clamp(0.9rem, 1vw, 1rem);
            color: #d76614;
            margin-left: 0px;
        }
        }

        @media screen and (max-width: 1024px) {
            .user-form {
            border: 2px solid #D9D9D9;
            background-color: #D9D9D9;
            height: 655px;
            width: 65vw;
            position: absolute;
            top: 54%;
            left: 58%;
            transform: translate(-50%, -50%);

        }

        #users_image {
            margin-top: 30px;
            border: 5px #2c2c2c;
            border-radius: 50px;
            width: 11vw;
            padding: 2px;
            font-size: clamp(0.9rem, 1vw, 1rem);
            color: #d76614;
            margin-left: 0px;
        }
        }

        @media screen and (max-width: 868px) {
            .user-form {
            border: 2px solid #D9D9D9;
            background-color: #D9D9D9;
            height: 655px;
            width: 74vw;
            position: absolute;
            top: 54%;
            left: 61%;
            transform: translate(-50%, -50%);

        }

        #users_image {
            margin-top: 30px;
            border: 5px #2c2c2c;
            border-radius: 50px;
            width: 13vw;
            padding: 2px;
            font-size: clamp(0.9rem, 1vw, 1rem);
            color: #d76614;
            margin-left: 0px;
        }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="user-form">
            <div class="user-profile">
                <div class="user-image-container">
                    <div class="user-image">
                        <img src="../assets/images/1x1.jpg" class="profile-image">
                    </div>
                    <form class="profile-image" role="form" autocomplete="off" enctype="multipart/form-data">
                        <div class="image-btn">

                            <input type="file" name="users_image" id="users_image" placeholder="Upload Profile">
                            <button class="imageButton" type="submit" data-ingredients-id="">Submit</button>

                        </div>
                    </form>
                    <div class="user-acc">
                        <p class="user-para">Fullname</p>
                        <input type="text" name="fullname" class="user-name" readonly>
                        <p class="user-para">Account Type</p>
                        <input type="text" name="type" class="user-name" readonly>
                    </div>
                </div>
                <div class="user-info">
                    <input type="hidden" id="users-id" name="users_id">
                    <p class="info">Username</p>
                    <input type="text" name="user" class="info-text">
                    <p class="info">Password</p>
                    <input type="password" name="password" class="info-text">
                    <p class="info">Address</p>
                    <input type="text" name="address" class="info-text">
                    <p class="info">Contact Number</p>
                    <input type="text" name="contact" class="info-text">



                </div>

            </div>
            <div class="viewfooter modal-footer pooter">

                <button type="button" class="updates-btn btn-dark update-btn btnn">Update</button>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var userId = <?php echo isset($_SESSION['user_id']) ? json_encode($_SESSION['user_id']) : 'null'; ?>;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="script/profile.js"></script>
    <script src="script/imageupload.js"></script>
</body>

</html>