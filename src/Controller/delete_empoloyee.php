<?php
include '../../config/config.php';
include '../Model/employee.php';

$employee = new Employee($conn);

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    
    if ($employee->delete($id)) {
        header("Location: ../View/employee.php");
    } else {
        echo "Error: Could not delete employee.";
    }
    mysqli_close($conn);
} else {
    echo "Invalid request.";
    exit;
}
?>