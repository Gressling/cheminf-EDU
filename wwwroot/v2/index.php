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
                    <ul>
                        <li><a class="link" href="dbTest.php">dbTest</a></li>
                        <li><a class="link" href="ping.php">ping</a></li>
                        <li><a class="link" href="test.php">session</a></li>
                        <li><a class="link" href="api.php?apiKey=242KKlhkh899">api (key)</a> - <a class="link" href="api.php">api (no key)</a></li>
                        <li><a class="link" href="call-rest-get.html">REST api from HTML</a></li>
                        <li><a class="link" href="logout.php">logout</a></li>
                    </ul>
                </div>
                <div class="license">MIT Licence - no commercial interest</div>
            </div>
        </body>
        </html>
        