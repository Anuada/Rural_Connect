<?php
session_start();
require_once "../shared/session.admin.php";
require_once "./is.admin.authenticated.php";
require_once "../util/Misc.php";
$admin_title = Misc::displayPageTitle("Dashboard","fa-home");
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/admin.dashboard.css">
<?php $admin_styles = ob_get_clean() ?>

<?php ob_start() ?>
<div class="kpi-container">
    <div class="kpi-card">
        <h5>Total Users</h5>
        <p id="totalUsers">0</p>
    </div>
    <div class="kpi-card">
        <h5>Pending Accounts</h5>
        <p id="pendingAccounts">0</p>
    </div>
    <div class="kpi-card">
        <h5>Total Rating</h5>
        <p id="totalRating">0</p>
    </div>
</div>

<div class="kpi-container">
    <div class="kpi-card">
        <h5>Total Subscribers</h5>
        <p id="totalSubscribers">0</p>
    </div>
    <div class="kpi-card">
        <h5>Pending Subscribers</h5>
        <p id="pendingSubscribers">0</p>
    </div>
    <div class="kpi-card">
        <h5 id="monthlyEarningsLabel">Monthly Earnings</h5>
        <p id="monthlyEarnings">0</p>
    </div>
</div>

<div class="charts">
    <div class="chart-box">
        <h4>Subscribers Breakdown</h4>
        <canvas id="subscribersBreakdownChart"></canvas>
    </div>

    <div class="chart-box">
        <h4>Total Users Breakdown</h4>
        <canvas id="totalUsersBreakdownChart"></canvas>
    </div>
</div>

<div class="charts">
    <div class="chart-box">
        <h4>New Users <span id="thisMonth"></span></h4>
        <canvas id="totalUsersAddedThisMonth"></canvas>
    </div>
</div>
<?php $admin_content = ob_get_clean() ?>

<?php ob_start() ?>
<script type="module" src="../assets/js/admin/dashboard.js"></script>
<?php $admin_scripts = ob_get_clean() ?>

<?php require_once "_admin-layout.php" ?>