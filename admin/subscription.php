<?php
session_start();
require_once "../shared/session.admin.php";
require_once "./is.admin.authenticated.php";
require_once "../util/Misc.php";
$admin_title = Misc::displayPageTitle("Subscriptions", "fa-clipboard-list");
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/admin.subscription.css">
<?php $admin_styles = ob_get_clean() ?>

<?php ob_start() ?>
<table>
    <thead>
        <tr class="justify-content-center">
            <th>Barangay</th>
            <th>Incharge</th>
            <th>Plan</th>
            <th>GCash Receipt</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="table-data"></tbody>
</table>
<div id="pagination" class="pagination mt-3 d-flex justify-content-end"></div>


<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Receipt</h5>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Modal Image" class="img-fluid" width="300">
            </div>
        </div>
    </div>
</div>


<!-- Cancel Status Modal -->
<div class="modal fade" id="cancelStatusModal" tabindex="-1" aria-labelledby="cancelStatusModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelStatusModalLabel">Add Note for Subscription Cancellation</h5>
            </div>
            <div class="modal-body">
                <form id="cancel-subscription">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="approve_status" id="approve_status">
                    <div class="mb-3">
                        <textarea class="form-control" name="cancel_note" id="cancel_note" rows="5" required></textarea>
                        <div class="text-danger" style="height:15px" id="noteError"></div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $admin_content = ob_get_clean() ?>


<?php ob_start() ?>
<script type="module" src="../assets/js/admin/subscriptions.js"></script>
<?php $admin_scripts = ob_get_clean() ?>

<?php require_once "_admin-layout.php" ?>