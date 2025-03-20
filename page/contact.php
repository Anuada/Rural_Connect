<?php
session_start();
$load = false;
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/landing_page.css">
<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>
<div class="container">
    <?php include "../shared/navbar_landing_page_main.php" ?>

    <div class="hero">
        <div class="text">
            <h1>Contact Us</h1>
            <p><strong>Project Manager:</strong> Heroshi Paro</p>
            <p><strong>Contact:</strong> 09055565546</p>
            <p><strong>Email:</strong> <a href="mailto:heroshigonzales@gmail.com">heroshigonzales@gmail.com</a></p>
        </div>
        <div class="image" style="max-width: 50%">
            <img src="../assets/img/misc/med2.JPG" alt="Illustration of team collaboration">
        </div>
    </div>
</div>
<?php $content = ob_get_clean() ?>

<?php require_once "../shared/layout.php" ?>