<?php 

function getEnvValue($key) {
    $path = __DIR__ . '/../.env';
    if (file_exists($path)) {
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos($line, "$key=") === 0) {
                return trim(substr($line, strlen($key)+1));
            }
        }
    }
    return null;
}

$servername = getEnvValue('DB_HOST') ?: "localhost";
$username = getEnvValue('DB_USERNAME') ?: 'root'; 
$password = getEnvValue('DB_PASSWORD') ?: '';
$dbname = getEnvValue('DB_NAME') ?: 'stock'; 

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 
$info = "Connected successfully";
?>
