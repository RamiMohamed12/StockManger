<?php
session_start();

// check if the user is logged in if not redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - Stock Management</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="report.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <a href="dashboard.php" class="back-link">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    
    <div class="reports-container">
        <div class="header">
            <h2>Reports Dashboard</h2>
        </div>
        
        <div class="chart-container">
            <div class="chart-card">
                <h3 class="chart-title">Meat Inventory Distribution</h3>
                <canvas id="meatPieChart"></canvas>
            </div>
            
            <div class="chart-card">
                <h3 class="chart-title">Meat Prices Comparison</h3>
                <canvas id="meatPriceChart"></canvas>
            </div>
        </div>
        
        <div class="chart-container">
            <div class="chart-card">
                <h3 class="chart-title">Inventory Value by Meat Type</h3>
                <canvas id="inventoryValueChart"></canvas>
            </div>
            
            <div class="chart-card">
                <h3 class="chart-title">Employee Distribution by Profession</h3>
                <canvas id="employeeChart"></canvas>
            </div>
        </div>
    </div>

    <div id="chartData" data-chart-endpoint="../Controller/getChartData.php"></div>
    
    <script src="report.js"></script>
</body>
</html>