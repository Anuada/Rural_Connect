<?php
session_start();
require_once "../util/DbHelper.php";
require_once "../shared/session.city_health.php";

$dbHelper = new DbHelper();
$title = "Medicine Availability";

$tableName = "med_availability";
$records = $dbHelper->fetchRecords($tableName);

// Capture navbar content
ob_start();
include "../shared/navbar_city_health.php";
$navbar = ob_get_clean();
?>

<?php ob_start(); ?>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .sidebar {
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        width: 250px;
        background-color: #343a40;
        padding-top: 20px;
        margin-top: 5%;
    }

    .sidebar .nav-link {
        color: white;
        font-size: 16px;
    }

    .sidebar .nav-link:hover {
        background-color: #495057;
        border-radius: 5px;
    }

    .content-wrapper {
        margin-left: 260px;
        padding: 20px;
    }
</style>
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<br>
<div class="container-fluid">

    <div class="row">
        <!-- Sidebar -->

        <nav class="col-md-3 col-lg-2 sidebar">
            <h4 class="text-center text-white">City Health Officer</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="uploadAvailableMed.php"><i class="fas fa-upload me-2"></i> Upload
                        Medicine</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="request_med.php"><i class="fas fa-prescription-bottle me-2"></i> Requested
                        Medicine</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-cogs me-2"></i> Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_med.php"><i class="fas fa-pills me-2"></i> Available Medicine</a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 col-lg-10 content-wrapper" style="margin-top:8%;">
            <h2 class="text-center">Medicine Availability</h2>
            <table class="table table-bordered table-striped mt-4">
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (is_array($records) && !empty($records)): ?>
                        <?php foreach ($records as $row): ?>
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
                                    <a href="uploadMedEdit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button onclick="confirmDelete(<?php echo $row['id']; ?>)" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
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
        </main>
    </div>
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