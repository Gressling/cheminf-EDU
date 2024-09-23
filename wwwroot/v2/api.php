<?php

// Environment variable for API Key
$envApiKey = getenv('CUSTOMCONNSTR_MY_API_KEY');

// Retrieve API key from request
$requestApiKey = isset($_GET['apiKey']) ? $_GET['apiKey'] : '';

header('Content-Type: application/json; charset=UTF-8');

// Default response structure
$response = [
    'status' => 'error',
    'message' => 'Access denied',
    'data' => null
];

// Validate API key
if ($requestApiKey === $envApiKey) {
    // Successful response structure
    $response = [
        'status' => 'success',
        'message' => 'Access granted',
        'data' => [
            'info' => 'This is a secured data example',
            'timestamp' => date('Y-m-d H:i:s')
        ]
    ];
    http_response_code(200); // OK
} else {
    http_response_code(401); // Unauthorized
}

// Output JSON response
echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>
