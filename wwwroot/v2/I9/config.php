<?php
$config = include(__DIR__ . '/../config.php');

$dbhost = $config['db_host'];
$dbname = $config['db_name'];
$dbusername = $config['db_user'];
$dbpassword = $config['db_pass'];

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage());
    echo "Database connection failed. Please try again later.";
}
?>
