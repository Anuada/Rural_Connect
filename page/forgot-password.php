<?php
session_start();
$title = "Forgot Password";
ob_start();
?>

<?php ob_start(); ?>
<link rel="stylesheet" href="../assets/css/login1.css">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="navbar-container">
    <?php include "../shared/navbar_landing_page.php"; ?>
</div>
<form action="../logic/forgot-password.php" method="post" id="loginform">
    <div class="login-container">
        <img src="../assets/img/misc/delivery_pic.jpeg" alt="Logo" />
        <div class="login-form">
            <center>
                <h2>Forgot Password</h2>
            </center>
            <input placeholder="Email" required aria-label="Email" type="text" id="email" name="email" />
            <button type="submit" name="submit">SUBMIT</button>
            <a class="create-account" href="../page/login.php">Back To Login →</a>
        </div>
    </div>
</form>
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<?php $scripts = ob_get_clean(); ?>
<?php require_once "../shared/layout.php"; ?>