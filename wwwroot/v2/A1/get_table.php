<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$config = include('../config.php');

$servername = $config['db_host'];
$username = $config['db_user'];
$password = $config['db_pass'];
$dbname = $config['db_name'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 获取所有表名
$tables_result = $conn->query("SHOW TABLES");
$tables = [];
if ($tables_result) {
    while ($row = $tables_result->fetch_array()) {
        $tables[] = $row[0];
    }
}

// 获取请求参数
$table_name = isset($_GET['table']) ? $_GET['table'] : null;

// 验证请求的表名
if ($table_name && in_array($table_name, $tables)) {
    // 查询指定表
    $query = "SELECT * FROM `$table_name` LIMIT 0, 5"; // 限制输出前5行
    $result = $conn->query($query);
    
    $data = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    
    // 返回 JSON 格式的数据，直接输出 data 部分
    echo json_encode(['data' => $data]);
} else {
    // 返回空的 data
    echo json_encode(['data' => []]);
}

// 关闭连接
$conn->close();
?>
