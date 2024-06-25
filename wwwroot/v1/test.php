<?php
    echo "test.php val1, val2 (V1) <br /><br />"; 

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
    if(!empty($putParams['val1']) && !empty($putParams['val2']) ){
        $sendval1 = $putParams['val1'];
        $sendval2 = $putParams['val2'];
    }
    if(!empty($_GET['val1']) && !empty($_GET['val2']) ){
            $sendval1 = $_GET['val1'];
            $sendval2 = $_GET['val2'];
    }

    echo "Parameters:<br />";
    echo "val1: " . $sendval1 . "<br />";
    echo "val2: " . $sendval2 . "<br />";    
    echo "<br />"; 
    
    // perform SQL 
    $sql = "INSERT INTO situation.test (val1, val2) VALUES ('".$sendval1."','".$sendval2."')";
    echo "$sql";
    if ($conn->query($sql) === TRUE) {
        echo "Values inserted in MySQL database table.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();

?>
