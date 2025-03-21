<?php
session_start();
$title = "Login";
ob_start();
?>

<?php ob_start(); ?>
<link rel="stylesheet" href="../assets/css/login.css">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="index.php">Rural Connect</a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="aboutus.php">About Us</a></li>
            <li class="nav-item"><a class="nav-link" href="value.php">Value</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        </ul>
    </div>
</nav>

<form action="../logic/login.php" method="post" id="loginform">
    <div class="login-container">
        <img src="../assets/img/misc/delivery_pic.jpeg" alt="Logo" />
        <div class="login-form">
            <h2>Login to Your Account</h2>
            <input placeholder="Username" required aria-label="Username" type="text" id="username" name="username" />
            <input placeholder="Password" required aria-label="Password" type="password" id="password"
                name="password" />
            <button type="submit" name="login">Login</button>
            <a class="forgot-password" href="../page/forgot-password.php">Forgot Password?</a>
            <a class="create-account" href="../page/signup.php">Create an Account →</a>
        </div>
    </div>
</form>
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<?php $scripts = ob_get_clean(); ?>
<?php require_once "../shared/layout.php"; ?>