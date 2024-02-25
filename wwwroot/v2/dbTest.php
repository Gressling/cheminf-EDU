<?php

// DB
$connStr = getenv('CUSTOMCONNSTR_strConn');
list($host, $dbname, $user, $password) = explode(';', $connStr);
session_start();
$message = '';
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {echo ("Connection failed: " . $conn->connect_error);}

// Select example

$sql = "SELECT * FROM situation.h8_chemicals;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. " - quantity: " . $row["quantity"]. "<br>";
    }
} else {
    echo "0 results";
}

?>
