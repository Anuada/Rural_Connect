<?php 
session_start();
$load = false; 
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/landing_page.css">
<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>
<div class="container">
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
            <h1>About Us</h1>
            <p><strong>Rural Connect</strong> is an initiative that ensures essential medicines and healthcare supplies
                reach barangays efficiently. Our project bridges the gap between urban healthcare providers and local
                communities, making medical assistance accessible.</p>
            <p>Developed by students from <strong>University of Cebu - Main Campus</strong>, we are committed to
                innovation and community service. By optimizing logistics, we streamline medical deliveries from
                <strong>CityHealth</strong> to barangays, improving accessibility.
            </p>
            <p>Our mission is to enhance healthcare delivery, reduce delays, and support local health units in providing
                timely care. Through technology and logistics, we aim to create a healthier, more connected community.
            </p>
        </div>
        <div class="image">
            <img src="../assets/img/misc/med2.JPG" alt="Illustration of team collaboration">
        </div>
    </div>
</div>
<?php $content = ob_get_clean() ?>

<?php require_once "../shared/layout.php" ?>