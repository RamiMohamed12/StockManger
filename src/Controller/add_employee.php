<?php
include '../../config/config.php';
include '../Model/employee.php';

$employee = new Employee($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $address = htmlspecialchars(trim($_POST['address']));   
    $email = htmlspecialchars(trim($_POST['email']));
    $salary = (float) $_POST['salary'];
    $profession = htmlspecialchars(trim($_POST['profession']));
    
    if ($employee->add($name, $address, $email, $salary, $profession)) {
        header("Location: ../View/employee.php");
        exit();
    } else {
        echo "Error: Could not add employee.";
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Employee</title>
    <link rel="stylesheet" type="text/css" href="../View/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="form-container">
        <a href="../View/employee.php" style="text-decoration: none; font-size: 20px;">
            <i class="fa-solid fa-arrow-left"></i>
        </a>    
        <h2>Add Employee</h2>
        <form method="post" action="add_employee.php">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" name="address" placeholder="Address" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="salary">Salary:</label>
                <input type="number" name="salary" placeholder="Salary" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="profession">Profession:</label>
                <input type="text" name="profession" placeholder="Profession" required>
            </div>
            <button type="submit">Add Employee</button>
        </form>
    </div>
</body>
</html>