<?php
session_start();
require_once "../util/DbHelper.php";
require_once "../shared/session.barangay_inc.php";

$dbHelper = new DbHelper();
$tableName = "med_availabilty"; 
$records = $dbHelper->fetchRecords($tableName);

$title = "View Available Medicine";

ob_start();
include "../shared/navbar_barangay_inc.php";
$navbar = ob_get_clean();
?>

<?php ob_start(); ?>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/viewAvail_med.css">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Available Medicines</h2>
    <div class="row">
        <?php if (!empty($records) && is_array($records)) : ?>
            <?php foreach ($records as $row) : ?>
                <div style="margin-top:10%;" class="col-md-4 mb-4">
                    <div class="card product-card shadow-sm">
                        <img src="<?php echo !empty($row['med_image']) ? "../uploads/" . htmlspecialchars($row['med_image']) : "../assets/img/no-image.png"; ?>" 
                            alt="Medicine Image" class="product-img">
                        <div class="product-info">
                            <h5 class="product-title"><?php echo htmlspecialchars($row['med_name'] ?? ''); ?></h5>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#medModal<?php echo $row['id']; ?>">View Details</button>
<a href="request_med.php?city_health_id=<?= htmlspecialchars($row['city_health_id']) ?>&id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-success btn-sm">Request</a>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="medModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="medModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="medModalLabel<?php echo $row['id']; ?>">Medicine Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="product-description"><strong>Description:</strong> <?php echo htmlspecialchars($row['med_description'] ?? ''); ?></p>
                                <p class="product-description"><strong>Category:</strong> <?php echo htmlspecialchars($row['category'] ?? ''); ?></p>
                                <p class="product-description"><strong>Dosage Form:</strong> <?php echo htmlspecialchars($row['DosageForm'] ?? ''); ?></p>
                                <p class="product-description"><strong>Dosage Strength:</strong> <?php echo htmlspecialchars($row['DosageStrength'] ?? ''); ?></p>



                                <p class="product-quantity"><strong>Quantity:</strong> <?php echo htmlspecialchars($row['quantity'] ?? ''); ?></p>
                                <p class="product-date"><strong>Expiry:</strong> <?php echo !empty($row['expiry_date']) ? date('F d, Y', strtotime($row['expiry_date'])) : 'N/A'; ?></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="col-12 text-center">
                <p>No medicine records found.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<script src="../assets/js/navbar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php $scripts = ob_get_clean(); ?>
<?php require_once "../shared/layout.php"; ?>
