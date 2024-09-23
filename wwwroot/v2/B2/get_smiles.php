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

// Fetch the molecule data from the database
$molecule = [];
if (isset($_GET['moleculeID']) && is_numeric($_GET['moleculeID'])) {
    $moleculeID = intval($_GET['moleculeID']);
    $stmt = $conn->prepare("SELECT * FROM b2_molecules WHERE MoleculeID = ?");
    $stmt->bind_param("i", $moleculeID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $molecule = $result->fetch_assoc();
        // Include MOLFile for JSME
        $molecule['MOLFile'] = ''; // You need to include the actual MOL file content if applicable
    } else {
        $molecule = ["message" => "No results"];
    }

    $stmt->close();
}

$conn->close();

// Output the data as JSON
header('Content-Type: application/json');
echo json_encode($molecule);
?>
