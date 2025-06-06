<?php
require_once "../util/Misc.php";
$ms = new Misc;
$title = "Barangay Incharge";
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/barangay.inc.all.css">
<?php echo $barangay_inc_styles ?? "" ?>
<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>
<div class="sidenav">
    <h3>
        <a href="">
            <img src="../assets/img/misc/RuralConnectAltLogo.png" alt="Rural Connect Logo" width="200px">
            <h5>Barangay Incharge</h5>
        </a>
    </h3>
    <a href="<?php echo $ms->url('barangay_inc') ?>" name="nav-link" <?php echo $ms->url() === $ms->url('barangay_inc/') ? "class='sidenav-active'" : "" ?>>
        <div class="row align-items-center">
            <?php echo Misc::displayPageTitle("Dashboard", "fa-home", "15px") ?>
        </div>
    </a>
    <a href="<?php echo $ms->url('barangay_inc/view_med.php') ?>" name="nav-link" <?php echo $ms->url() === $ms->url('barangay_inc/view_med.php') || $ms->url() === $ms->url('barangay_inc/request_med.php') ? "class='sidenav-active'" : "" ?>>
        <div class="row align-items-center">
            <?php echo Misc::displayPageTitle("Request Medicine", "fa-notes-medical", "15px") ?>
        </div>
    </a>
    <a href="<?php echo $ms->url('barangay_inc/custom-med-request.php') ?>" name="nav-link" <?php echo $ms->url() === $ms->url('barangay_inc/custom-med-request.php') ? "class='sidenav-active'" : "" ?>>
        <div class="row align-items-center">
            <?php echo Misc::displayPageTitle("Customize Request", "fa-sliders", "15px") ?>
        </div>
    </a>
    <a href="<?php echo $ms->url('barangay_inc/my-requests.php') ?>" name="nav-link" <?php echo $ms->url() === $ms->url('barangay_inc/my-requests.php') || $ms->url() === $ms->url('barangay_inc/track-delivery-status.php') ? "class='sidenav-active'" : "" ?>>
        <div class="row align-items-center">
            <?php echo Misc::displayPageTitle("My Requests", "fa-file-medical", "15px") ?>
        </div>
    </a>
    <a href="<?php echo $ms->url('barangay_inc/updateProfile.php') ?>" name="nav-link" <?php echo $ms->url() === $ms->url('barangay_inc/updateProfile.php') || $ms->url() === $ms->url('barangay_inc/changePassword.php') ? "class='sidenav-active'" : "" ?>>
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
                    <h3 class="rc-blue-text fw-bold"><?php echo $barangay_inc_title ?? "" ?></h3>
                </span>
            </div>
        </div>
        <div style="margin-top:20px">
            <?php echo $barangay_inc_content ?? "" ?>
        </div>
    </div>
</div>

<?php $content = ob_get_clean() ?>


<?php ob_start() ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="module" src="../assets/js/logout.js"></script>
<?php echo $barangay_inc_scripts ?? "" ?>
<?php $scripts = ob_get_clean() ?>

<?php require_once "../shared/layout.php" ?>