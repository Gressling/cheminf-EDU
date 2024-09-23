<?php
// Include the database configuration
$config = include('../config.php');

// Create connection
$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the POST request and validate
$moleculeName = isset($_POST['moleculeName']) ? trim($_POST['moleculeName']) : '';
$canonicalSmile = isset($_POST['canonicalSmile']) ? trim($_POST['canonicalSmile']) : '';
$casId = isset($_POST['casId']) ? trim($_POST['casId']) : '';
$formular = isset($_POST['formular']) ? trim($_POST['formular']) : '';

// Basic validation
if (empty($moleculeName) || empty($canonicalSmile) || empty($casId) || empty($formular)) {
    die("All fields are required.");
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO b2_molecules (MoleculeName, CanonicalSmileFormat, CasId, Formular) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $moleculeName, $canonicalSmile, $casId, $formular);

// Execute the query
if ($stmt->execute()) {
    echo "Molecule saved successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
