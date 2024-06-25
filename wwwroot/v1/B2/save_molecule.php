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

// Get data from the POST request
$moleculeName = $_POST['moleculeName'];
$canonicalSmile = $_POST['canonicalSmile'];
$casId = $_POST['casId'];
$formular = $_POST['formular'];

// Insert data into the database
$sql = "INSERT INTO b2_molecules (MoleculeName, CanonicalSmileFormat, CasId, Formular)
        VALUES ('$moleculeName', '$canonicalSmile', '$casId', '$formular')";

if ($conn->query($sql) === TRUE) {
    echo "Molecule saved successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>