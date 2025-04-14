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
            <div class="col-sm-2"><i class="fas fa-home"></i></div>
            <div class="col"><span>Dashboard</span></div>
        </div>
    </a>
    <a href="<?php echo $ms->url('city_health/uploadAvailableMed.php') ?>" name="nav-link" <?php echo $ms->url() === $ms->url('city_health/uploadAvailableMed.php') ? "class='sidenav-active'" : "" ?>>
        <div class="row align-items-center">
            <div class="col-sm-2"><i class="fas fa-upload me-2"></i></div>
            <div class="col"><span>Upload Medicine</span></div>
        </div>
    </a>
    <a href="<?php echo $ms->url('city_health/view_med.php') ?>" name="nav-link" <?php echo $ms->url() === $ms->url('city_health/view_med.php') || $ms->url() === $ms->url('city_health/uploadMedEdit.php') ? "class='sidenav-active'" : "" ?>>
        <div class="row align-items-center">
            <div class="col-sm-2"><i class="fas fa-pills me-2"></i></div>
            <div class="col"><span>Available Medicine</span></div>
        </div>
    </a>
    <a href="<?php echo $ms->url('city_health/request_med.php') ?>" name="nav-link" <?php echo $ms->url() === $ms->url('city_health/request_med.php') || $ms->url() === $ms->url('city_health/select_date_req.php') ? "class='sidenav-active'" : "" ?>>
        <div class="row align-items-center">
            <div class="col-sm-2"><i class="fas fa-prescription-bottle me-2"></i></div>
            <div class="col"><span>Brgy Medicine Request</span></div>
        </div>
    </a>
    <a href="<?php echo $ms->url('city_health/updateProfile.php') ?>" name="nav-link" <?php echo $ms->url() === $ms->url('city_health/updateProfile.php') || $ms->url() === $ms->url('city_health/changePassword.php') ? "class='sidenav-active'" : "" ?>>
        <div class="row align-items-center">
            <div class="col-sm-2"><i class="fas fa-gear"></i></div>
            <div class="col"><span>Settings</span></div>
        </div>
    </a>
    <a href="../page/rate-and-feedback.php" target="_blank" name="nav-link">
        <div class="row align-items-center">
            <div class="col-sm-2"><i class="fas fa-pen-to-square"></i></div>
            <div class="col"><span>Rate and Feedback</span></div>
        </div>
    </a>

    <a href="#" name="nav-link" id="admin_logout">
        <div class="row align-items-center">
            <div class="col-sm-2"><i class="fas fa-right-from-bracket"></i></div>
            <div class="col"><span>Logout</span></div>
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
<script src="../assets/js/city.health.all.js"></script>
<?php echo $city_health_scripts ?? "" ?>
<?php $scripts = ob_get_clean() ?>

<?php require_once "../shared/layout.php" ?>