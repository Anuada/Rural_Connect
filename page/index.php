<?php 
session_start();
$load = false; 
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/landing_page.css">
<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>
<div class="container">
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo" style="margin-left: 10px">
            <img src="../assets/img/misc/delivery_pic.jpeg" style="object-fit: cover;" alt="Company Logo">
        </div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="aboutus.php">About Us</a></li>
            <li><a href="value.php">Value</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <a class="get-started" href="../page/login.php" style="margin-right: 10px" aria-label="Login">Login</a>
    </nav>

    <div class="hero">
        <div class="text">
            <h1>Rural Connect</h1>
            <p>Ultimately, RURAL CONNECT aims to bridge the healthcare gap between urban and rural areas, ensuring that
                all residents, irrespective of location, have access to the medical care they require. By addressing
                logistical, communication, and supply chain issues, this platform will play a pivotal role in enhancing
                healthcare access for mountain barangays.</p>
            <a class="more-info" href="../page/signup.php" aria-label="Sign up for Rural Connect">Sign up</a>
        </div>
        <div class="image">
            <img src="../assets/img/misc/med2.JPG" alt="Illustration of team collaboration">
        </div>
    </div>
</div>
<?php $content = ob_get_clean() ?>

<?php require_once "../shared/layout.php" ?>