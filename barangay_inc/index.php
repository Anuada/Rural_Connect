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

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/barangay.index.css">
<?php $styles = ob_get_clean() ?>

<?php ob_start(); ?>
<!-- Main Container -->
<div class="container" style="padding-top:150px">
    <h2 class="text-center text-primary">Welcome to Barangay Health Dashboard</h2>

    <div class="row mt-5">
        <div class="col-md-4">
            <a href="pending_requests.php" class="text-decoration-none">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-warning text-white text-center">
                        <h4>Pending Requests</h4>
                    </div>
                    <div class="card-body text-center">
                        <h3 class="display-4">10</h3>
                        <p class="text-muted">Awaiting approval</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="approved_requests.php" class="text-decoration-none">

                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Approved Requests</h4>
                    </div>
                    <div class="card-body text-center">
                        <h3 class="display-4">8</h3>
                        <p class="text-muted">Ready for delivery</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="completed_requests.php" class="text-decoration-none">

                <div class="card shadow-lg border-0">
                    <div class="card-header bg-success text-white text-center">
                        <h4>Cancelled Requests</h4>
                    </div>
                    <div class="card-body text-center">
                        <h3 class="display-4">15</h3>
                        <p class="text-muted">Successfully delivered</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<script src="../assets/js/navbar.js"></script>
<?php $scripts = ob_get_clean(); ?>
<?php require_once "../shared/layout.php"; ?>