<?php
session_start();

include("config.php"); 

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['valid'] = $row['email'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['id'] = $row['id'];

        header("Location: traitement_formulaire.php");
        exit();
    } else {
        $errorMessage = "Wrong Username or Password";
    }

    $stmt->close();
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index1.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <?php if (isset($errorMessage)) : ?>
                <div class='message'>
                    <p><?php echo $errorMessage; ?></p>
                </div>
                <br>
            <?php endif; ?>

            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login">
                </div>

                <div class="links">
                    Don't have an account? <a href="sign_up.php">Sign Up Now</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
