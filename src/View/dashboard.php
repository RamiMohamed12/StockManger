<?php
session_start();

// Check if the user is logged in, if not redirect to login page
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
    <title>Stock Management Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <div class="header">
            <h2>Stock Management System</h2>
            <div class="user-info">
                Welcome, <b><?php echo htmlspecialchars($_SESSION["name"]); ?></b>
                <a href="../../logout.php" class="logout-btn">Logout</a>
            </div>
        </div>

        <div class="dashboard-cards">
            <div class="card">
                <i class="fas fa-drumstick-bite"></i>
                <h3>Meat Inventory</h3>
                <p>Manage your meat stock inventory, add new items, update quantities and track stock levels.</p>
                <a href="stock.php" class="card-btn">Go to Stock</a>
            </div>

            <div class="card">
                <i class="fas fa-users"></i>
                <h3>Employee Management</h3>
                <p>Manage your employees, their roles and responsibilities within the stock management system.</p>
                <a href="employee.php" class="card-btn">Manage Employees</a>
            </div>

            <div class="card">
                <i class="fas fa-chart-line"></i>
                <h3>Reports</h3>
                <p>Generate and view reports on inventory levels, stock movement, and employee activities.</p>
                <a href="report.php" class="card-btn">View Reports</a>
            </div>

            <div class="card">
                <i class="fas fa-cog"></i>
                <h3>Settings</h3>
                <p>Configure system settings, user preferences, and notification parameters.</p>
                <a href="#" class="card-btn" onclick="alert('Coming soon!')">Settings</a>
            </div>
        </div>
    </div>
</body>
</html>