<!DOCTYPE html>
<?php 
require 'config/config.php';

$name = $password = $confirm_password = "";
$name_err = $password_err = $confirm_password_err = "";

if($_SERVER ["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST['name']))){

        $name_err = "Please enter a name."; 

    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST['name']))){

        $name_err = "name can only contain letters, numbers, and underscores.";

    } else {

        $sql = "SELECT id FROM users WHERE name = ?";

        if($stmt = mysqli_prepare($conn, $sql)){

            mysqli_stmt_bind_param($stmt, "s", $param_name);

            $param_name = trim($_POST['name']);

            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){

                    $name_err = "This name is already taken.";

                } else {

                    $name = trim($_POST['name']);

                }

            } else {

                echo "Oops! Something went wrong. Please try again later.";

            }

            mysqli_stmt_close($stmt);

        }

    }

    if(empty(trim($_POST['password']))){

        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST['password'])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } elseif (!preg_match('/[0-9]/', trim($_POST['password']))) {
        $password_err = "Password must have at least 1 number.";
    } elseif (!preg_match('/[A-Z]/', trim($_POST['password']))) {
        $password_err = "Password must have at least 1 uppercase letter.";
    } elseif (!preg_match('/[a-z]/', trim($_POST['password']))) {
        $password_err = "Password must have at least 1 lowercase letter.";
    } else {
        $password = trim($_POST['password']);
    }

    if(empty(trim($_POST['confirm_password']))){

        $confirm_password_err = "Please confirm password.";
    
    } else {

        $confirm_password = trim($_POST['confirm_password']);

        if(empty($password_err) && ($password != $confirm_password)){

            $confirm_password_err = "Password did not match.";

        }

    }

    if(empty($name_err) && empty($password_err) && empty($confirm_password_err)){
        $sql = "INSERT INTO users (name, password) VALUES (?, ?)";
        if($stmt = mysqli_prepare($conn, $sql )){
            mysqli_stmt_bind_param($stmt, "ss", $param_name, $param_password);

            $param_name = $name;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if (mysqli_stmt_execute($stmt)){
                
                header("location: index.php");
                
            } else {

                echo "Something went wrong. Please try again later.";

            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($conn);
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="src/View/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="form-container">
        <a href="index.php" style="text-decoration: none; font-size: 20px;">
            <i class="fa-solid fa-arrow-left"></i>
        </a>    
        <h2>Register</h2>
        <form method="post" action="register.php">
            <div class="form-group">
                <label for="name">name:</label>
                <input type="text" name="name" placeholder="name" value="<?php echo htmlspecialchars($name); ?>" required>
                <span class="error"><?php echo $name_err; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <div class="password-container">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <i class="fa-solid fa-eye" id="togglePassword"></i>
                </div>
                <span class="error"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <div class="password-container">
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                    <i class="fa-solid fa-eye" id="toggleConfirmPassword"></i>
                </div>
                <span class="error"><?php echo $confirm_password_err; ?></span>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
    <script src="togglePassword.js"></script>
</body>
</html>