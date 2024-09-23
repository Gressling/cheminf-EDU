<?php
// 引入配置文件
$config = include(__DIR__ . '/../config.php');

// 数据库凭证
$host = $config['db_host'];
$dbname = $config['db_name'];
$username = $config['db_user'];
$password = $config['db_pass'];

// 建立数据库连接
$conn = new mysqli($host, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected to MySQL database. <br /><br />";

// 尝试执行 SELECT 查询
$query = "SELECT val1, val2 FROM test"; // 使用适合您表的列名
$result = $conn->query($query);

// 开始 HTML 表格
echo "<table border='1' style='width:100%; text-align:left; background-color:#FDB912;'>";
echo "<tr style='background-color:#A90432;'>";
echo "<th>ID Number</th>";
echo "<th>val1</th>";
echo "<th>val2</th>";
echo "</tr>";

if ($result) {
    // 如果找到结果，获取并显示每一行数据
    if ($result->num_rows > 0) {
        // 获取并显示结果数量
        $totalRecords = $result->num_rows;
        echo "<p>Total Records: " . $totalRecords . "</p>";
        $idNumber = 1; // 初始化 ID 号码
        // 输出每一行的数据
        while ($row = $result->fetch_assoc()) {
            echo "<tr style='color:red;'>";
            echo "<td>" . $idNumber++ . "</td>"; // 每行递增 ID 号码
            echo "<td>" . htmlspecialchars($row["val1"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["val2"]) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>0 results found in the database.</td></tr>";
    }
} else {
    echo "Error: " . $conn->error;
}

// 结束 HTML 表格
echo "</table>";

// 关闭数据库连接
$conn->close();
?>
