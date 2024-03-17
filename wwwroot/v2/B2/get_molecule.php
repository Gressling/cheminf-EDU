<?php
// Database connection
$servername = "den1.mysql6.gear.host";
$username = "situation";
$password = "cogni88.";
$dbname = "situation";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get MoleculeID from the request
$moleculeID = $_GET['moleculeID'];

// Fetch molecule data from the database
$sql = "SELECT * FROM b2_molecules WHERE MoleculeID = $moleculeID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Return all data entries to the client as a JSON string
    echo json_encode($row);
} else {
    echo "Molecule not found";
}

// Close the database connection
$conn->close();
?>