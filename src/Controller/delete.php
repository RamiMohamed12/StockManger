<?php
include '../../config/config.php';
include '../Model/meat.php';

$meat = new Meat($conn);

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    if ($meat->delete($id)) {
        header("Location: ../View/stock.php");
    } else {
        echo "Error: Could not delete meat.";
    }
    mysqli_close($conn);
} else {
    echo "Invalid request.";
    exit;
}
?>