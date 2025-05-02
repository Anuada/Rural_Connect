<?php
require_once "../util/Misc.php";
$ms = new Misc;
$title = "City Health";
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/city.health.all.css">
<?php echo $city_health_styles ?? "" ?>
<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>
<div class="sidenav">
    <h3>
        <a href="">
            <img src="../assets/img/misc/RuralConnectAltLogo.png" alt="Rural Connect Logo" width="200px">
            <h4>City Health</h4>
        </a>
    </h3>
    <a href="<?php echo $ms->url('city_health') ?>" name="nav-link" <?php echo $ms->url() === $ms->url('city_health/') ? "class='sidenav-active'" : "" ?>>
        <div class="row align-items-center">
            <?php echo Misc::displayPageTitle("Dashboard", "fa-home", "15px") ?>
        </div>
    </a>
    <a href="<?php echo $ms->url('city_health/add-new-medicine.php') ?>" name="nav-link" <?php echo $ms->url() === $ms->url('city_health/add-new-medicine.php') ? "class='sidenav-active'" : "" ?>>
        <div class="row align-items-center">
            <?php echo Misc::displayPageTitle("New Medicine", "fa-plus-circle", "15px") ?>
        </div>
    </a>
    <a href="<?php echo $ms->url('city_health/medicine-inventory.php') ?>" name="nav-link" <?php echo $ms->url() === $ms->url('city_health/medicine-inventory.php') || $ms->url() === $ms->url('city_health/edit-medicine.php') ? "class='sidenav-active'" : "" ?>>
        <div class="row align-items-center">
            <?php echo Misc::displayPageTitle("Medicine Inventory", "fa-pills", "15px") ?>
        </div>
    </a>
    <a href="<?php echo $ms->url('city_health/barangay-med-requests.php') ?>" name="nav-link" <?php echo $ms->url() === $ms->url('city_health/barangay-med-requests.php') ? "class='sidenav-active'" : "" ?>>
        <div class="row align-items-center">
            <?php echo Misc::displayPageTitle("Medicine Requests", "fa-file-medical", "15px") ?>
        </div>
    </a>
    <a href="<?php echo $ms->url('city_health/updateProfile.php') ?>" name="nav-link" <?php echo $ms->url() === $ms->url('city_health/updateProfile.php') || $ms->url() === $ms->url('city_health/changePassword.php') ? "class='sidenav-active'" : "" ?>>
        <div class="row align-items-center">
            <?php echo Misc::displayPageTitle("Settings", "fa-gear", "15px") ?>
        </div>
    </a>
    <a href="../page/rate-and-feedback.php" target="_blank" name="nav-link">
        <div class="row align-items-center">
            <?php echo Misc::displayPageTitle("Rate and Feedback", "fa-pen-to-square", "15px") ?>
        </div>
    </a>

    <a href="#" name="nav-link" id="admin_logout">
        <div class="row align-items-center">
            <?php echo Misc::displayPageTitle("Logout", "fa-right-from-bracket", "15px") ?>
        </div>
    </a>
</div>

<div class="main-content">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <span class="d-flex justify-content-start align-items-center">
                    <h3 class="rc-blue-text fw-bold"><?php echo $city_health_title ?? "" ?></h3>
                </span>
            </div>
        </div>
        <div style="margin-top:20px">
            <?php echo $city_health_content ?? "" ?>
        </div>
    </div>
</div>

<?php $content = ob_get_clean() ?>


<?php ob_start() ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="module" src="../assets/js/logout.js"></script>
<?php echo $city_health_scripts ?? "" ?>
<?php $scripts = ob_get_clean() ?>

<?php require_once "../shared/layout.php" ?>