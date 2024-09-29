<?php include '../assets/template/navigation.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            
        }
        .user-form{
            border: 2px solid #D9D9D9;
            background-color: #D9D9D9;
            height: 720px;
            width: 1085px;
            position: absolute;
            top: 54%;
            left: 58%;
            transform: translate(-50%, -50%);

        }
        .user-profile{
            display: flex;
        }
        .user-image-container{
            display: flex;
            flex-direction: column;
            margin-top: 80px;
            margin-left: 50px;
        }
        .user-image{
            background-color: #2D2B2B;
            border: 2px solid #2D2B2B;
            border-radius: 10px;
            height: 150px;
            width: 150px;
            margin-left: 150px;
        }
        .profile-image{
            max-width: 150px;
            max-height: 150px;
            height: 120px;
            width: 120px;
            border-radius: 50%;
            margin-top: 15px;
            margin-left: 15px;
        }
        .user-info{
            font-family: "Poppins", system-ui;
            font-weight: 600;
            font-style: normal;
            color: #fff;
            background-color: #2D2B2B;
            border: 2px solid #2D2B2B;
            border-radius: 10px;
            height: 550px;
            width: 400px;
            margin-top: 83px;
            margin-left: 120px;
        }
        .info{
            margin-top: 30px;
            margin-left: 30px;
            font-size: 20px;
            font-weight: bold;
        }
        .info-text{
            color: black;
            font-family: "Roboto", sans-serif;
            font-weight: 900;
            font-style: normal;
            margin-left: 50px;
            margin-top: 20px;
            text-align: center;
            height: 30px;
            width: 300px;
            border: 2px solid #fff;
            border-radius: 10px;

        }
        
        .user-acc{
            background-color: #2D2B2B;
            border: 2px solid #2D2B2B;
            border-radius: 10px;
            height: 260px;
            width: 350px;
            margin-top: 45px;
            color: black;
            font-family: "Roboto", sans-serif;
            font-weight: 900;
            font-style: normal;
            margin-left: 50px;
        }
        .user-para{
            font-family: "Poppins", system-ui;
            font-weight: 600;
            font-style: normal;
            color: #fff;
            font-size: 20px;
            margin-top: 30px;
            margin-left: 30px;
        }
        .user-name{
            color: black;
            font-family: "Roboto", sans-serif;
            font-weight: 900;
            font-style: normal;
            margin-left: 20px;
            margin-top: 5px;
            text-align: center;
            height: 30px;
            width: 305px;
            border: 2px solid #fff;
            border-radius: 10px;
        }
        #user_image{
            margin-top: 50px;
            border: 5px #2c2c2c;
            border-radius: 50px;
            width: 300px;
            padding: 2px;
            font-size: 20px;
            color: #d76614;
            margin-left: 25px;
        }
        #user_image::-webkit-file-upload-button{
            background-image: linear-gradient(45deg, rgb(215, 102, 20), #000 );
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
        }
        .imageButton{
            border: 2px solid #d76614;
            border-radius: 10px;
            width: 100px;
            height: 35px;
            background-color: #d76614;
            color: #fff;
            margin-top: 55px;
            font-size: 18px;
        }
        .image-btn{
            display: flex;
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
            <div class="image-btn">
                <input type="file" name="user_image" id="user_image" placeholder="Enter something">
                <button class="imageButton" type="submit" data-ingredients-id="">Submit</button>
            </div>
                <div class="user-acc">
                    <p class="user-para">Fullname</p>
                    <input type="text" placeholder="Eric Dimagiba" class="user-name">
                    <p class="user-para">Account Type</p>
                    <input type="text" placeholder="Staff" class="user-name">
                </div>
            </div>
            <div class="user-info">
                <p class="info">Username</p>
                <input type="text" class="info-text" placeholder="eric001">
                <p class="info">Password</p>
                <input type="text" class="info-text" placeholder="*********">
                <p class="info">Address</p>
                <input type="text" class="info-text" placeholder="Santa Maria, Bulacan">
                <p class="info">Contact Number</p>
                <input type="text" class="info-text" placeholder="0932*******">

            </div>
        </div>
    </div>
    </div>
</body>
</html>