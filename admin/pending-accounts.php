<?php
session_start();
require_once "../shared/session.admin.php";
require_once "./is.admin.authenticated.php";
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/admin.pending.account.css">
<?php $admin_styles = ob_get_clean()?>

<?php ob_start() ?>
<div class="container">
    <h3>Pending Accounts</h3>

    <!-- Tabs -->
    <ul class="nav nav-tabs pt-3" id="pendingTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="barangay-inc-tab" style="width: 25vw" data-bs-toggle="tab"
                data-bs-target="#barangay-inc" type="button" role="tab">Barangay Incharge</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="city-health-tab" style="width: 25vw" data-bs-toggle="tab"
                data-bs-target="#city-health" type="button" role="tab">City Health</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="deliveries-tab" style="width: 25vw" data-bs-toggle="tab"
                data-bs-target="#deliveries" type="button" role="tab">Deliveries</button>
        </li>
    </ul>

    <!-- Tab Contents -->
    <div class="tab-content mt-3" id="pendingTabsContent">
        <div class="tab-pane fade show active" id="barangay-inc" role="tabpanel">
            <table>
                <thead>
                    <tr>
                        <th>Account</th>
                        <th>Barangay</th>
                        <th>ID Card</th>
                        <th>Date Joined</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="barangay-inc-table-data"></tbody>
            </table>
            <div id="barangay-inc-pagination" class="pagination mt-3 d-flex justify-content-end"></div>
        </div>
        <div class="tab-pane fade" id="city-health" role="tabpanel">
            <table>
                <thead>
                    <tr>
                        <th>Account</th>
                        <th>ID Card</th>
                        <th>Date Joined</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="city-health-table-data"></tbody>
            </table>
            <div id="city-health-pagination" class="pagination mt-3 d-flex justify-content-end"></div>
        </div>
        <div class="tab-pane fade" id="deliveries" role="tabpanel">
            <table>
                <thead>
                    <tr>
                        <th>Account</th>
                        <th>ID Card</th>
                        <th>Date Joined</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="deliveries-table-data"></tbody>
            </table>
            <div id="deliveries-pagination" class="pagination mt-3 d-flex justify-content-end"></div>
        </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Identification Card</h5>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Modal Image" class="img-fluid" width="300">
                </div>
            </div>
        </div>
    </div>
</div>
<?php $admin_content = ob_get_clean() ?>


<?php ob_start() ?>
<script type="module" src="../assets/js/admin/pending.account.js"></script>
<?php $admin_scripts = ob_get_clean() ?>

<?php require_once "_admin-layout.php" ?>