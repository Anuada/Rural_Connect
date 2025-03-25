<?php
session_start();
$title = "Forgot Password";
ob_start();
?>

<?php ob_start(); ?>
<link rel="stylesheet" href="../assets/css/login.css">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="../page/">Rural Connect</a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="../page/">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="aboutus.php">About Us</a></li>
            <li class="nav-item"><a class="nav-link" href="value.php">Value</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        </ul>
    </div>
</nav>

<form action="../logic/forgot-password.php" method="post" id="loginform">
    <div class="login-container">
        <img src="../assets/img/misc/delivery_pic.jpeg" alt="Logo" />
        <div class="login-form">
            <h2>Forgot Password</h2>
            <input placeholder="Email" required aria-label="Email" type="text" id="email" name="email" />
            <button type="submit" name="submit">Submit</button>
            <a class="create-account" href="../page/login.php">Back to Login →</a>
        </div>
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<?php $scripts = ob_get_clean(); ?>
<?php require_once "../shared/layout.php"; ?>