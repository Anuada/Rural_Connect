<?php
session_start();
require_once "../util/DbHelper.php";
require_once "../shared/session.delivery.php";

$db = new DbHelper();
$title = "Change Password - Deliveries";

// Ensure accountId exists in the session
if (!isset($_SESSION['accountId'])) {
    header("Location: ../login.php");
    exit();
}

ob_start();
include "../shared/navbar.deliveries.php";
$navbar = ob_get_clean();
?>

<?php ob_start(); ?>
<div class="container" style="padding-top: 150px; padding-bottom: 50px">
    <div class="card p-4 shadow-lg rounded">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="updateProfile.php" class="btn btn-secondary"><i style="margin-right: 10px" class="fa fa-arrow-left"
                    aria-hidden="true"></i>Update Profile</a>
            <h3 class="text-center mb-0">Change Password</h3>
        </div>
        <form action="../logic/changePassword.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password</label>
                <input type="password" id="current_password" name="current_password" class="form-control" required>
                <div style="height: 15px" class="text-danger" id="current_passwordError"></div>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" id="new_password" name="new_password" class="form-control" required>
                <div style="height: 15px" class="text-danger" id="new_passwordError"></div>
            </div>
            <div class="mb-3">
                <label for="repeat_password" class="form-label">Repeat Password</label>
                <input type="password" id="repeat_password" name="repeat_password" class="form-control" required>
                <div style="height: 15px" class="text-danger" id="repeat_passwordError"></div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100">Change Password</button>
        </form>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>

<?php if (isset($_SESSION["errorMessages"])): ?>
    <script>
        const errorMessages = <?php echo json_encode($_SESSION["errorMessages"]) ?>;
        document.getElementById("current_passwordError").innerHTML = errorMessages.current_password != null ? errorMessages.current_password : "";
        document.getElementById("new_passwordError").innerHTML = errorMessages.new_password != null ? errorMessages.new_password : "";
        document.getElementById("repeat_passwordError").innerHTML = errorMessages.repeat_password != null ? errorMessages.repeat_password : "";
    </script>
    <?php unset($_SESSION["errorMessages"]) ?>
<?php endif ?>

<?php $scripts = ob_get_clean(); ?>

<?php require_once "../shared/layout.php"; ?>