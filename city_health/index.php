<?php
session_start();
require_once "../util/DbHelper.php";
require_once "../shared/session.city_health.php";

$db = new DbHelper();
$title = "Index City Health";

// Fetch the pending, accepted, and cancelled requests count
$pendingCount = $db->countPending();
$acceptedCount = $db->countAccempted();
$cancelledCount = $db->countCancelled();

ob_start();
include "../shared/navbar_city_health.php";
$navbar = ob_get_clean();
?>

<?php ob_start(); ?>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/sidebar_city_health.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 bg-dark text-white vh-100 p-3" style="margin-top: 30px;">
        <br>
        <br>
        <br>
            <h4 class="text-center">City Health Officer</h4>
            <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white" href="#"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="uploadAvailableMed.php"><i class="fas fa-upload me-2"></i> Upload Medicine</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="request_med.php"><i class="fas fa-prescription-bottle me-2"></i> Requested Medicine</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#"><i class="fas fa-cogs me-2"></i> Settings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="view_med.php"><i class="fas fa-pills me-2"></i> Available Medicine</a>
            </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 p-4" style="margin-top: 10%;">
            <div class="row">
                <!-- Pending Requests Card -->
                <div class="col-md-4">
                    <div class="card text-center" style="width: 100%; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#pendingChartModal">
                        <div class="card-body">
                            <i class="fas fa-hourglass-half fa-5x text-warning"></i>
                            <h4 class="mt-3"><?= $pendingCount ?></h4>
                            <p class="card-text">Pending Requests</p>
                        </div>
                    </div>
                </div>

                <!-- Accepted Requests Card -->
                <div class="col-md-4">
                    <div class="card text-center" style="width: 100%; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#acceptedChartModal">
                        <div class="card-body">
                            <i class="fas fa-check-circle fa-5x text-success"></i>
                            <h4 class="mt-3"><?= $acceptedCount ?></h4>
                            <p class="card-text">Accepted Requests</p>
                        </div>
                    </div>
                </div>

                <!-- Cancelled Requests Card -->
                <div class="col-md-4">
                    <div class="card text-center" style="width: 100%; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#cancelledChartModal">
                        <div class="card-body">
                            <i class="fas fa-times-circle fa-5x text-danger"></i>
                            <h4 class="mt-3"><?= $cancelledCount ?></h4>
                            <p class="card-text">Cancelled Requests</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals for Charts -->
    <div class="modal fade" id="pendingChartModal" tabindex="-1" aria-labelledby="pendingChartLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pendingChartLabel">Pending Requests Chart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <canvas id="pendingChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="acceptedChartModal" tabindex="-1" aria-labelledby="acceptedChartLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="acceptedChartLabel">Accepted Requests Chart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <canvas id="acceptedChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cancelledChartModal" tabindex="-1" aria-labelledby="cancelledChartLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelledChartLabel">Cancelled Requests Chart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <canvas id="cancelledChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function createChart(canvasId, label, count, bgColor, borderColor) {
        var ctx = document.getElementById(canvasId).getContext('2d');

        if (window[canvasId + 'Instance']) {
            window[canvasId + 'Instance'].destroy();
        }

        window[canvasId + 'Instance'] = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [label],
                datasets: [{
                    label: label,
                    data: [count],
                    backgroundColor: bgColor,
                    borderColor: borderColor,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    document.getElementById('pendingChartModal').addEventListener('shown.bs.modal', function () {
        createChart('pendingChart', 'Pending Requests', <?= $pendingCount ?>, 'rgba(255, 193, 7, 0.7)', 'rgba(255, 193, 7, 1)');
    });

    document.getElementById('acceptedChartModal').addEventListener('shown.bs.modal', function () {
        createChart('acceptedChart', 'Accepted Requests', <?= $acceptedCount ?>, 'rgba(40, 167, 69, 0.7)', 'rgba(40, 167, 69, 1)');
    });

    document.getElementById('cancelledChartModal').addEventListener('shown.bs.modal', function () {
        createChart('cancelledChart', 'Cancelled Requests', <?= $cancelledCount ?>, 'rgba(220, 53, 69, 0.7)', 'rgba(220, 53, 69, 1)');
    });
</script>
<?php $scripts = ob_get_clean(); ?>

<?php require_once "../shared/layout.php"; ?>
