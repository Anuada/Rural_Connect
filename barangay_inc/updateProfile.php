<?php
session_start();
require_once "../util/DbHelper.php";
require_once "../shared/session.barangay_inc.php";

$db = new DbHelper();
$title = "Update Profile - City Health";

// Ensure accountId exists in the session
if (!isset($_SESSION['accountId'])) {
    header("Location: ../login.php");
    exit();
}

$accountId = $_GET['accountId'] ?? $_SESSION['accountId'];
$user = $db->getRecord("barangay_inc", ["accountId" => $_SESSION['accountId']]);

ob_start();
include "../shared/navbar_barangay_inc.php";
$navbar = ob_get_clean();
?>

<?php ob_start(); ?>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/profile_update.css">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<br>
<br>
<br>
<br>
<div class="container mt-5">
    <div class="card p-4 shadow-lg rounded">
        <h2 class="text-center">Update Profile</h2>
        <button class="btn btn-info w-100 mb-3" data-bs-toggle="modal" data-bs-target="#profileModal">View ID </button>
        <form action="../logic/updateProfileBarangay.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="accountId" value="<?= htmlspecialchars($user['accountId']) ?>">
            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input type="text" name="fname" class="form-control" value="<?= $user['fname'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" name="lname" class="form-control" value="<?= $user['lname'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" value="<?= $user['address'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contact Number</label>
                <input type="text" name="contactNo" class="form-control" value="<?= $user['contactNo'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">ID:</label>
                <input type="file" name="id_verification" class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100">Update Profile</button>
        </form>
    </div>
</div>

<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Centered & larger modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">ID Verification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
            <img src="<?php echo !empty($user['id_verification']) ? "../uploads/" . htmlspecialchars($user['id_verification']) : "../assets/img/no-image.png"; ?>" 
                     class="img-fluid rounded shadow-lg" 
                     style="max-width: 100%; height: auto;">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var myModal = new bootstrap.Modal(document.getElementById('profileModal'));
    });
</script>
<?php $scripts = ob_get_clean(); ?>

<?php require_once "../shared/layout.php"; ?>
