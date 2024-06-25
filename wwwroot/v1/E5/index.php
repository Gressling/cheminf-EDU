<?php
    // Hello World
    echo '<p>Hello World</p>';
    
    // DATABASE 
    $host = "den1.mysql6.gear.host";
    $dbname = "situation";      // Database name
    $username = "situation";    // Database username
    $password = "cogni77.";     // Database password
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if($conn->connect_error){
        echo "FAILED to connect! <br />";
        die("". $conn->connect_error);
    }
    echo "Connection sucess! <br />";;

    // Extract PUT parameters
    parse_str(file_get_contents("php://input"), $putParams);
    $putval1 = $putParams['val1'] ?? null;
    $putval2 = $putParams['val2'] ?? null;
    echo 'PUT: val1 '. $putval1 .' val2 '. $putval2 . " <br />";
    // Extract GET parameters
    $getval1 = $_GET['val1'] ?? null;
    $getval2 = $_GET['val2'] ?? null;
    echo 'GET: val1 '. $getval1 .' val2 '. $getval2 . " <br />";
    
    // SQL
    $sqlquery = "SELECT * FROM situation.test";
    $result = $conn->query($sqlquery);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "Val 1" . $row["val1"]. "<br>";
          echo "Val 2" . $row["val2"]. "<br>";
        }
      } else {
        echo "0 results";
      }

    $sqlquery2 = "SELECT * FROM situation.cdb_data";
    $result2 = $conn->query($sqlquery2);
    if ($result2->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "Val 1" . $row["val1"]. "<br>";
          echo "Val 2" . $row["val2"]. "<br>";
        }
      } else {
        echo "0 results";
      }

    $conn->close();
    ?>
