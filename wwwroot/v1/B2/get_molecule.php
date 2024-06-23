<?php
// Database connection
$servername = "den1.mysql6.gear.host";
$username = "situation";
$password = "cogni77.";
$dbname = "situation";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get MoleculeID from the request
$moleculeID = $_GET['moleculeID'];

// Fetch molecule data from the database
$sql = "SELECT CanonicalSmileFormat FROM b2_molecules WHERE MoleculeID = $moleculeID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $canonicalSmile = $row['CanonicalSmileFormat'];

    // Return the CanonicalSmileFormat to the client
    echo $canonicalSmile;
} else {
    echo "Molecule not found";
}

// Close the database connection
$conn->close();
?>