<?php
session_start();
require_once "../shared/session.city_health.php";
$city_health_title = "Sample";
?>

<?php ob_start() ?>
<!-- css/styles here -->
<?php $city_health_styles = ob_get_clean() ?>

<?php ob_start() ?>
Sample
<?php $city_health_content = ob_get_clean() ?>


<?php ob_start() ?>
<!-- javascripts/scripts here -->
<?php $city_health_scripts = ob_get_clean() ?>

<?php require_once "_city-health-layout.php" ?>