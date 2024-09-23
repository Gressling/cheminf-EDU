<?php
require 'session.php'; // 确保用户已登录

// 防止直接访问此页面
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}
    
// 安全地获取用户名
$username = htmlspecialchars($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>ChemInformatics EDU</title>
    <style>
        .welcome-text {
            text-align: center;
            margin-top: 50px;
            font-size: 24px;
        }
        .welcome-text h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        .welcome-text h2 {
            font-size: 36px;
            color: #555;
        }
        .content-frame {
            width: 100%;
            height: 80vh; /* 调整iframe高度，确保页面看起来整洁 */
            border: none;
        }
    </style>
    <script>
        function hideWelcome() {
            // 隐藏欢迎语
            document.getElementById('welcome').style.display = 'none';
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <h1 class="title">ChemInformatics EDU</h1>
            <h2>System</h2>
            <div class="section">
                <a class="link" href="dbTest.php" target="contentFrame" onclick="hideWelcome()"><i class="fas fa-database link-icon"></i>dbTest</a>
                <a class="link" href="ping.php" target="contentFrame" onclick="hideWelcome()"><i class="fas fa-wifi link-icon"></i>ping</a>
                <a class="link" href="session.php" target="contentFrame" onclick="hideWelcome()"><i class="fas fa-user link-icon"></i>session</a>
            </div>
            <h2>REST</h2>
            <div class="section">
                <a class="link" href="api.php?apiKey=242KKlhkh899" target="contentFrame" onclick="hideWelcome()"><i class="fas fa-key link-icon"></i>api (key)</a>
                <a class="link" href="api.php" target="contentFrame" onclick="hideWelcome()"><i class="fas fa-key link-icon"></i>api (no key)</a>
                <a class="link" href="call-rest-get.html" target="contentFrame" onclick="hideWelcome()"><i class="fas fa-code link-icon"></i>REST api from HTML</a>
                <a class="link" target="_blank" href="https://colab.research.google.com/drive/1xh7jvhI7x_jDN7fGYI6rxdZR9dZp1C-S"><i class="fas fa-book link-icon"></i>Jupyter on colab</a>
                <a class="link" target="_blank" href="https://gressling.redoc.ly/"><i class="fas fa-book link-icon"></i>API Reference (not public, login required)</a>
            </div>
            <h2>A1 - Experiments</h2>
            <div class="section">
                <a class="link" href="A1/index.php" target="contentFrame" onclick="hideWelcome()"><i class="fas fa-flask link-icon"></i>Experiments</a>
                <a class="link" href="A1/a1.html" target="contentFrame" onclick="hideWelcome()"><i class="fas fa-flask link-icon"></i>A1 REST</a>
            </div>
            <h2>B2 - ELN-Molecule</h2>
            <div class="section">
                <a class="link" href="B2/index.php" target="contentFrame" onclick="hideWelcome()"><i class="fas fa-atom link-icon"></i>JSME Molecule Editor</a>
            </div>
            <h2>C3 - LIMS-Device Management</h2>
            <div class="section">
                <a class="link" href="C3/select.php" target="contentFrame" onclick="hideWelcome()"><i class="fas fa-tools link-icon"></i>Device Management</a>
            </div>
            <h2>D4 - LIMS-TimeSeries</h2>
            <div class="section">
                <a class="link" href="D4/diagramm.php" target="contentFrame" onclick="hideWelcome()"><i class="fas fa-chart-line link-icon"></i>Time Series Data</a>
            </div>
            <h2>E5 - CDB-data</h2>
            <div class="section">
                <a class="link" href="E5/index.php" target="contentFrame" onclick="hideWelcome()"><i class="fas fa-database link-icon"></i>Chemical Database</a>
            </div>
            <h2>F6 - LES-Workflow</h2>
            <div class="section">
                <a class="link" href="F6/index.php" target="contentFrame" onclick="hideWelcome()"><i class="fas fa-project-diagram link-icon"></i>Laboratory Workflow</a>
            </div>
            <h2>G7 - LES-Unit Operations</h2>
            <div class="section">
                <a class="link" href="G7/index.php" target="contentFrame" onclick="hideWelcome()"><i class="fas fa-cogs link-icon"></i>Unit Operations</a>
            </div>
            <h2>H8 - Inventory</h2>
            <div class="section">
                <a class="link" href="H8/index.php" target="contentFrame" onclick="hideWelcome()"><i class="fas fa-boxes link-icon"></i>Inventory data</a>
                <a class="link" href="H8/manage.php" target="contentFrame" onclick="hideWelcome()"><i class="fas fa-boxes link-icon"></i>Inventory Management</a>
            </div>
            <h2>I9 - Molecular Properties</h2>
            <div class="section">
                <a class="link" href="I9/index.php" target="contentFrame" onclick="hideWelcome()"><i class="fas fa-vial link-icon"></i>Molecular Properties</a>
            </div>
            <h2>J10 - GENERAL</h2>
            <div class="section">
                <a class="link" href="J10/index.php" target="contentFrame" onclick="hideWelcome()"><i class="fas fa-info-circle link-icon"></i>General Information</a>
                <a class="link" href="logout.php" target="_self"><i class="fas fa-sign-out-alt link-icon"></i>logout</a>
            </div>
        </div>
        <div class="content">
            <!-- 欢迎语部分 -->
            <div class="welcome-text" id="welcome">
                <h1>Welcome to Chemistry AI Education Website</h1>
                <h2>Please choose your section on the left side</h2>
            </div>
            <!-- iframe 用于加载新内容 -->
            <iframe name="contentFrame" class="content-frame"></iframe>
        </div>
    </div>
</body>

</html>
