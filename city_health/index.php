<?php
session_start();
require_once "../util/DbHelper.php";
require_once "../shared/session.city_health.php";

$db = new DbHelper();
$title = "Index City Health";

ob_start();
include "../shared/navbar_city_health.php";
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