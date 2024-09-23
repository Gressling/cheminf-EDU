<?php
// Include database configuration
$config = include(__DIR__ . '/../config.php');


// Database connection details
$servername = $config['db_host'];
$username = $config['db_user'];
$password = $config['db_pass'];
$dbname = $config['db_name'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all molecule data from the database
$sql = "SELECT * FROM b2_molecules";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "MoleculeID: " . $row["MoleculeID"]. " - Name: " . $row["MoleculeName"]. " - SMILES: " . $row["CanonicalSmileFormat"]. " - CAS ID: " . $row["CasId"]. " - Formula: " . $row["Formular"]. "\n";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
