<?php
session_start();
$title = "Login";
ob_start();
?>

<?php ob_start(); ?>
<link rel="stylesheet" href="../assets/css/login1.css">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="navbar-container">
    <?php include "../shared/navbar_landing_page.php"; ?>
</div>
<form action="../logic/login.php" method="post" id="loginform">
    <div class="login-container">
        <img src="../assets/img/misc/delivery_pic.jpeg" alt="Logo" />
        <div class="login-form">
            <center>
                <h2>Login</h2>
            </center>
            <input placeholder="Username" required aria-label="Username" type="text" id="username" name="username" />
            <input placeholder="Password" required aria-label="Password" type="password" id="password"
                name="password" />
            <button type="submit" name="login">LOGIN</button>
            <a class="forgot-password" href="../page/forgot-password.php">Forgot Password?</a>
            <a class="create-account" href="../page/signup.php">Create your Account →</a>
        </div>
    </div>
</form>
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<?php $scripts = ob_get_clean(); ?>
<?php require_once "../shared/layout.php"; ?>