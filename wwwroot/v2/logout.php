<?php
session_start();

// Unset all session values
$_SESSION = array();

// Destroy session
session_destroy();

// Redirect to login page
header("Location: login.php");
exit;
?>