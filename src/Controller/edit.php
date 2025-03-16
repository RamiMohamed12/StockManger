<?php
include '../../config/config.php';
include '../Model/meat.php';

$meat = new Meat($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int) $_POST['id'];
    $meat_name = $_POST['meat_name'];
    $available_kg = (float) $_POST['available_kg'];
    $starting_price = (float) $_POST['starting_price'];

    if ($meat->update($id, $meat_name, $available_kg, $starting_price)) {
        header("Location: ../View/stock.php");
    } else {
        echo "Error: Could not update meat.";
    }
    mysqli_close($conn);
} else if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $row = $meat->getById($id);

    if ($row) {
        $meat_name = $row['meat_name'];
        $available_kg = $row['available_kg'];
        $starting_price = $row['starting_price'];
    } else {
        echo "No record found with id: $id";
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
    <title>Edit Meat</title>
    <link rel="stylesheet" type="text/css" href="../View/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="form-container">
        <a href="../View/stock.php" style="text-decoration: none; font-size: 20px;">
            <i class="fa-solid fa-arrow-left"></i>
        </a>    
        <h2>Edit Meat</h2>
        <form method="post" action="edit.php">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <div class="form-group">
                <label for="meat_name">Meat Name:</label>
                <input type="text" name="meat_name" value="<?php echo htmlspecialchars($meat_name); ?>" required>
            </div>
            <div class="form-group">
                <label for="available_kg">Available KG:</label>
                <input type="number" name="available_kg" value="<?php echo htmlspecialchars($available_kg); ?>" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="starting_price">Starting Price:</label>
                <input type="number" name="starting_price" value="<?php echo htmlspecialchars($starting_price); ?>" step="0.01" required>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>


