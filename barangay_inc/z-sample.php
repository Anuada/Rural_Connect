<?php
session_start();
require_once "../shared/session.barangay_inc.php";
require_once "../util/Misc.php";
$barangay_inc_title = Misc::displayPageTitle("Dashboard","fa-home");
?>

<?php ob_start() ?>
<!-- css/styles here -->
<?php $barangay_inc_styles = ob_get_clean() ?>

<?php ob_start() ?>
Sample
<?php $barangay_inc_content = ob_get_clean() ?>


<?php ob_start() ?>
<!-- javascripts/scripts here -->
<?php $barangay_inc_scripts = ob_get_clean() ?>

<?php require_once "_barangay-inc-layout.php" ?>