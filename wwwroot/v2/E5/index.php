<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Results</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Database Results</h1>
    <?php
    require '../auth.php';
    $config = include(__DIR__ . '/../config.php');
    $host = $config['db_host'];
    $dbname = $config['db_name'];
    $username = $config['db_user'];
    $password = $config['db_pass'];
    $conn = new mysqli($host, $username, $password, $dbname);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    parse_str(file_get_contents("php://input"), $putParams);
    $putval1 = $putParams['val1'] ?? null;
    $putval2 = $putParams['val2'] ?? null;
    echo 'PUT: val1 ' . $putval1 . ' val2 ' . $putval2 . " <br />";

    $getval1 = $_GET['val1'] ?? null;
    $getval2 = $_GET['val2'] ?? null;
    echo 'GET: val1 ' . $getval1 . ' val2 ' . $getval2 . " <br />";

    $sqlquery = "SELECT * FROM test";
    $result = $conn->query($sqlquery);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Val 1</th><th>Val 2</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["val1"]. "</td><td>" . $row["val2"]. "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results for table 'test'";
    }

    $sqlquery2 = "SELECT * FROM cdb_data";
    $result2 = $conn->query($sqlquery2);

    if ($result2->num_rows > 0) {
        echo "<h2>Table: cdb_data</h2>";
        echo "<table>";
        echo "<tr><th>Val 1</th><th>Val 2</th></tr>";
        while($row2 = $result2->fetch_assoc()) {
            echo "<tr><td>" . $row2["val1"]. "</td><td>" . $row2["val2"]. "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results for table 'cdb_data'";
    }

    $conn->close();
    ?>
</body>
</html>
