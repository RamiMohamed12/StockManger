<?php
include '../../config/config.php';
include '../Model/employee.php';

$employee = new Employee($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int) $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $salary = (float) $_POST['salary'];
    $profession = $_POST['profession'];

    if ($employee->update($id, $name, $address, $email, $salary, $profession)) {
        header("Location: ../View/employee.php");
    } else {
        echo "Error: Could not update employee.";
    }
    mysqli_close($conn);
} else if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $row = $employee->getById($id);

    if ($row) {
        $name = $row['name'];
        $address = $row['address'];
        $email = $row['email'];
        $salary = $row['salary'];
        $profession = $row['profession'];
    } else {
        echo "No employee found with id: $id";
        exit;
    }
    mysqli_close($conn);
} else {
    echo "Invalid request.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Employee</title>
    <link rel="stylesheet" type="text/css" href="../View/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="form-container">
        <a href="../View/employee.php" style="text-decoration: none; font-size: 20px;">
            <i class="fa-solid fa-arrow-left"></i>
        </a>    
        <h2>Edit Employee</h2>
        <form method="post" action="edit_employee.php">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="form-group">
                <label for="salary">Salary:</label>
                <input type="number" name="salary" value="<?php echo htmlspecialchars($salary); ?>" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="profession">Profession:</label>
                <input type="text" name="profession" value="<?php echo htmlspecialchars($profession); ?>" required>
            </div>
            <button type="submit">Update Employee</button>
        </form>
    </div>
</body>
</html>