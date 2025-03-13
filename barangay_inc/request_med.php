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

<?php ob_start(); ?>
<div class="container" style="margin-top: 10%;">
    <form action="../logic/request_med.php" method="post" enctype="multipart/form-data" id="submitformlegal">
        <input type="hidden" name="barangay_inc_id" value="<?= htmlspecialchars($_SESSION['accountId']) ?>">
        <input type="hidden" name="city_health_id" value="<?= htmlspecialchars($_GET['city_health_id']) ?>">

        <div class="form-group">
            <label for="request_quantity">Enter Request Quantity</label>
            <input type="number" class="form-control" id="request_quantity" name="request_quantity" placeholder="Enter Quantity" required>
        </div>

        <br>
        <button type="submit" name="submit" class="btn btn-primary w-100">Submit Now</button>
    </form>
</div>
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<?php $scripts = ob_get_clean(); ?>

<?php require_once "../shared/layout.php"; ?>
