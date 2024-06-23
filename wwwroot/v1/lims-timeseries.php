<?php
    echo "lims-tiemseries.php fkeyLimsDevice, timestamp, sensorValue (V1) <br /><br />"; 

    // DATABASE 
    $host = "den1.mysql6.gear.host"; 
    $dbname = "situation";    // Database name
    $username = "situation";                    // Database username
    $password = "cogni66.";                        // Database password
    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        echo "Connected to mysql database. \n";
    }

    // extract VALUES 

    parse_str(file_get_contents("php://input"), $putParams);
    if(!empty($putParams['fkeyLimsDevice']) && !empty($putParams['timestamp']) && !empty($putParams['sensorValue']) ){
        $fkey_limsDevice = $putParams['fkeyLimsDevice'];
        $timestamp = $putParams['timestamp'];
        $sensorValue = $putParams['sensorValue'];
    }
    if(!empty($_GET['fkeyLimsDevice']) && !empty($_GET['timestamp']) && !empty($_GET['sensorValue']) ){
        $fkey_limsDevice = $_GET['fkeyLimsDevice'];
        $timestamp = $_GET['timestamp'];
        $sensorValue = $_GET['sensorValue'];
    }

    echo "Parameters:<br />";
    echo "fkeyLimsDevice: " . $fkey_limsDevice . "<br />";
    echo "timestamp: " . $timestamp . "<br />";    
    echo "timestamp: " . $sensorValue . "<br />";    
    echo "<br />"; 
    
    // perform SQL 
    $sql = "INSERT INTO lims_timeseries (fkey_limsDevice, timestamp, sensorValue) VALUES ('".$fkey_limsDevice."','".$timestamp."','".$sensorValue."')";    
    echo "$sql";
    if ($conn->query($sql) === TRUE) {
        echo "Values inserted in MySQL database table.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();

?>
    

