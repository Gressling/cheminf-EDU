<?php
session_start();

$timeout = 24 * 60 * 60; // 24 hours in seconds
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
    session_unset();
    session_destroy();
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php"); // redirect to login page
    exit;
}

// Display session content
echo '<pre>';
echo 'Session Data:' . PHP_EOL;
print_r($_SESSION);
echo '</pre>';
?>
