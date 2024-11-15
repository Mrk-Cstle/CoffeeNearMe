<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function hasAccess($requiredRole)
{
    return isset($_SESSION['account_type']) && $_SESSION['account_type'] === $requiredRole;
}
