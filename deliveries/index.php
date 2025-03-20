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

<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    
</head>
<body>

    <!-- Navbar -->
    <?= $navbar ?>

    <!-- Main Container -->
    <div class="container mt-4">
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
                        <h4>Completed Requests</h4>
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

    <script src="../assets/js/navbar.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<script src="../assets/js/navbar.js"></script>
<?php $scripts = ob_get_clean(); ?>
<?php require_once "../shared/layout.php"; ?>