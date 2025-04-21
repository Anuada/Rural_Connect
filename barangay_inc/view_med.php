<?php
session_start();
require_once "../shared/session.barangay_inc.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";
$barangay_inc_title = Misc::displayPageTitle("Get Medicine", "fa-notes-medical");

$db = new DbHelper();
$tableName = "med_availability";
$records = $db->fetchRecords($tableName);
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/viewAvail_med.css">
<?php $barangay_inc_styles = ob_get_clean() ?>

<?php ob_start() ?>
<div class="row">
    <?php if (!empty($records) && is_array($records)): ?>
        <?php foreach ($records as $row): ?>
            <div class="col-md-4 mb-4">
                <div class="card product-card shadow-sm">
                    <img src="<?php echo !empty($row['med_image']) ? "../uploads/" . htmlspecialchars($row['med_image']) : "../assets/img/no-image.png"; ?>"
                        alt="Medicine Image" class="product-img">
                    <div class="product-info">
                        <h5 class="product-title rc-blue-text"><i class="fas fa-pills me-2"></i><?php echo htmlspecialchars($row['med_name']); ?></h5>
                            <a href="request_med.php?id=<?= htmlspecialchars($row['id']) ?>"
                                class="btn rc-blue-bg mt-4 w-100"><i class="fas fa-notes-medical"></i> Request</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12 text-center">
            <p>No medicine records found.</p>
        </div>
    <?php endif; ?>
</div>
<?php $barangay_inc_content = ob_get_clean() ?>


<?php ob_start() ?>
<!-- javascripts/scripts here -->
<?php $barangay_inc_scripts = ob_get_clean() ?>

<?php require_once "_barangay-inc-layout.php" ?>