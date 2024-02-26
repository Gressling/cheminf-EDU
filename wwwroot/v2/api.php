<?php
// Environment variable for API Key
$envApiKey = getenv('CUSTOMCONNSTR_MY_API_KEY');

// Retrieve API key from request header
$requestApiKey = isset($_GET['apiKey']) ? $_GET['apiKey'] : '';

// echo $envApiKey . "  //  ";
// echo $requestApiKey . " //  ";

header('Content-Type: application/json');
if ($requestApiKey === $envApiKey) {
    // Sample data response
    $data = ['message' => 'Access granted', 'data' => ['info' => 'This is a secured data example']];
    echo json_encode($data);
} else {
    http_response_code(401); // Unauthorized
    echo json_encode(['message' => 'Access denied']);
}
?>
