<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;
$records = $db->fetchRecords('med_availability');
$city_health_title = "Available Medicine";
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/city.health.view.med.css">
<?php $city_health_styles = ob_get_clean() ?>

<?php ob_start() ?>
<input type="text" id="searchInput" class="form-control mb-3"
    placeholder="Search by name, address, or contact number..." onkeyup="searchTable()">
<table id="medicineTable">
    <thead>
        <tr>
            <th>Medicine</th>
            <th>Other Details</th>
            <th>Date Added</th>
            <th>Expiry Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (is_array($records) && !empty($records)): ?>
            <?php foreach ($records as $row): ?>
                <tr>
                    <td>
                        <span class="row">
                            <span class="col-auto">
                                <img src="<?php echo $row['med_image'] ?>" alt="Medicine Image" class="img-fluid rounded shadow"
                                    style="width: 100px; height: 100px; object-fit: cover;">
                            </span>
                            <span class="col">
                                <span class="row"><?php echo $row['med_name'] ?></span>
                                <span class="row text-secondary"><?php echo $row['category'] ?></span>
                                <span
                                    class="row text-secondary"><?php echo $row['DosageForm'] . " - " . $row['DosageStrength'] ?></span>
                            </span>
                        </span>
                    </td>
                    <td><button class="btn btn-primary other-details" data-details='<?php echo json_encode($row) ?>'><i
                                class="fas fa-eye"></i><span style="margin-left:10px">View</span></button></td>
                    <td><?php echo date('F d, Y', strtotime($row['date'])) ?></td>
                    <td><?php echo date('F d, Y', strtotime($row['expiry_date'])) ?></td>
                    <td>
                        <span class="d-flex justify-content-start">
                            <a href="<?php echo $ms->url("city_health/uploadMedEdit.php?id=" . $row['id']) ?>"
                                class="btn btn-warning" title="Edit" style="margin-right: 10px">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button data-id="<?php echo $row['id'] ?>" title="Delete" class="btn btn-danger delete-medicine">
                                <i class="fas fa-trash"></i>
                            </button>
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="9" class="text-center">No records found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Pagination Controls -->
<div class="pagination-container mt-3 d-flex justify-content-end">
    <button id="prevPage" class="btn btn-outline-primary" disabled>Prev</button>
    <span id="pageNumbers" class="mx-2 d-flex justify-content-center align-items-center"></span>
    <button id="nextPage" class="btn btn-outline-primary">Next</button>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom-modal">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewLabel">
                    <i class="bi bi-capsule"></i> Medicine Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="medicine-card">
                    <h4 class="text-primary"><i class="bi bi-prescription2"></i> <span id="med_name"></span>
                    </h4>
                    <p><i class="bi bi-file-text"></i> <strong>Quantity:</strong>
                        <span id="quantity"></span>
                    </p>
                    <p><i class="bi bi-file-text"></i> <strong>Description:</strong>
                        <span id="med_description"></span>
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
<script type="module" src="../assets/js/city_health/available.med.js"></script>
<script src="../assets/js/searc_req_cityhealth.js"></script>
<script src="../assets/js/pagenion_med_req.js"></script>
<?php $city_health_scripts = ob_get_clean() ?>

<?php require_once "_city-health-layout.php" ?>