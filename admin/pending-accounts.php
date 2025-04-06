<?php
session_start();
require_once "../shared/session.admin.php";
require_once "./is.admin.authenticated.php";
?>

<?php ob_start() ?>
pending accounts
<?php $admin_content = ob_get_clean() ?>

<?php require_once "_admin-layout.php" ?>