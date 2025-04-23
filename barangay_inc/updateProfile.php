<?php
session_start();
require_once "../shared/session.barangay_inc.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";
$barangay_inc_title = Misc::displayPageTitle("Settings", "fa-gear");

$db = new DbHelper();

$accountId = $_SESSION['accountId'];
$user = $db->getRecord("barangay_inc", ["accountId" => $accountId]);
?>

<?php ob_start() ?>
<div class="card p-4 shadow-lg rounded">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <h3 class="text-center mb-0 rc-blue-text fs-4 fs-md-3">Update Profile</h3>
        <a href="changePassword.php" class="rc-blue-text text-decoration-none fs-6 fs-md-5 d-flex align-items-center">
            <span class="d-none d-sm-inline">Change Password</span>
            <i class="fa fa-arrow-right ms-2" aria-hidden="true"></i>
        </a>
    </div>
    <form action="../logic/updateProfileBarangay.php" method="POST" enctype="multipart/form-data">
        <div class="form-fields">
            <input type="hidden" name="accountId" value="<?= htmlspecialchars($user['accountId']) ?>">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="fname">First Name</label>
                    <input type="text" id="fname" class="form-control" name="fname" value="<?= $user['fname'] ?>"
                        required>
                    <div style="height: 15px" class="form-text text-danger" id="fnameError"></div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lname">Last Name</label>
                    <input type="text" id="lname" class="form-control" name="lname" value="<?= $user['lname'] ?>"
                        required>
                    <div style="height: 15px" class="form-text text-danger" id="lnameError"></div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="address">Address</label>
                    <input type="text" id="address" class="form-control" name="address" value="<?= $user['address'] ?>"
                        required>
                    <div style="height: 15px" class="form-text text-danger" id="addressError"></div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="contactNo">Contact Number</label>
                    <input type="text" id="contactNo" class="form-control" name="contactNo"
                        value="<?= $user['contactNo'] ?>" required>
                    <div style="height: 15px" class="form-text text-danger" id="contactNoError"></div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="id_verification">Upload ID</label>
                    <input type="file" id="id_verification" class="form-control" name="id_verification">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Preview ID</label>
                    <button type="button" style="margin: 10px 0" data-bs-toggle="modal"
                        data-bs-target="#profileModal">Preview ID</button>
                </div>
            </div>
            <button type="submit" name="submit">Update Profile</button>
        </div>
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
<?php $barangay_inc_content = ob_get_clean() ?>

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
<?php $barangay_inc_scripts = ob_get_clean() ?>

<?php require_once "_barangay-inc-layout.php" ?>