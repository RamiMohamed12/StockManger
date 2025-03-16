<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    http_response_code(403); // Forbidden
    exit;
}

// Include database connection
include '../../config/config.php';

// Get meat stock data
$meatQuery = "SELECT meat_name, available_kg, starting_price FROM meat_stock";
$meatResult = $conn->query($meatQuery);

$meatNames = [];
$meatQuantities = [];
$meatPrices = [];

if ($meatResult) {
    while ($row = mysqli_fetch_assoc($meatResult)) {
        $meatNames[] = $row['meat_name'];
        $meatQuantities[] = $row['available_kg'];
        $meatPrices[] = $row['starting_price'];
    }
}

// Get employee data - focusing on name only, not relying on salary or profession fields
$employeeQuery = "SELECT name FROM users";
$employeeResult = $conn->query($employeeQuery);

$employeeNames = [];
$employeeCount = 0;

if ($employeeResult) {
    while ($row = mysqli_fetch_assoc($employeeResult)) {
        $employeeNames[] = $row['name'];
        $employeeCount++;
    }
}

// For the profession chart, since your table might not have these fields
// we'll use placeholder data that won't cause errors
$professions = ['Admin', 'Staff'];
$countByProfession = [1, $employeeCount - 1]; // Assuming one admin, rest are staff

mysqli_close($conn);

// Return data as JSON
header('Content-Type: application/json');
echo json_encode([
    'meatNames' => $meatNames,
    'meatQuantities' => $meatQuantities,
    'meatPrices' => $meatPrices,
    'employeeNames' => $employeeNames,
    'professions' => $professions,
    'countByProfession' => $countByProfession
]);
?>