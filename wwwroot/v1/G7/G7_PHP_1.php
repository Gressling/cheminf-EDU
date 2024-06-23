<?php
// Babysteps
echo "Hello World, I am using PHP!<br />";
echo "Group G7<br /><br />";

//DB Acess
$dbhost = "den1.mysql6.gear.host";
$dbname = "situation"; 
$dbusername = "situation";   
$dbpassword = "cogni77.";    

//DB Connection
$mysqli = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
echo "Conection to DB established (hopefully) <br />";
echo $mysqli->host_info."<br /><br />";

//Test the Parameter-Thing
echo "Time to use parameters<br />";
$param1 = $_GET['param1'] ?? "Getting parameter 1 failed";
$param2 = $_GET['param2'] ?? "Getting parameter 2 failed";
echo "Tried to get both parameters<br />";
echo "Parameter 1: ".$param1."<br />";
echo "Parameter 2: ".$param2."<br /><br />";

//Select something from the DB
echo "Lets do some SQL-stuff <br />";
    //Doing the Select-query
$sqlstatement = "SELECT * FROM situation.les_unit_operation_distillation";
$return = $mysqli->query($sqlstatement);

    //Showing return
    if ($return->num_rows == 0){
        echo "no rows found<br /><br />";
    } elseif ($return->num_rows == 1) {
        echo $return->num_rows . " row found<br /><br />";
    } else {
        echo $return->num_rows . " rows found<br /><br />";
    } 
    
    
    echo "<table border='2'>";
    echo "<tr>
            <th> Type </th>
            <th> Mixture </th>
            <th> Temperature </th>
            <th> Pressure </th>
            <th> Heating Rate </th>
            <th> Cooling Rate </th>
        </tr>";
    
        if ($return->num_rows > 0) {
            while($row = $return->fetch_assoc()) {
              echo "<tr><td>" . $row["type"]. "</td>";
              echo "<td>" . $row["Mixture"] . "</td>";
              echo "<td>" . $row["Temperature"] . "</td>";
              echo "<td>" . $row["Pressure"] . "</td>";
              echo "<td>" . $row["HeatingRate"] . "</td>";
              echo "<td>" . $row["CoolingRate"]. "</td</tr>";
            }
          } else {
            echo "No rows found<br />";
          }
    echo "</table><br /><br />";
    $mysqli->close();
    echo "SQL-Conection closed";
?>