<?php 
session_start();
require_once "../shared/session.subscription.php";
?>

<?php

require_once "../enums/SubscriptionPlan.php";
$plans = SubscriptionPlan::all();

if (!isset($_GET["plan"]) || empty(trim($_GET["plan"])) || !in_array($_GET["plan"], $plans)) {
    header("Location: ../subscription/");
    exit();
}

$plan = $_GET["plan"];

?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/subscription.all.css">
<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>
<?php require_once "../shared/navbar.subscription.php" ?>
<?php $navbar = ob_get_clean() ?>


<?php ob_start() ?>
<div class="container" style="padding-top:130px">
    <div class="d-flex justify-content-around align-items-center">
        <form action="../logic/barangay-subscription.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="plan" value="<?php echo $plan ?>">
            <div class="image-box" style="margin-bottom:10px" onclick="document.getElementById('imageInput').click()">
                <span id="placeholder">Click to upload receipt</span>
                <img id="preview" src="" alt="" style="display: none;" />
            </div>

            <input type="file" name="receipt" id="imageInput" accept="image/*" onchange="showImage(event)">
            <p>
                <button class="btn btn-primary w-100" name="submit">Submit</button>
            </p>
        </form>
        <img src="../assets/img/misc/qrcode.png" alt="QR Code">
    </div>
</div>

<?php $content = ob_get_clean() ?>


<?php ob_start() ?>
<script src="../assets/js/subscription.details.js"></script>
<?php $scripts = ob_get_clean() ?>


<?php require_once "../shared/layout.php" ?>