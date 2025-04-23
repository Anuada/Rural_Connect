<?php
session_start();
require_once "../shared/session.delivery.php";
require_once "../util/Misc.php";
$deliveries_title = Misc::displayPageTitle("Dashboard","fa-home");
?>

<?php ob_start() ?>
<!-- css/styles here -->
<?php $deliveries_styles = ob_get_clean() ?>

<?php ob_start() ?>
Sample
<?php $deliveries_content = ob_get_clean() ?>


<?php ob_start() ?>
<!-- javascripts/scripts here -->
<?php $deliveries_scripts = ob_get_clean() ?>

<?php require_once "_deliveries-layout.php" ?>