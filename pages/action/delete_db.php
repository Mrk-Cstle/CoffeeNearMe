<?php

    if( isset($_GET["id"])){

        $user_id = $_GET['id'];

        $server = "localhost";
        $username = "root";
        $password = "";
        $db = "coffeenearme"; 

        //Create Connection

        $conn = mysqli_connect($server, $username, $password, $db);

        $sql = "DELETE FROM user WHERE user_id=$user_id";
        $conn->query($sql);

        
    }

   // header("location: ./viewUser.php");
?>