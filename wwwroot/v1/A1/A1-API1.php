<?php
echo '<h1>Group A1</h1>';
// Hello World
echo '<p>Hello World</p>';

//Database access
$dbhost = "den1.mysql6.gear.host";
$dbname = "situation"; 
$dbusername = "situation";   
$dbpassword = "cogni77.";    

//Database connection
$mysqli = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

echo $mysqli->host_info . "<br /><br />";

// Example

echo "VAL TESTER val1, val2 (V1) <br /><br />";
// Extract GET parameters
$getval1 = $_GET['val1'] ?? null;
$getval2 = $_GET['val2'] ?? null;
// Echo GET parameter values
echo "GET Parameters:<br />";
echo "val1: " . $getval1 . "<br />";
echo "val2: " . $getval2 . "<br />";
echo "<br />";
// Extract PUT parameters
parse_str(file_get_contents("php://input"), $putParams);
$putval1 = $putParams['val1'] ?? null;
$putval2 = $putParams['val2'] ?? null;
// Echo PUT parameter values
echo "PUT Parameters:<br />";
echo "val1: " . $putval1 . "<br />";
echo "val2: " . $putval2 . "<br />";
echo "<br/>";
//Exercise 1 Group A1



//Select and show tabel
    $sqlstatement = "SELECT * FROM situation.test";
    $result = $mysqli->query($sqlstatement);

echo "Es wurden " . $result->num_rows . " Datensaetze gefunden.<br /><br /><br />";

echo "<table border='1'>";
echo "<tr><th>Val1</th><th>Val2</th></tr>";

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>" . $row["val1"]. "</td>";
          echo "<td>" . $row["val2"]. "</td</tr>";
        }
      } else {
        echo "Error: No data in DB-Table";
      }
echo "</table>";

$mysqli->close();

?>
