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
<link rel="stylesheet" href="../assets/css/sidebar_city_health.css">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="sidebar">
    <h4 class="text-center text-white">City Health Officer </h4>
    <a href="#">Dashboard</a>
    <a href="#">Reports</a>
    <a href="#">Appointments</a>
    <a href="#">Settings</a>
    <a href="#">Logout</a>
</div>

<div style="margin-top:10%;" class="content">
    <h2>Welcome to City Health System</h2>
    <p>Select an option from the side menu.</p>
    
</div>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<script src="../assets/js/navbar.js"></script>
<?php $scripts = ob_get_clean(); ?>

<?php require_once "../shared/layout.php"; ?>
