<?php
session_start();
require_once "../shared/session.barangay_inc.php";
require_once "../util/Misc.php";
$barangay_inc_title = Misc::displayPageTitle("My Requests", "fa-file-medical");
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/barangay.inc.my.requests.css">
<?php $barangay_inc_styles = ob_get_clean() ?>

<?php ob_start() ?>
<!-- Tabs -->
<ul class="nav nav-tabs pt-3 w-100" id="pendingTabs" role="tablist" style="display: flex;">
    <li class="nav-item flex-fill text-center" role="presentation">
        <button class="nav-link active w-100" id="requested-med-tab" data-bs-toggle="tab"
            data-bs-target="#requested-med" type="button" role="tab">Standard Request</button>
    </li>
    <li class="nav-item flex-fill text-center" role="presentation">
        <button class="nav-link w-100" id="customized-med-request-tab" data-bs-toggle="tab"
            data-bs-target="#customized-med-request" type="button" role="tab">Customized Request</button>
    </li>
</ul>

<!-- Tab Contents -->
<div class="tab-content mt-3" id="pendingTabsContent">
    <div class="tab-pane fade show active" id="requested-med" role="tabpanel">
        <table>
            <thead>
                <tr>
                    <th>Medicine</th>
                    <th>Quantity</th>
                    <th>Document</th>
                    <th>Scheduled Delivery</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="requested-med-table-data"></tbody>
        </table>
        <div id="requested-med-pagination" class="pagination mt-3 d-flex justify-content-end"></div>
    </div>

    <div class="tab-pane fade show" id="customized-med-request" role="tabpanel">
        <table>
            <thead>
                <tr>
                    <th>Medicine</th>
                    <th>Quantity</th>
                    <th>Document</th>
                    <th>Scheduled Delivery</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="customized-med-request-table-data"></tbody>
        </table>
        <div id="customized-med-request-pagination" class="pagination mt-3 d-flex justify-content-end"></div>
    </div>
</div>

<!-- Image Preview Overlay -->
<div id="previewOverlay" class="hidden">
    <div class="previewContent">
        <img id="previewImage" src="" alt="Image Preview" class="image-fluid" />
    </div>
</div>
<?php $barangay_inc_content = ob_get_clean() ?>

<?php ob_start() ?>
<script type="module" src="../assets/js/barangay_inc/my.requests.js"></script>
<?php $barangay_inc_scripts = ob_get_clean() ?>

<?php require_once "_barangay-inc-layout.php" ?>