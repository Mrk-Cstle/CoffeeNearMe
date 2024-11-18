<?php
// session.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
function checkLogin()
{
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('Location: ../index.php');
        exit();
    }
}
