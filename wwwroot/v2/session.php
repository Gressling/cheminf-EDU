<?php
session_start();

$timeout = 24 * 60 * 60; // 24 hours in seconds
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
    // last request was more than 24 hours ago
    session_unset();     // unset $_SESSION variable
    session_destroy();   // destroy session data
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php"); // redirect to login page
    exit;
}
?>
