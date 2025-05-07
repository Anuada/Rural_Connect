<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;
$records = $db->fetchRecords('med_availability');
$city_health_title = Misc::displayPageTitle("Manage Inventory", "fa-pills me-2");
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/city.health.view.med.css">
<?php $city_health_styles = ob_get_clean() ?>

<?php ob_start() ?>
<input type="text" id="searchInput" class="form-control mb-3" placeholder="Search" onkeyup="searchTable()">
<table id="medicineTable">
    <thead>
        <tr>
            <th>Medicine</th>
            <th>Other Details</th>
            <th>Date Added</th>
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
                                <img src="<?php echo $row['item_image'] ?>" alt="Medicine Image"
                                    class="img-fluid rounded shadow" style="width: 100px; height: 100px; object-fit: cover;">
                            </span>
                            <span class="col">
                                <span class="row"><?php echo $row['generic_name'] ?></span>
                                <span class="row text-secondary"><?php echo $row['brand_name'] ?></span>
                                <span class="row text-secondary">
                                    <?php echo $ms->truncateSentence($row['category'], 35) ?>
                                </span>
                                <span class="row text-secondary"><?php echo $row['dosage_strength'] ?></span>
                            </span>
                        </span>
                    </td>
                    <td><button class="btn btn-primary shadow other-details" data-details='<?php echo json_encode($row) ?>'><i
                                class="fas fa-eye"></i><span style="margin-left:10px">View</span></button></td>
                    <td><?php echo date('F d, Y', strtotime($row['date'])) ?></td>
                    <td>
                        <span class="d-flex justify-content-start">
                            <button data-id="<?php echo $row['id'] ?>" data-med-name="<?php echo $row['generic_name'] ?>"
                                data-quantity="<?php echo $row['quantity'] ?>" title="Edit"
                                class="btn btn-primary shadow edit-medicine" style="margin-right: 10px">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button data-id="<?php echo $row['id'] ?>" title="Delete"
                                class="btn btn-outline-primary shadow delete-medicine">
                                <i class="fas fa-trash"></i>
                            </button>
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center"><i class="user-select-none text-secondary">No records found</i></td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Pagination Controls -->
<div class="pagination-container mt-3 d-flex justify-content-end <?php echo count($records) < 4 ? "d-none" : "" ?>">
    <button id="prevPage" class="btn btn-primary shadow" disabled>Prev</button>
    <span id="pageNumbers" class="mx-2 d-flex justify-content-center align-items-center"></span>
    <button id="nextPage" class="btn btn-primary shadow">Next</button>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom-modal">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewLabel">
                    <i class="fas fa-capsules"></i> Medicine Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="medicine-card">
                    <h4 class="text-primary"><i class="fas fa-pills me-2"></i> <span id="generic_name"></span>
                    </h4>
                    <p><i class="fas fa-file-alt"></i> <strong>Quantity:</strong>
                        <span id="quantity"></span>
                    </p>
                    <p id="expiration_date_el"></p>
                    <p><i class="fas fa-file-alt"></i> <strong>Description:</strong>
                        <span id="med_description"></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Stock -->
<div class="modal fade" id="addStockModal" tabindex="-1" aria-labelledby="viewLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom-modal">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewLabel">
                    <i class="fas fa-capsules"></i> Add Stock
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-stock-form">
                    <input type="hidden" name="id" id="id">
                    <div class="form-fields">
                        <div class="form-group row mb-3 d-flex align-items-center">
                            <label for="stock" class="col-sm-4 col-form-label">Add Stock</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" min="1" id="stock" name="stock"
                                    placeholder="Added Stock" value="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-3 d-flex align-items-center">
                        <div class="form-fields col-sm-4 col-form-label">
                            <label id="total-stocks-label">Total Stocks</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" readonly class="form-control-plaintext" name="quantity"
                                id="total-quantity">
                        </div>
                    </div>
                    <div class="form-fields">
                        <button type="submit">Add Stock</button>
                    </div>
                </form>
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