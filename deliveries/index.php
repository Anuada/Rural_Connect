<?php
session_start();
require_once "../shared/session.delivery.php";
require_once "../util/Misc.php";
$deliveries_title = Misc::displayPageTitle("Dashboard", "fa-home");
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/dashboard.all.css">
<link rel="stylesheet" href="../assets/css/deliveries.dashboard.css">
<?php $deliveries_styles = ob_get_clean() ?>

<?php ob_start() ?>
<div class="kpi-container">
    <div class="kpi-card">
        <div class="d-flex justify-content-start align-items-center">
            <h5>Availability Status</h5>
            <label class="switch" style="margin-left:20px">
                <input type="checkbox" id="availability-toggle">
                <span class="slider round"></span>
            </label>
        </div>
        <p id="availability-status">Unavailable</p>
    </div>
</div>

<div class="kpi-container">
    <div class="kpi-card">
        <h5 id="total-ongoing-queues-label">Ongoing Queue</h5>
        <p id="total-ongoing-queues">0</p>
    </div>
    <div class="kpi-card">
        <h5 id="total-claimed-label">Claimed</h5>
        <p id="total-claimed">0</p>
    </div>
    <div class="kpi-card">
        <h5 id="total-returned-label">Returned</h5>
        <p id="total-returned">0</p>
    </div>
</div>

<div class="charts">
    <div class="chart-box">
        <h6>Ongoing Queue Breakdown</h6>
        <canvas id="ongoing-queues-chart"></canvas>
    </div>
    <div class="chart-box">
        <h6>Claimed Breakdown</h6>
        <canvas id="claimed-chart"></canvas>
    </div>
    <div class="chart-box">
        <h6>Returned Breakdown</h6>
        <canvas id="returned-chart"></canvas>
    </div>
</div>

<?php $deliveries_content = ob_get_clean() ?>


<?php ob_start() ?>
<script type="module" src="../assets/js/deliveries/dashboard.js"></script>
<?php $deliveries_scripts = ob_get_clean() ?>

<?php require_once "_deliveries-layout.php" ?>