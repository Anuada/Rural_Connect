<?php
session_start();
require_once "../shared/session.admin.php";
require_once "./is.admin.authenticated.php";
$admin_title = "Sample";
?>

<?php ob_start() ?>
<!-- css/styles here -->
<?php $admin_styles = ob_get_clean() ?>

<?php ob_start() ?>
Sample
<?php $admin_content = ob_get_clean() ?>


<?php ob_start() ?>
<!-- javascripts/scripts here -->
<?php $admin_scripts = ob_get_clean() ?>

<?php require_once "_admin-layout.php" ?>