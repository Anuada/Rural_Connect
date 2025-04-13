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
            <th>Date of Supply</th>
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
                    <td><button class="btn btn-primary view-details" data-details='<?php echo json_encode($req) ?>'><i
                                class="fas fa-eye"></i><span style="margin-left:10px">View</span></button></td>
                    <td>
                        <?php echo $req['date_of_supply'] != null ? date('F d, Y', strtotime($req['date_of_supply'])) : "" ?>
                    </td>
                    <td>
                        <span class="d-flex justify-content-start">
                            <?php if ($req['requestStatus'] == "Pending"): ?>
                                <button class="btn btn-success" style="margin-right: 10px;" title="Accept" data-bs-toggle="modal"
                                    data-bs-target="#acceptModal<?php echo $req['id']; ?>"><i class="fas fa-check"></i></button>
                                <button class="btn btn-danger" title="Cancel" data-bs-toggle="modal"
                                    data-bs-target="#cancelModal<?php echo $req['id']; ?>"><i class="fas fa-times"></i></button>
                            <?php elseif ($req['requestStatus'] == "Accepted"): ?>
                                <i class="text-success user-select-none"><?php echo $req['requestStatus'] ?></i>
                            <?php else: ?>
                                <i class="text-danger user-select-none"><?php echo $req['requestStatus'] ?></i>
                            <?php endif; ?>
                        </span>
                    </td>
                </tr>

                <!-- Accept Modal -->
                <div class="modal fade" id="acceptModal<?php echo $req['id']; ?>" tabindex="-1" aria-labelledby="acceptLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="acceptLabel">Accept Request</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to accept this request?
                            </div>
                            <div class="modal-footer">
                                <form action="../logic/request_med.php" method="POST">
                                    <input type="hidden" name="requestId" value="<?php echo $req['id']; ?>">
                                    <button type="submit" name="acceptRequest" class="btn btn-success">Yes, Accept</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cancel Modal -->
                <div class="modal fade" id="cancelModal<?php echo $req['id']; ?>" tabindex="-1" aria-labelledby="cancelLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="cancelLabel">Cancel Request</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to cancel this request?
                            </div>
                            <div class="modal-footer">
                                <form action="../logic/request_med.php" method="POST">
                                    <input type="hidden" name="requestId" value="<?php echo $req['id']; ?>">
                                    <button type="submit" name="cancelledRequest" class="btn btn-danger">Yes, Cancel</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        <?php else: ?>
            <td colspan="9" class="text-center" style="height: 100px;">No Request Available</td>
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
<script>
    const detailModalEl = document.getElementById('detailModal');
    const detailModal = new bootstrap.Modal(detailModalEl);
    const viewDetailsBtnEl = document.querySelectorAll('.view-details');
    viewDetailsBtnEl.forEach(btn => {
        btn.addEventListener('click', () => {
            const data = JSON.parse(btn.getAttribute('data-details'));
            document.getElementById('requested_medicine').textContent = data.med_name;
            document.getElementById('requested_quantity').textContent = data.request_quantity;
            document.getElementById('incharge_barangay').textContent = data.barangay;
            document.getElementById('incharge_name').textContent = `${data.fname} ${data.lname}`;
            document.getElementById('incharge_address').textContent = data.address;
            document.getElementById('incharge_contact_number').textContent = data.contactNo;
            document.getElementById('modalImage').src = data.document;
            detailModal.show();
        });
    });

    const previewOverlay = document.getElementById('previewOverlay');
    const previewImage = document.getElementById('previewImage');
    const clickableImage = document.getElementById('modalImage');

    clickableImage.addEventListener('click', () => {
        previewImage.src = clickableImage.src;
        previewOverlay.classList.remove('hidden');
    });

    // Close preview when clicking outside the image
    previewOverlay.addEventListener('click', (e) => {
        if (e.target === previewOverlay) {
            previewOverlay.classList.add('hidden');
            previewImage.src = '';
        }
    });

</script>
<script src="../assets/js/searc_req_cityhealth.js"></script>
<script src="../assets/js/pagenion_med_req.js"></script>
<?php $city_health_scripts = ob_get_clean() ?>

<?php require_once "_city-health-layout.php" ?>