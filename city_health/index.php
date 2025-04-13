<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../util/DbHelper.php";

$db = new DbHelper();

$pendingCount = $db->countPending();
$acceptedCount = $db->countAccempted();
$cancelledCount = $db->countCancelled();

$city_health_title = "Dashboard";
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/city.health.dashboard.css">
<?php $city_health_styles = ob_get_clean() ?>

<?php ob_start() ?>
<div class="row" style="margin-bottom: 20px">
    <!-- Pending Requests Card -->
    <div class="col-md-4">
        <div class="card text-center" style="width: 100%;">
            <div class="card-body">
                <i class="fas fa-hourglass-half fa-5x text-warning"></i>
                <h4 class="mt-3"><?php echo $pendingCount ?></h4>
                <p class="card-text">Pending Requests</p>
            </div>
        </div>
    </div>

    <!-- Accepted Requests Card -->
    <div class="col-md-4">
        <div class="card text-center" style="width: 100%;">
            <div class="card-body">
                <i class="fas fa-check-circle fa-5x text-success"></i>
                <h4 class="mt-3"><?php echo $acceptedCount ?></h4>
                <p class="card-text">Accepted Requests</p>
            </div>
        </div>
    </div>

    <!-- Cancelled Requests Card -->
    <div class="col-md-4">
        <div class="card text-center" style="width: 100%;">
            <div class="card-body">
                <i class="fas fa-times-circle fa-5x text-danger"></i>
                <h4 class="mt-3"><?php echo $cancelledCount ?></h4>
                <p class="card-text">Cancelled Requests</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="chart-box">
            <h4>Requests Chart</h4>
            <canvas id="barChart"></canvas>
        </div>
    </div>
</div>
<?php $city_health_content = ob_get_clean() ?>


<?php ob_start() ?>
<script type="module" src="../assets/js/city_health/dashboard.js"></script>
<?php $city_health_scripts = ob_get_clean() ?>

<?php require_once "_city-health-layout.php" ?>