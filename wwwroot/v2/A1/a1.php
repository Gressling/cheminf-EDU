<?php
// Environment variable for API Key
$envApiKey = getenv('CUSTOMCONNSTR_MY_API_KEY');

// Retrieve API key from request header or query parameter
$requestApiKey = isset($_GET['apiKey']) ? $_GET['apiKey'] : '';

header('Content-Type: application/json');
if ($requestApiKey === $envApiKey) {
    // Database connection parameters
    $connStr = getenv('CUSTOMCONNSTR_strConn');
    list($dbhost, $dbname, $dbusername, $dbpassword) = explode(';', $connStr);
    
    // Create database connection
    $conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        http_response_code(500); // Internal Server Error
        echo json_encode(['message' => 'Database connection failed: ' . $conn->connect_error]);
        exit();
    }
    
    // Query to fetch experiments data
    $sql = "SELECT * FROM a1_experiments";
    $result = $conn->query($sql);
    
    if ($result) {
        $experiments = [];
        while ($row = $result->fetch_assoc()) {
            array_push($experiments, $row);
        }
        echo json_encode(['message' => 'A1 Access granted', 'data' => $experiments]);
    } else {
        echo json_encode(['message' => 'Error retrieving experiments: ' . $conn->error]);
    }
    
    // Close database connection
    $conn->close();
} else {
    http_response_code(401); // Unauthorized
    echo json_encode(['message' => 'A1 Access denied']);
}
?>
