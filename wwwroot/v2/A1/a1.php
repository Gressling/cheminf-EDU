<?php

$config = include(__DIR__ . '/../config.php');

$storedApiKey = $config['api_key'];

$requestApiKey = isset($_GET['apiKey']) ? $_GET['apiKey'] : '';

header('Content-Type: application/json');

if ($requestApiKey === $storedApiKey) {
    $dbhost = $config['db_host'];
    $dbname = $config['db_name'];
    $dbusername = $config['db_user'];
    $dbpassword = $config['db_pass'];

    $conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        http_response_code(500);
        echo json_encode(['message' => 'Database connection failed: ' . $conn->connect_error]);
        exit();
    }

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

    $conn->close();
} else {
    http_response_code(401);
    echo json_encode(['message' => 'A1 Access denied']);
}

?>
