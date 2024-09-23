<?php
require 'session.php'; // 确保这是正确的路径
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Session Information</title>
    <style>
        .session-info {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            font-size: 1.5em;
        }
        .session-info h3 {
            margin-top: 0;
            font-size: 2em;
        }
        .session-info p {
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="session-info">
        <h3>Session Information</h3>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
        <p><strong>Last Activity:</strong> <?php echo date("Y-m-d H:i:s", $_SESSION['LAST_ACTIVITY']); ?></p>
        <p><strong>Session Timeout:</strong> <?php echo ($_SESSION['timeout'] / 3600) . " hours"; ?></p>
    </div>
    <div class="license">MIT Licence - no commercial interest</div>
</body>
</html>
