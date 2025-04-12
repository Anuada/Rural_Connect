<?php
session_start();
require_once "../util/DbHelper.php";
require_once "../shared/session.barangay_inc.php";

$db = new DbHelper();

$med_avail = $db->getRecord('med_availability', ['id' => $_GET['id']]);
$limit = (int) ($med_avail['quantity'] * 0.20);
$title = "Request Medicine - City Health";

ob_start();
include "../shared/navbar_barangay_inc.php";
$navbar = ob_get_clean();
?>

<?php ob_start(); ?>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<style>
    body {
        background-color: #f0f8ff;
        font-family: 'Poppins', sans-serif;
    }

    .navbar {
        background-color: hsl(0, 0.00%, 98.80%) !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .container {
        margin-top: 180px;
        padding-bottom: 2px;
    }

    .request-card,
    .qr-container {
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease-in-out;
    }

    .request-card:hover,
    .qr-container:hover {
        transform: scale(1.02);
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 12px;
        font-weight: bold;
        border-radius: 8px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6 request-card">
            <h4 class="text-center text-primary mb-4"><i class="fas fa-medkit"></i> Medicine Request Form</h4>
            <form action="../logic/request_med.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="barangay_inc_id" value="<?= htmlspecialchars($_SESSION['accountId']) ?>">
                <input type="hidden" name="city_health_id" value="<?= htmlspecialchars($_GET['city_health_id']) ?>">
                <input type="hidden" name="med_avail_id" value="<?= htmlspecialchars($_GET['id']) ?>">
                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-sort-numeric-up"></i> Quantity</label>
                    <input type="number" class="form-control" name="request_quantity" max="<?php echo $limit ?>"
                        placeholder="Enter Quantity" required>
                </div>
                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-file-invoice"></i> Document For Request</label>
                    <input type="file" class="form-control" name="document" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary w-100"><i class="fas fa-paper-plane"></i>
                    Submit Request</button>
            </form>
        </div>
    </div>
    <?php $content = ob_get_clean(); ?>

    <?php ob_start(); ?>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <?php $scripts = ob_get_clean(); ?>

    <?php require_once "../shared/layout.php"; ?>