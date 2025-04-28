<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../util/Misc.php";
$city_health_title = Misc::displayPageTitle("Settings", "fa-gear");
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/change.password.css">
<?php $city_health_styles = ob_get_clean() ?>

<?php ob_start() ?>
<div class="card p-4 shadow-lg rounded">
    <div class="d-flex justify-content-between align-items-center flex-wrap flex-sm-nowrap mb-3">
        <a href="updateProfile.php" class="rc-blue-text text-decoration-none d-flex align-items-center fs-6 fs-md-5">
            <i class="fa fa-arrow-left me-2" aria-hidden="true"></i>
            <span class="d-none d-sm-inline">Update Profile</span>
        </a>
        <h3 class="text-center mb-0 rc-blue-text fs-5 fs-md-4">Change Password</h3>
    </div>
    <form action="../logic/changePassword.php" method="POST">
        <div class="form-fields">
            <div class="mb-3 password-container">
                <label for="current_password">Current Password</label>
                <input type="password" class="passwordEl" id="current_password" name="current_password" required>
                <i class="fas fa-eye" data-action="togglePassword" style="cursor: pointer;"></i>
                <div style="height: 15px" class="text-danger" id="current_passwordError"
                    placeholder="Enter your current password"></div>
            </div>
            <div class="mb-3 password-container">
                <label for="new_password">New Password</label>
                <input type="password" class="passwordEl" id="new_password" name="new_password" required>
                <i class="fas fa-eye" data-action="togglePassword" style="cursor: pointer;"></i>
                <div style="height: 15px" class="text-danger" id="new_passwordError"></div>
            </div>
            <div class="mb-3 password-container">
                <label for="repeat_password">Repeat Password</label>
                <input type="password" class="passwordEl" id="repeat_password" name="repeat_password" required>
                <i class="fas fa-eye" data-action="togglePassword" style="cursor: pointer;"></i>
                <div style="height: 15px" class="text-danger" id="repeat_passwordError"></div>
            </div>
            <button type="submit" name="submit">Change Password</button>
        </div>
    </form>
</div>
<?php $city_health_content = ob_get_clean() ?>


<?php ob_start() ?>
<script src="../assets/js/change.password.js"></script>
<?php if (isset($_SESSION["errorMessages"])): ?>
    <script>
        const errorMessages = <?php echo json_encode($_SESSION["errorMessages"]) ?>;
        document.getElementById("current_passwordError").innerHTML = errorMessages.current_password != null ? errorMessages.current_password : "";
        document.getElementById("new_passwordError").innerHTML = errorMessages.new_password != null ? errorMessages.new_password : "";
        document.getElementById("repeat_passwordError").innerHTML = errorMessages.repeat_password != null ? errorMessages.repeat_password : "";
    </script>
    <?php unset($_SESSION["errorMessages"]) ?>
<?php endif ?>
<?php $city_health_scripts = ob_get_clean() ?>

<?php require_once "_city-health-layout.php" ?>