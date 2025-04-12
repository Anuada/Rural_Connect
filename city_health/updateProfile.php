<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../util/DbHelper.php";

$db = new DbHelper();

$accountId = $_SESSION['accountId'];
$user = $db->getRecord("city_health", ["accountId" => $accountId]);

$city_health_title = "Settings";
?>

<?php ob_start() ?>
<div class="card p-4 shadow-lg rounded">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="text-center mb-0">Update Profile</h3>
        <a href="changePassword.php" class="btn btn-secondary">Change Password <i style="margin-left: 10px"
                class="fa fa-arrow-right" aria-hidden="true"></i>
        </a>
    </div>
    <button class="btn btn-info w-100 mb-3" data-bs-toggle="modal" data-bs-target="#profileModal">View ID</button>
    <form action="../logic/updateProfileCityHealth.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="accountId" value="<?= htmlspecialchars($user['accountId']) ?>">
        <div class="mb-3">
            <label for="fname" class="form-label">First Name</label>
            <input type="text" id="fname" name="fname" class="form-control" value="<?= $user['fname'] ?>" required>
            <div style="height: 15px" class="text-danger" id="fnameError"></div>
        </div>
        <div class="mb-3">
            <label for="lname" class="form-label">Last Name</label>
            <input type="text" id="lname" name="lname" class="form-control" value="<?= $user['lname'] ?>" required>
            <div style="height: 15px" class="text-danger" id="lnameError"></div>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" id="address" name="address" class="form-control" value="<?= $user['address'] ?>"
                required>
            <div style="height: 15px" class="text-danger" id="addressError"></div>
        </div>
        <div class="mb-3">
            <label for="contactNo" class="form-label">Contact Number</label>
            <input type="text" id="contactNo" name="contactNo" class="form-control" value="<?= $user['contactNo'] ?>"
                required>
            <div style="height: 15px" class="text-danger" id="contactNoError"></div>
        </div>
        <div class="mb-3">
            <label for="id_verification" class="form-label">ID:</label>
            <input type="file" id="id_verification" name="id_verification" class="form-control">
        </div>
        <button type="submit" name="submit" class="btn btn-primary w-100">Update Profile</button>
    </form>
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
                <img src="<?php echo !empty($user['id_verification']) ? htmlspecialchars($user['id_verification']) : "../assets/img/no-image.png"; ?>"
                    class="img-fluid rounded shadow-lg" style="max-width: 100%; height: auto;">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $city_health_content = ob_get_clean() ?>


<?php ob_start() ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var myModal = new bootstrap.Modal(document.getElementById('profileModal'));
    });
</script>

<?php if (isset($_SESSION["errorMessages"])): ?>
    <script>
        const errorMessages = <?php echo json_encode($_SESSION["errorMessages"]) ?>;
        document.getElementById("fnameError").innerHTML = errorMessages.fname != null ? errorMessages.fname : "";
        document.getElementById("lnameError").innerHTML = errorMessages.lname != null ? errorMessages.lname : "";
        document.getElementById("addressError").innerHTML = errorMessages.address != null ? errorMessages.address : "";
        document.getElementById("contactNoError").innerHTML = errorMessages.contactNo != null ? errorMessages.contactNo : "";
    </script>
    <?php unset($_SESSION["errorMessages"]) ?>
<?php endif ?>
<?php $city_health_scripts = ob_get_clean() ?>

<?php require_once "_city-health-layout.php" ?>