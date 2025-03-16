<?php
include '../../config/config.php';
include '../Model/meat.php';

$meat = new Meat($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $meat_name = htmlspecialchars(trim($_POST['meat_name']));
    $available_kg = (float) $_POST['available_kg'];
    $starting_price = (float) $_POST['starting_price'];

    if ($meat->add($meat_name, $available_kg, $starting_price)) {
        header("Location: ../View/stock.php");
        exit();
    } else {
        echo "Error: Could not add meat.";
    }
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Meat</title>
    <link rel="stylesheet" type="text/css" href="../View/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="form-container">
        <a href="../View/stock.php" style="text-decoration: none; font-size: 20px;">
            <i class="fa-solid fa-arrow-left"></i>
        </a>    
        <h2>Add Meat</h2>
        <form method="post" action="add.php">
            <div class="form-group">
                <label for="meat_name">Meat Name:</label>
                <input type="text" name="meat_name" placeholder="Meat Name" required>
            </div>
            <div class="form-group">
                <label for="available_kg">Available KG:</label>
                <input type="number" name="available_kg" placeholder="Available (kg)" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="starting_price">Starting Price:</label>
                <input type="number" name="starting_price" placeholder="Starting Price" step="0.01" required>
            </div>
            <button type="submit">Add Meat</button>
        </form>
    </div>
</body>
</html>