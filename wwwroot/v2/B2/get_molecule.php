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
    // Output a detailed error message
    die(json_encode(["error" => "Connection failed", "details" => $conn->connect_error]));
}

// Get MoleculeID from the request and validate it
if (isset($_GET['moleculeID']) && is_numeric($_GET['moleculeID'])) {
    $moleculeID = intval($_GET['moleculeID']);

    // Fetch molecule data from the database
    $stmt = $conn->prepare("SELECT * FROM b2_molecules WHERE MoleculeID = ?");
    if (!$stmt) {
        // Output a detailed error message
        die(json_encode(["error" => "Failed to prepare statement", "details" => $conn->error]));
    }

    $stmt->bind_param("i", $moleculeID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Return all data entries to the client as a JSON string
        echo json_encode($row);
    } else {
        // Output a more specific error message
        echo json_encode(["message" => "Molecule not found", "moleculeID" => $moleculeID]);
    }

    $stmt->close();
} else {
    // Output an error if the MoleculeID is invalid
    echo json_encode(["error" => "Invalid MoleculeID", "details" => $_GET['moleculeID'] ?? "No MoleculeID provided"]);
}

// Close the database connection
$conn->close();
?>
