<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../util/Misc.php";

$ms = new Misc;

$city_health_title = Misc::displayPageTitle("Manage Requests", "fa-file-medical");
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/city_health_css_req_med.css">
<?php $city_health_styles = ob_get_clean() ?>

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
                    <th>Requested Medicine</th>
                    <th>Barangay</th>
                    <th>Other Details</th>
                    <th>Scheduled Delivery</th>
                    <th>Action</th>
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
                    <th>Requested Medicine</th>
                    <th>Barangay</th>
                    <th>Other Details</th>
                    <th>Scheduled Delivery</th>
                    <th>Action</th>
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

<!-- Details Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="viewLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom-modal">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewLabel">
                    <i class="fas fa-capsules"></i> Barangay Incharge Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="medicine-card">
                    <h4 class="text-primary"><i class="fas fa-user"></i> <span id="incharge_name"></span>
                    </h4>
                    <p><i class="fas fa-file-alt"></i> <strong>Requested Medicine:</strong>
                        <span id="requested_medicine"></span>
                    </p>
                    <p><i class="fas fa-file-alt"></i> <strong>Requested Quantity:</strong>
                        <span id="requested_quantity"></span>
                    </p>
                    <p><i class="fas fa-file-alt"></i> <strong>Barangay:</strong>
                        <span id="incharge_barangay"></span>
                    </p>
                    <p><i class="fas fa-file-alt"></i> <strong>Address:</strong>
                        <span id="incharge_address"></span>
                    </p>
                    <p><i class="fas fa-file-alt"></i> <strong>Contact Number:</strong>
                        <span id="incharge_contact_number"></span>
                    </p>
                </div>
                <div class="medicine-card mt-3">
                    <h4><i class="fas fa-folder"></i> Document</h4>
                    <p class="text-center">
                        <img id="modalImage" src="" alt="Modal Image" class="img-fluid clickable-image" width="300">
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Select Courier and Delivery Date -->
<div class="modal fade" id="selectCourierAndDeliveryDateModal" tabindex="-1" aria-labelledby="viewLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom-modal">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewLabel">
                    <i class="fas fa-capsules"></i> Select Courier and Date of Delivery
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="accept-barangay-request">
                    <input type="hidden" name="request_type" id="request-type">
                    <input type="hidden" name="status" id="status">
                    <input type="hidden" name="barangay_request_id" id="barangay_request_id">
                    <div class="form-fields">
                        <div class="mb-3">
                            <label for="delivery_id">Select Courier</label>
                            <select class="form-control" name="delivery_id" id="delivery_id" required></select>
                        </div>

                        <div class="mb-3">
                            <label for="date_of_supply">Select Supply Date</label>
                            <input type="date" name="date_of_supply" id="date_of_supply" required>
                        </div>
                        <button type="submit">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delivery Feedback Modal -->
<div class="modal fade" id="deliveryFeedbackModal" tabindex="-1" aria-labelledby="viewLabel" aria-hidden="true">
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
                <div class="medicine-card">
                    <div class="mb-3">
                        <strong>Received By:</strong>
                        <span id="receivedBy"></span>
                    </div>
                    <div class="mb-3">
                        <strong>Delivery Condition:</strong>
                        <span id="deliveryCondition"></span>
                    </div>
                    <div class="mb-3">
                        <strong>Feedback:</strong>
                        <span id="feedbackText"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reschedule Delivery -->
<div class="modal fade" id="rescheduleDeliveryModal" tabindex="-1" aria-labelledby="viewLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom-modal">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewLabel">
                    <i class="fas fa-capsules"></i> Reschedule Delivery
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="reschedule-delivery-form">
                    <input type="hidden" name="data-request-type" id="data-request-type">
                    <input type="hidden" name="data-delivery-id" id="data-delivery-id">
                    <div class="form-fields">
                        <div class="mb-3">
                            <label for="reschedule-delivery">Reschedule Delivery</label>
                            <input type="date" name="reschedule-delivery" id="reschedule-delivery" required>
                        </div>
                        <button type="submit">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $city_health_content = ob_get_clean() ?>

<?php ob_start() ?>
<script type="module" src="../assets/js/city_health/brgy.med.req.js"></script>
<?php $city_health_scripts = ob_get_clean() ?>

<?php require_once "_city-health-layout.php" ?>