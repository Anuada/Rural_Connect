<?php
session_start();
require_once "../util/DbHelper.php";
require_once "../shared/session.city_health.php";

$dbHelper = new DbHelper();
$title = "Medicine Availability";

$tableName = "med_availabilty"; 
$records = $dbHelper->fetchRecords($tableName);

// Capture navbar content
ob_start();
include "../shared/navbar_city_health.php";
$navbar = ob_get_clean();
?>

<?php ob_start(); ?>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="container mt-4">
    <h2 class="text-center">Medicine Availability</h2>
    <table style="margin-top:10%;" class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Medicine Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Dosage Form</th>
                <th>Dosage Strength</th>
                <th>Quantity</th>
                <th>Date Added</th>
                <th>Expiry Date</th>
                <th>Actions</th> <!-- New Column for Actions -->
            </tr>
        </thead>
        <tbody>
            <?php if (is_array($records) && !empty($records)) : ?>
                <?php foreach ($records as $row) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['med_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['med_description']); ?></td>
                        <td><?php echo htmlspecialchars($row['category']); ?></td>
                        <td><?php echo htmlspecialchars($row['DosageForm']); ?></td>
                        <td><?php echo htmlspecialchars($row['DosageStrength']); ?></td>
                        <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($row['date']); ?></td>
                        <td><?php echo htmlspecialchars($row['expiry_date']); ?></td>
                        <td>
                            <a href="uploadMedEdit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <button onclick="confirmDelete(<?php echo $row['id']; ?>)" class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="8" class="text-center">No records found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<script src="../assets/js/navbar.js"></script>
<script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this record?")) {
            window.location.href = "../logic/delete_avail_med.php?id=" + id;
        }
    }
</script>
<?php $scripts = ob_get_clean(); ?>

<?php require_once "../shared/layout.php"; ?>
