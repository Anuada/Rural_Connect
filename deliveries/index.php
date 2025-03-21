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
    <title>Barangay Health Dashboard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            transition: transform 0.3s ease-in-out;
            border-radius: 15px;
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        .card-header {
            font-weight: bold;
            font-size: 1.2rem;
        }
        .card-body {
            font-size: 1.1rem;
        }
        @media (max-width: 768px) {
            .card-body h3 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?= $navbar ?> 

    <div class="container mt-4">
        <h2 class="text-center text-primary">Welcome to Barangay Health Dashboard</h2>
        
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_med.php">Ready for Delivery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./events.php">Order Medicine</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div style="width: 40px; height: 40px; background-color: #007bff; color: white; font-weight: bold; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 14px;">
                                B
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="#">Barangay</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="../user/#">Update Profile</a></li>
                            <li><a class="dropdown-item" href="../logic/logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container mt-5 pt-4 text-center">
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
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<script src="../assets/js/navbar.js"></script>
<?php $scripts = ob_get_clean(); ?>
<?php require_once "../shared/layout.php"; ?>