<?php
require 'session.php'; // 确保这是正确的路径
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ping Result</title>
    <style>
        .ping-result {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            font-size: 1.5em; /* 调整字体大小 */
        }
        .ping-result h3 {
            margin-top: 0;
            font-size: 2em; /* 调整标题字体大小 */
        }
        .ping-result pre {
            background-color: #e9ecef;
            padding: 20px;
            border-radius: 5px;
            overflow-x: auto;
            font-size: 1.2em; /* 调整 pre 标签内字体大小 */
        }
        .ping-result .summary {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <div class="ping-result">
        <h3>Ping Result</h3>

<?php
// 获取数据库连接字符串
$connStr = getenv('CUSTOMCONNSTR_strConn');
list($host, $dbname, $user, $password) = explode(';', $connStr);

// 检查操作系统
$os = strtoupper(substr(PHP_OS, 0, 3));
$pingCommand = "";

if ($os === 'WIN') {
    // Windows系统使用 -n 选项
    $pingCommand = "ping -n 4 " . escapeshellarg($host);
} else {
    // Unix/Linux系统使用 -c 选项
    $pingCommand = "ping -c 4 " . escapeshellarg($host);
}

// 执行 ping 命令
$pingResult = array();
exec($pingCommand, $pingResult, $return_var);

// 检查ping命令是否成功执行
if ($return_var !== 0) {
    echo "<p>Ping command failed or requires administrative privileges.</p>";
} else {
    // 分离ping结果
    $output = implode("\n", $pingResult);
    $pattern = "/^(Pinging .+? with \d+ bytes of data:)\n((Reply from .+\n)+)\n(Ping statistics for .+:\nPackets: .+\nApproximate round trip times .+)\n/";
    preg_match($pattern, $output, $matches);

    if (!empty($matches)) {
        echo "<pre>" . htmlspecialchars($matches[1]) . "</pre>";
        echo "<pre>" . htmlspecialchars($matches[2]) . "</pre>";
        echo "<div class='summary'><pre>" . htmlspecialchars($matches[4]) . "</pre></div>";
    } else {
        echo "<pre>" . htmlspecialchars($output) . "</pre>";
    }
}
?>

    </div>
    <div class="license">MIT Licence - no commercial interest</div>
</body>
</html>
