<?php
session_start();
require_once "../util/DbHelper.php";
require_once "../shared/session.delivery.php";

$db = new DbHelper();
$title = "Index City Health";

ob_start();
include "../shared/navbar.deliveries.php";
$navbar = ob_get_clean();
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/deliveries.index.css">
<?php $styles = ob_get_clean() ?>

<?php ob_start(); ?>
<div class="container text-center" style="padding-top: 150px">
    <h2 class="text-primary">Welcome to Medical Deliveries</h2>

    <div class="row mt-5 justify-content-center">
        <div class="col-md-4 col-sm-6 mb-4">
            <a href="pending_requests.php" class="text-decoration-none">
                <div class="card shadow border-0">
                    <div class="card-header bg-warning text-white text-center">Pending Requests</div>
                    <div class="card-body text-center">
                        <h3 class="display-4">10</h3>
                        <p class="text-muted">Awaiting approval</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-sm-6 mb-4">
            <a href="approved_requests.php" class="text-decoration-none">
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white text-center">Approved Requests</div>
                    <div class="card-body text-center">
                        <h3 class="display-4">8</h3>
                        <p class="text-muted">Ready for delivery</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-sm-6 mb-4">
            <a href="completed_requests.php" class="text-decoration-none">
                <div class="card shadow border-0">
                    <div class="card-header bg-success text-white text-center">Completed Requests</div>
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