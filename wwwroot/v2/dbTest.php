<?php
require 'session.php'; // 确保这是正确的路径
$config = include('config.php'); // 引入同目录下的 config.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Database Test</title>
    <style>
        .db-test {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            font-size: 1.5em; /* 调整字体大小 */
        }
        .db-test h3 {
            margin-top: 0;
            font-size: 2em; /* 调整标题字体大小 */
        }
        .db-test pre {
            background-color: #e9ecef;
            padding: 20px;
            border-radius: 5px;
            overflow-x: auto;
            font-size: 1.2em; /* 调整 pre 标签内字体大小 */
        }
        .db-test .summary {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <div class="db-test">
        <h3>Check DB, via configuration ...</h3> 

<?php
// 获取数据库连接信息
$dbhost = $config['db_host'];
$dbname = $config['db_name'];
$dbusername = $config['db_user'];
$dbpassword = $config['db_pass'];

$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 执行查询
$sql = "SELECT * FROM situation.h8_chemicals;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<pre>";
    // 输出每行数据
    while($row = $result->fetch_assoc()) {
        echo "id: " . htmlspecialchars($row["id"]) . " - Name: " . htmlspecialchars($row["name"]) . " - quantity: " . htmlspecialchars($row["quantity"]) . "\n";
    }
    echo "</pre>";
} else {
    echo "<p>0 results</p>";
}

$conn->close();
?>

    </div>
    <div class="license">MIT Licence - no commercial interest</div>
</body>
</html>
