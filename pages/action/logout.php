<?php
include 'session.php';

// Destroy session
session_unset();
session_destroy();

// Optionally, you can return a response if needed
echo 'Logged out successfully';
