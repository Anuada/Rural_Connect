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

<!-- Confirm Medicine Claimed and Delivery Feedback -->
<div class="modal fade" id="claimConfirmAndDeliveryFeedbackModal" tabindex="-1" aria-labelledby="viewLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom-modal">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewLabel">
                    <i class="fas fa-capsules"></i> Delivery Feedback
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="confirm-claim">
                    <input type="hidden" name="delivery_id" id="delivery_id">
                    <input type="hidden" name="request_type" id="request_type">
                    <div class="form-fields">
                        <div class="mb-3">
                            <label for="delivery_condition">Delivery Condition</label>
                            <select class="form-control" name="delivery_condition" id="delivery_condition"></select>
                        </div>
                        <div class="mb-3">
                            <label for="feedback">Feedback</label>
                            <textarea class="form-control" name="feedback" id="feedback"
                                placeholder="(Optional) Give feedback to the delivery"></textarea>
                        </div>
                        <button type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Pending Claim  -->
<div class="modal fade" id="pendingClaimModal" tabindex="-1" aria-labelledby="pendingClaimModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom-modal">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="pendingClaimModalLabel">
                    <i class="fas fa-capsules"></i> Partially Claimed
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="partially-claimed-form">
                    <input type="hidden" name="delivery_id_pc" id="delivery_id_pc">
                    <input type="hidden" name="request_type_pc" id="request_type_pc">
                    <div class="form-fields">
                        <div class="mb-3">
                            <input type="number" name="total_partially_claimed" id="total_partially_claimed"
                                class="form-control" min="1" placeholder="Input the total amount of partially claimed items" required>
                        </div>
                        <button type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $barangay_inc_content = ob_get_clean() ?>

<?php ob_start() ?>
<script type="module" src="../assets/js/barangay_inc/my.requests.js"></script>
<?php $barangay_inc_scripts = ob_get_clean() ?>

<?php require_once "_barangay-inc-layout.php" ?>