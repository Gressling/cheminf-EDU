<?php
// Database connection
$servername = "den1.mysql6.gear.host";
$username = "situation";
$password = "cogni77.";
$dbname = "situation";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the MoleculeID from the query string
    $moleculeID = $_GET['moleculeID'];

    // Fetch the SMILES string from the database
    $sql = "SELECT CanonicalSmileFormat FROM b2_molecules WHERE MoleculeID = '" . $moleculeID . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output the SMILES string
        while($row = $result->fetch_assoc()) {
            echo $row["CanonicalSmileFormat"];
        }
    } else {
        echo "No results";
    }

    $conn->close();
?>
