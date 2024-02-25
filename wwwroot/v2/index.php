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
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../style.css">
            <title>ChemInformatics EDU</title>
        </head>
        <body>
            <div class="container">
                <h1 class="title">ChemInformatics EDU</h1>
                <div class="links">
                    <a class="link" href="dbTest.php">dbTest</a><br/>
                    <a class="link" href="ping.php">ping</a><br/>
                    <a class="link" href="test.php">session</a><br/>
                    <a class="link" href="logout.php">logout</a><br/>
                </div>
                <div class="license">MIT Licence - no commercial interest</div>
            </div>
        </body>
        </html>
        