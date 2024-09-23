<?php
header('Content-Type: application/json');

// Include the database configuration
$config = include('../config.php');

// Create connection
$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed", "details" => $conn->connect_error]));
}

// Fetch all molecule data from the database
$sql = "SELECT * FROM b2_molecules";
$result = $conn->query($sql);

$molecules = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $molecules[] = $row;
    }
}

$conn->close();

// Output JSON
echo json_encode($molecules);
?>
