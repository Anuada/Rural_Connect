<?php
session_start();
require_once "../shared/session.barangay_inc.php";
require_once "../util/Misc.php";
$barangay_inc_title = Misc::displayPageTitle("Dashboard", "fa-home");
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/dashboard.all.css">
<?php $barangay_inc_styles = ob_get_clean() ?>

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

<div class="row">
    <div class="col">
        <div class="chart-box">
            <h4 class="text-center text-secondary">Request Status Overview</h4>
            <canvas id="request-chart"></canvas>
        </div>
    </div>
</div>
<?php $barangay_inc_content = ob_get_clean() ?>

<?php ob_start() ?>
<script type="module" src="../assets/js/barangay_inc/dashboard.js"></script>
<?php $barangay_inc_scripts = ob_get_clean() ?>

<?php require_once "_barangay-inc-layout.php" ?>