<?php

if (isset($_GET["id"])) {

    $ingredients_id = $_GET['id'];

    include '../include/dbConnection.php';

    //Create Connection



    $sql = "DELETE FROM ingredients WHERE ingredients_id=$ingredients_id";
    $conn->query($sql);
}

// header("location: ./viewUser.php");
