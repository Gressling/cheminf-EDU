<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>Inventory Database</title>
    <style>
        table {
            border-collapse: collapse;
            margin-top: 25px;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
        }
        td {
            background-color: #f2f2f2;
        }
        th {
            background-color: #f2f2f2;
        }
        caption {
            text-align: left;
            font-weight: bold;
            font-size: 25px;
        }
    </style>
</head>
<body id="page_body">
    <div class="row" id="pagetitle">
        <div class="col-md-12">
            <h1>Inventory Database</h1>
        </div>
    </div>

    <form method="post">
        <input type="submit" name="table" value="Chemicals" />
        <input type="submit" name="table" value="Devices" />
        <input type="submit" name="table" value="Materials" />
        <input type="submit" name="table" value="Inventory" />
    </form>

    <?php
    require '../auth.php';
    $config = include(__DIR__ . '/../config.php');
    $host = $config['db_host'];
    $dbname = $config['db_name'];
    $username = $config['db_user'];
    $password = $config['db_pass'];

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $tables = [
        'Chemicals' => [
            'tableName' => 'H8_Chemicals',
            'headers' => "<th>ID</th><th>Name</th><th>Quantity (g)</th><th>Storage Location</th><th>Purchase Price (€)</th><th>Price (€/g)</th><th>Purchase Date</th><th>Expiration Date</th>"
        ],
        'Devices' => [
            'tableName' => 'H8_Devices',
            'headers' => "<th>ID</th><th>Name</th><th>Location</th><th>Type</th><th>Value (€)</th>"
        ],
        'Materials' => [
            'tableName' => 'H8_Materials',
            'headers' => "<th>ID</th><th>Name</th><th>Quantity (pcs)</th><th>Location</th><th>Value (€)</th>"
        ],
        'Inventory' => [
            'tableName' => 'h8_chemical_inventory_usage',
            'headers' => "<th>ID</th><th>Quantity Used</th><th>Unit</th><th>Usage Location</th><th>Chemical Name</th><th>CAS</th><th>Reason</th>"
        ]
    ];

    if (isset($_POST['table']) && array_key_exists($_POST['table'], $tables)) {
        $selectedTable = $_POST['table'];
        $tableInfo = $tables[$selectedTable];
        $tableName = $tableInfo['tableName'];
        $columnHeaders = $tableInfo['headers'];

        $stmt = $conn->prepare("SELECT * FROM " . $tableName);
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            die("Error executing query: " . $conn->error);
        }

        echo "<div class='row' id='table'>";
        echo "<div class='col-md-12'>";
        echo "<table>";
        echo "<caption>" . htmlspecialchars($selectedTable) . "</caption>";
        echo "<tr>" . $columnHeaders . "</tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
            }
            echo "</tr>";
        }

        echo "</table></div></div>";
        $stmt->close();
    } else {
        echo "<p>Please select a valid table.</p>";
    }

    $conn->close();
    ?>
</body>
</html>
