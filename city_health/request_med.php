<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../util/DbHelper.php";

$db = new DbHelper();

$id = $_SESSION['accountId'];

$requested = $db->Display_barangay_inc_requested($id);
$city_health_title = "Barangay Medicine Request";
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/city_health_css_req_med.css">
<?php $city_health_styles = ob_get_clean() ?>

<?php ob_start() ?>
<input type="text" id="searchInput" class="form-control mb-3"
    placeholder="Search by name, address, or contact number..." onkeyup="searchTable()">
<div class="table-container">
    <table id="medicineTable">
        <tr>
            <th>Requested Medicine</th>
            <th>Barangay</th>
            <th>Other Details</th>
            <th>Scheduled Delivery</th>
            <th>Action</th>
        </tr>
        <?php if (!empty($requested)): ?>
            <?php foreach ($requested as $req): ?>
                <tr>
                    <td>
                        <span class="row">
                            <span class="col-auto">
                                <img src="<?php echo $req['med_image'] ?>" alt="Medicine Image" class="img-fluid rounded shadow"
                                    style="width: 100px; height: 100px; object-fit: cover;">
                            </span>
                            <span class="col">
                                <span class="row"><?php echo $req['med_name'] ?></span>
                                <span class="row text-secondary"><?php echo $req['request_category'] ?></span>
                                <span
                                    class="row text-secondary"><?php echo $req['request_DosageForm'] . " - " . $req['request_DosageStrength'] ?></span>
                            </span>
                        </span>
                    </td>
                    <td><?php echo $req['barangay']; ?></td>
                    <td><button class="btn btn-primary shadow view-details" data-details='<?php echo json_encode($req) ?>'><i
                                class="fas fa-eye"></i><span style="margin-left:10px">View</span></button></td>
                    <td>
                        <?php echo $req['date_of_supply'] != null ? date('F d, Y', strtotime($req['date_of_supply'])) : "<div class='text-center'><span class='user-select-none text-secondary'>TBD</span></div>" ?>
                    </td>
                    <td>
                        <span class="d-flex justify-content-start">
                            <?php if ($req['requestStatus'] == "Pending"): ?>
                                <form class="accept-requests" action="../logic/request_med.php" method="POST">
                                    <input type="hidden" name="acceptRequest">
                                    <input type="hidden" name="requestId" value="<?php echo $req['id']; ?>">
                                    <button type="submit" class="btn btn-success shadow" style="margin-right: 10px;" title="Accept"><i
                                            class="fas fa-check"></i></button>
                                </form>

                                <form class="cancel-requests" action="../logic/request_med.php" method="POST">
                                    <input type="hidden" name="cancelledRequest">
                                    <input type="hidden" name="requestId" value="<?php echo $req['id']; ?>">
                                    <button type="submit" class="btn btn-danger shadow" title="Cancel"><i
                                            class="fas fa-times"></i></button>
                                </form>
                            <?php elseif ($req['requestStatus'] == "Accepted"): ?>
                                <i class="text-success user-select-none"><?php echo $req['requestStatus'] ?></i>
                            <?php else: ?>
                                <i class="text-danger user-select-none"><?php echo $req['requestStatus'] ?></i>
                            <?php endif; ?>
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <td colspan="5" class="text-center" style="height: 100px;">No Request Available</td>
        <?php endif ?>
    </table>
</div>

<!-- Pagination Controls -->
<div class="pagination-container mt-3 d-flex justify-content-end">
    <button id="prevPage" class="btn btn-outline-primary" disabled>Prev</button>
    <span id="pageNumbers" class="mx-2 d-flex justify-content-center align-items-center"></span>
    <button id="nextPage" class="btn btn-outline-primary">Next</button>
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
                    <i class="bi bi-capsule"></i> Barangay Incharge Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="medicine-card">
                    <h4 class="text-primary"><i class="bi bi-prescription2"></i> <span id="incharge_name"></span>
                    </h4>
                    <p><i class="bi bi-file-text"></i> <strong>Requested Medicine:</strong>
                        <span id="requested_medicine"></span>
                    </p>
                    <p><i class="bi bi-file-text"></i> <strong>Requested Quantity:</strong>
                        <span id="requested_quantity"></span>
                    </p>
                    <p><i class="bi bi-file-text"></i> <strong>Barangay:</strong>
                        <span id="incharge_barangay"></span>
                    </p>
                    <p><i class="bi bi-file-text"></i> <strong>Address:</strong>
                        <span id="incharge_address"></span>
                    </p>
                    <p><i class="bi bi-folder"></i> <strong>Contact Number:</strong>
                        <span id="incharge_contact_number"></span>
                    </p>
                </div>
                <div class="medicine-card mt-3">
                    <h4>Document:</h4>
                    <p class="text-center">
                        <img id="modalImage" src="" alt="Modal Image" class="img-fluid clickable-image" width="300">
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                    Close</button>
            </div>
        </div>
    </div>
</div>

<?php $city_health_content = ob_get_clean() ?>

<?php ob_start() ?>
<script type="module" src="../assets/js/city_health/brgy.med.req.js"></script>
<script src="../assets/js/searc_req_cityhealth.js"></script>
<script src="../assets/js/pagenion_med_req.js"></script>
<?php $city_health_scripts = ob_get_clean() ?>

<?php require_once "_city-health-layout.php" ?>