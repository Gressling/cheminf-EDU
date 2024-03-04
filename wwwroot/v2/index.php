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
        <h2 class="title">System</h1>
            <ul>
                <li><a class="link" href="dbTest.php">dbTest</a></li>
                <li><a class="link" href="ping.php">ping</a></li>
                <li><a class="link" href="test.php">session</a></li>
            </ul>
            <h2 class="title">REST</h1>
                <ul>
                    <li><a class="link" href="api.php?apiKey=242KKlhkh899">api (key)</a></li>
                    <li><a class="link" href="api.php">api (no key)</a></li>
                    <li><a class="link" href="call-rest-get.html">REST api from HTML</a></li>
                    <li><a class="link" target="_blank"
                            href="https://colab.research.google.com/drive/1xh7jvhI7x_jDN7fGYI6rxdZR9dZp1C-S">Jupyter on
                            colab</a></li>
                    <li><a class="link" target="_blank" href="https://gressling.redoc.ly/">API Reference (not public,
                            login required)</a></li>
                </ul>
                <h2 class="title">A1 - Experiments</h1>
            <ul>
                <li><a class="link" href="A1/index.php">Experiments</a></li>
                <li><a class="link" href="A1/a1.html">A1 REST</a></li>
            </ul>

                <a class="link" href="logout.php">logout</a>
        </div>
        <div class="license">MIT Licence - no commercial interest</div>
    </div>
</body>

</html>