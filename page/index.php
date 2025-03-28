<?php
session_start();
$load = false;
?>

<?php ob_start() ?>

<div class="text">
    <h1>Rural Connect</h1>
    <p>Ultimately, RURAL CONNECT aims to bridge the healthcare gap between urban and rural areas, ensuring that
        all residents, irrespective of location, have access to the medical care they require. By addressing
        logistical, communication, and supply chain issues, this platform will play a pivotal role in enhancing
        healthcare access for mountain barangays.</p>

    <?php if (!isset($_SESSION["accountId"])): ?>
        <a class="more-info" href="../page/signup.php" aria-label="Sign up for Rural Connect">Sign up</a>
    <?php endif ?>
</div>
<div class="image">
    <img src="../assets/img/misc/med2.JPG" alt="Illustration of team collaboration">
</div>

<?php $land_page_content = ob_get_clean() ?>

<?php require_once "../shared/landing_page_layout.php" ?>