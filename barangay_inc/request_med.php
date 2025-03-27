<?php
session_start();
require_once "../util/DbHelper.php";
require_once "../shared/session.barangay_inc.php";

$db = new DbHelper();
$title = "Request Medicine - City Health";

ob_start();
include "../shared/navbar_barangay_inc.php";
$navbar = ob_get_clean();
?>

<?php ob_start(); ?>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/request_med.css">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="container">
    <div class="row">
        <div class="request-card col-4">
            <h4 class="text-center mb-4"><i class="fas fa-medkit"></i> Medicine Request Form</h4>
            <form action="../logic/request_med.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="barangay_inc_id" value="<?= htmlspecialchars($_SESSION['accountId']) ?>">
                <input type="hidden" name="city_health_id" value="<?= htmlspecialchars($_GET['city_health_id']) ?>">
                <input type="hidden" name="med_avail_id" value="<?= htmlspecialchars($_GET['id']) ?>">


                <div class="form-group mb-3">
                    <label for="request_category"><i class="fas fa-list"></i> Request Category</label>
                    <input type="text" class="form-control" id="request_category" name="request_category" placeholder="Enter Request Category" required>
                </div>

                <div class="form-group mb-3">
                    <label for="request_DosageForm"><i class="fas fa-prescription-bottle"></i> Dosage Form</label>
                    <input type="text" class="form-control" id="request_DosageForm" name="request_DosageForm" placeholder="Enter Dosage Form (e.g., Tablet, Syrup)" required>
                </div>

                <div class="form-group mb-3">
                    <label for="request_DosageStrength"><i class="fas fa-vial"></i> Dosage Strength (mg/ml)</label>
                    <input type="text" class="form-control" id="request_DosageStrength" name="request_DosageStrength" placeholder="Enter Dosage Strength" required>
                </div>

                <div class="form-group mb-3">
                    <label for="request_quantity"><i class="fas fa-sort-numeric-up"></i> Quantity</label>
                    <input type="number" class="form-control" id="request_quantity" name="request_quantity" placeholder="Enter Quantity" required>
                </div>
                <label class="form-label fw-bold">Upload Receipt</label>
                <input type="file" class="form-control mb-3" name="upload_receipt" id="upload_receipt" required accept="image/png, image/jpeg, image/webp">


                <button type="submit" name="submit" class="btn btn-primary w-100"><i class="fas fa-paper-plane"></i> Submit Request</button>

            </form>

        </div>

        <div class="request-card col-4">
            <h2 style="margin-top:5%;" class="text-center text-primary mb-4">Scan QR Code for Payment</h2>

            <div class="row justify-content-center align-items-center">
                <!-- QR Code Display -->
                <div class="text-center">
                    <img src="../assets/img/misc/qrcode.webp" alt="QR Code" class="img-fluid shadow-lg rounded" style="max-width: 300px;">
                </div>
            </div>
        </div>
    </div>
    <?php $content = ob_get_clean(); ?>

    <?php ob_start(); ?>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <?php $scripts = ob_get_clean(); ?>

    <?php require_once "../shared/layout.php"; ?>