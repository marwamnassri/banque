<?php
session_start();


if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {

    header("Location: dashbord.php");
    exit();
}
if (isset($_POST['login'])) {
    $admin_username = "admin"; 
    $admin_password = "admin"; 

    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    if ($input_username === $admin_username && $input_password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $admin_username;
        header("Location: dashbord.php");
        exit();
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index1.css">
    <title>Admin Login</title>
</head>

<body>
    <div class="container">
        <div class="box form-box">
            <?php if (isset($error_message)) : ?>
                <div class='message'>
                    <p><?php echo $error_message; ?></p>
                </div>
                <br>
            <?php endif; ?>

            <header>Admin Login</header>
            <form class="login-form" action="dashbord.php" method="POST">

                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="login" value="Login">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
