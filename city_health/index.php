<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../util/Misc.php";

$city_health_title = Misc::displayPageTitle("Dashboard", "fa-home");
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/dashboard.all.css">
<?php $city_health_styles = ob_get_clean() ?>

<?php ob_start() ?>
<div class="kpi-container">
    <div class="kpi-card">
        <h5 id="total-pending-label">Pending Request</h5>
        <p id="total-pending">0</p>
    </div>
    <div class="kpi-card">
        <h5 id="total-accepted-label">Accepted Request</h5>
        <p id="total-accepted">0</p>
    </div>
    <div class="kpi-card">
        <h5 id="total-cancelled-label">Cancelled Request</h5>
        <p id="total-cancelled">0</p>
    </div>
</div>

<div class="row" style="margin-bottom: 20px">
    <div class="col">
        <div class="chart-box">
            <h4 class="text-center text-secondary">Request Status Overview</h4>
            <canvas id="request-chart"></canvas>
        </div>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th colspan="2" class="text-center">Added Items This Month</th>
        </tr>
        <tr>
            <td class="fw-bold">Item</td>
            <td class="fw-bold">Date Added</td>
        </tr>
    </thead>
    <tbody id="new-added-items-this-month"></tbody>
</table>

<?php $city_health_content = ob_get_clean() ?>

<?php ob_start() ?>
<script type="module" src="../assets/js/city_health/dashboard.js"></script>
<?php $city_health_scripts = ob_get_clean() ?>

<?php require_once "_city-health-layout.php" ?>