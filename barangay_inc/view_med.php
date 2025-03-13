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
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Medicine Availability</h2>
    
    <div class="row">
        <?php if (!empty($records) && is_array($records)) : ?>
            <?php foreach ($records as $row) : ?>
                <div class="col-md-4 mb-4">
    <div class="card shadow-sm" style="margin-top: 30%;">
        <div class="card-body text-center">
            <div class="mb-3">
                <?php if (!empty($row['med_image'])) : ?>
                    <img src="../uploads/<?php echo htmlspecialchars($row['med_image']); ?>" alt="Medicine Image" class="img-fluid rounded" style="max-height: 150px;">
                <?php else : ?>
                    <img src="../assets/img/no-image.png" alt="No Image" class="img-fluid rounded" style="max-height: 150px;">
                <?php endif; ?>
            </div>
            <h5 class="card-title"><?php echo htmlspecialchars($row['med_name'] ?? ''); ?></h5>
            <p class="card-text"><strong>Description:</strong> <?php echo htmlspecialchars($row['med_description'] ?? ''); ?></p>
            <p class="card-text"><strong>Quantity:</strong> <?php echo htmlspecialchars($row['quantity'] ?? ''); ?></p>
            <p class="card-text"><strong>Date Added:</strong> <?php echo htmlspecialchars($row['date'] ?? ''); ?></p>
            <p class="card-text"><strong>Expiry Date:</strong> <?php echo htmlspecialchars($row['expiry_date'] ?? ''); ?></p>
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
<?php $scripts = ob_get_clean(); ?>
<?php require_once "../shared/layout.php"; ?>
