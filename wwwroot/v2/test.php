<?php
require 'session.php'; // Ensure this is the correct path to your session script

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

$username = htmlspecialchars($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hello World</title>
    <link rel="stylesheet" href="../style.css"> <!-- Link to your CSS file -->
</head>
<body>
<div class="container">
    <h2>Hello World!</h2>
    <p>Welcome, <?php echo $username; ?>.</p>
    <div class="links">
        <a href="index.php">Home</a><br>
        <a href="logout.php">Logout</a> <!-- Ensure you have a logout.php to handle session destruction -->
    </div>
    <div class="license">MIT Licence - no commercial interest</div>
</div>
</body>
</html>