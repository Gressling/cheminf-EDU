<?php
require '../auth.php';
echo "test.php val1, val2 (V1) <br /><br />";

$config = include(__DIR__ . '/../config.php');
$host = $config['db_host'];
$dbname = $config['db_name'];
$username = $config['db_user'];
$password = $config['db_pass'];
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected to mysql database. \n";
}

parse_str(file_get_contents("php://input"), $putParams);
if (!empty($putParams['val1']) && !empty($putParams['val2'])) {
    $sendval1 = $putParams['val1'];
    $sendval2 = $putParams['val2'];
}

if (!empty($_GET['val1']) && !empty($_GET['val2'])) {
    $sendval1 = $_GET['val1'];
    $sendval2 = $_GET['val2'];
}

echo "Parameters:<br />";
echo "val1: " . $sendval1 . "<br />";
echo "val2: " . $sendval2 . "<br />";
echo "<br />";

$sqlquery = "SELECT * FROM situation.test";
$result = $conn->query($sqlquery);

if ($result->num_rows > 0) {
    echo "Total rows: " . $result->num_rows . "<br>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Val 1</th><th>Val 2</th></tr>";
    $allRows = $result->fetch_all(MYSQLI_ASSOC);

    for ($i = 0; $i < count($allRows); $i++) {
        echo "<tr>";
        echo "<td>" . ($i + 1) . "</td>";
        echo "<td>" . $allRows[$i]["val1"] . "</td>";
        echo "<td>" . $allRows[$i]["val2"] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
