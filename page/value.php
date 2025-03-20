<?php
session_start();
$load = false;
?>

<?php ob_start() ?>

<div class="text">
    <h1>Value</h1>
    <p><strong>Rural Connect</strong> is dedicated to ensuring that essential medicines and healthcare supplies
        reach barangays efficiently and reliably. With a strong commitment to <strong>accessibility, efficiency,
            and innovation</strong>, we utilize technology-driven solutions to optimize medical logistics and
        minimize delays.</p>
    <p>Rooted in <strong>community service and reliability</strong>, our initiative prioritizes the well-being
        of barangay residents by maintaining a seamless and dependable medical supply chain.</p>
</div>
<div class="image">
    <img src="../assets/img/misc/med2.JPG" alt="Illustration of team collaboration">
</div>

<?php $land_page_content = ob_get_clean() ?>

<?php require_once "../shared/landing_page_layout.php" ?>