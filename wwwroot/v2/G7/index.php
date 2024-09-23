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
    $dbhost = $config['db_host'];
    $dbname = $config['db_name'];
    $dbusername = $config['db_user'];
    $dbpassword = $config['db_pass'];

    $mysqli = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $param1 = $_GET['param1'] ?? null;
    $param2 = $_GET['param2'] ?? null;

    if ($param1 && $param2) {
        echo "Param 1: $param1 <br> Param 2: $param2 <br><br>";
    } else {
        echo "GET parameters missing: param1 and/or param2<br><br>";
    }

    $sqlstatement1 = "SELECT * FROM g7_les_unit_operations_degradation";
    $result1 = $mysqli->query($sqlstatement1);

    if ($result1->num_rows === 0) {
        echo "No rows found in g7_les_unit_operations_degradation<br /><br />";
    } elseif ($result1->num_rows === 1) {
        echo $result1->num_rows . " row found in g7_les_unit_operations_degradation<br /><br />";
    } else {
        echo $result1->num_rows . " rows found in g7_les_unit_operations_degradation<br /><br />";
    }

    echo "<h2>g7_les_unit_operations_degradation</h2>";
    echo "<table>";
    echo "<tr>
            <th>ID</th>
            <th>Reactor Robot ID</th>
            <th>Experiment Group</th>
            <th>Workflow Step</th>
            <th>Parameter Name</th>
            <th>Parameter Value</th>
            <th>Execution Time</th>
            <th>Inefficiency Score</th>
          </tr>";

    if ($result1->num_rows > 0) {
        while ($row1 = $result1->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row1["id"] . "</td>";
            echo "<td>" . $row1["reactor_robot_id"] . "</td>";
            echo "<td>" . $row1["experiment_group"] . "</td>";
            echo "<td>" . $row1["workflow_step"] . "</td>";
            echo "<td>" . $row1["parameter_name"] . "</td>";
            echo "<td>" . $row1["parameter_value"] . "</td>";
            echo "<td>" . $row1["execution_time"] . "</td>";
            echo "<td>" . $row1["inefficiency_score"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No rows found</td></tr>";
    }
    echo "</table><br /><br />";

    $sqlstatement2 = "SELECT * FROM g7_les_uo_params";
    $result2 = $mysqli->query($sqlstatement2);

    if ($result2->num_rows === 0) {
        echo "No rows found in g7_les_uo_params<br /><br />";
    } elseif ($result2->num_rows === 1) {
        echo $result2->num_rows . " row found in g7_les_uo_params<br /><br />";
    } else {
        echo $result2->num_rows . " rows found in g7_les_uo_params<br /><br />";
    }

    echo "<h2>g7_les_uo_params</h2>";
    echo "<table>";
    echo "<tr>
            <th>Unit Operation ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Params</th>
          </tr>";

    if ($result2->num_rows > 0) {
        while ($row2 = $result2->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row2["Unit_Operation_ID"] . "</td>";
            echo "<td>" . $row2["UOName"] . "</td>";
            echo "<td>" . $row2["UODescription"] . "</td>";
            echo "<td>" . $row2["UOParams"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No rows found</td></tr>";
    }
    echo "</table><br /><br />";

    $mysqli->close();
    ?>
</body>
</html>
