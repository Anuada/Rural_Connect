<?php
session_start();
require_once "../shared/session.admin.php";
require_once "./is.admin.authenticated.php";
require_once "../util/Misc.php";
$admin_title = Misc::displayPageTitle("Settings","fa-gear");
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/admin.settings.css">
<?php $admin_styles = ob_get_clean() ?>

<?php ob_start() ?>
<div id="form_container"></div>

<?php $admin_content = ob_get_clean() ?>


<?php ob_start() ?>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="module" src="../assets/js/admin/settings.js"></script>

<?php $admin_scripts = ob_get_clean() ?>

<?php require_once "_admin-layout.php" ?>