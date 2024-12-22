<?php
session_start();
require_once "../util/DbHelper.php";
require_once "../shared/session.barangay_inc.php";

$db = new DbHelper();
$title = "Index City Health";

ob_start();
include "../shared/navbar_barangay_inc.php";
$navbar = ob_get_clean();
?>

<?php ob_start(); ?>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<?php $styles = ob_get_clean(); ?>


<?php ob_start() ?>

<?php $content = ob_get_clean() ?>


<?php ob_start() ?>
<script src="../assets/js/navbar.js"></script>
<?php $scripts = ob_get_clean() ?>
<?php require_once "../shared/layout.php" ?>