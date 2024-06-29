<?php

if (isset($_GET["id"])) {

    $category = $_GET['id'];

    include '../include/dbConnection.php';

    //Create Connection



    $sql = "DELETE FROM ingredients_category WHERE category_id = $category";
    $conn->query($sql);
}

// header("location: ./viewUser.php");
