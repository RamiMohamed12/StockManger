<!DOCTYPE html>
<?php
require_once 'config/config.php';

session_start(); 

//if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  //  header("Location: /src/View/dashboard.html");
 //   exit;
// }

$name = $password = "";
$name_err = $password_err = $login_err = ""; 

if($_SERVER["REQUEST_METHOD"]=="POST"){

    if(empty(trim($_POST['name']))){
        $name_err = "Please enter a name.";
    } else {
        $name = trim($_POST['name']);
    } 

    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";
    } else {
        $password = trim($_POST['password']);
    }

    if(empty($name_err) && empty($password_err)){

        $sql = "SELECT id, name, password FROM users WHERE name = ?";

        if($stmt = mysqli_prepare($conn, $sql)){

            mysqli_stmt_bind_param($stmt, "s", $param_name);

            $param_name = $name; 

            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){

                    mysqli_stmt_bind_result($stmt, $id, $name, $hashed_password);

                    if(mysqli_stmt_fetch($stmt)){

                        if(password_verify($password, $hashed_password)){

                            $_SESSION['loggedin'] = true;
                            $_SESSION['id'] = $id;
                            $_SESSION['name'] = $name;

                            header("Location: src/View/dashboard.php");
                            exit;

                        } else {
                            $login_err = "Username or password don't match.";
                        }
                    }

                } else {
                    $login_err = "Username or password don't match.";
                }

            } else {
                echo "Oops! Something went wrong. Please try again later.";
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
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="src/View/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        <?php 
        if(!empty($login_err)){
            echo '<div class="error">' . $login_err . '</div>';
        }        
        ?>
        <form method="post" action="index.php">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" placeholder="Name" value="<?php echo htmlspecialchars($name); ?>" required>
                <span class="error"><?php echo $name_err; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Password" required>
                <span class="error"><?php echo $password_err; ?></span>
            </div>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>
</body>
</html>