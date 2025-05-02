<?php
require_once "../util/Misc.php";
$ms = new Misc;
$title = "Delivery";
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/deliveries.all.css">
<?php echo $deliveries_styles ?? "" ?>
<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>
<div class="sidenav">
    <h3>
        <a href="">
            <img src="../assets/img/misc/RuralConnectAltLogo.png" alt="Rural Connect Logo" width="200px">
            <h4>Delivery</h4>
        </a>
    </h3>

    <a href="<?php echo $ms->url('deliveries') ?>" name="nav-link" <?php echo $ms->url() === $ms->url('deliveries/') ? "class='sidenav-active'" : "" ?>>
        <div class="nav-link-inner">
            <?php echo Misc::displayPageTitle("Dashboard", "fa-home","15px"); ?>
        </div>
    </a>

    <a href="<?php echo $ms->url('deliveries/request-queues.php') ?>" name="nav-link" <?php echo $ms->url() === $ms->url('deliveries/request-queues.php') ? "class='sidenav-active'" : "" ?>>
        <div class="nav-link-inner">
            <?php echo Misc::displayPageTitle("Request Queues", "fa-stream","15px") ?>
        </div>
    </a>

    <a href="<?php echo $ms->url('deliveries/request-history.php') ?>" name="nav-link" <?php echo $ms->url() === $ms->url('deliveries/request-history.php') ? "class='sidenav-active'" : "" ?>>
        <div class="nav-link-inner">
            <?php echo Misc::displayPageTitle("Request History","fa-history","15px") ?>
        </div>
    </a>

    <a href="<?php echo $ms->url('deliveries/updateProfile.php') ?>" name="nav-link" <?php echo $ms->url() === $ms->url('deliveries/updateProfile.php') || $ms->url() === $ms->url('deliveries/changePassword.php') ? "class='sidenav-active'" : "" ?>>
        <div class="nav-link-inner">
            <?php echo Misc::displayPageTitle("Settings", "fa-gear","15px") ?>
        </div>
    </a>

    <a href="../page/rate-and-feedback.php" name="nav-link">
        <div class="nav-link-inner">
            <?php echo Misc::displayPageTitle("Rate and Feedback", "fa-pen-to-square","15px") ?>
        </div>
    </a>

    <a href="#" name="nav-link" id="admin_logout">
        <div class="nav-link-inner">
            <?php echo Misc::displayPageTitle("Logout", "fa-right-from-bracket","15px") ?>
        </div>
    </a>
</div>

<!-- Mobile Hamburger Toggle -->
<button class="mobile-nav-toggle d-lg-none" id="mobileNavToggle">
    <i class="fas fa-bars"></i>
</button>

<div class="main-content">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <span class="d-flex justify-content-start align-items-center">
                    <h3 class="rc-blue-text fw-bold"><?php echo $deliveries_title ?? "" ?></h3>
                </span>
            </div>
        </div>
        <div style="margin-top:20px">
            <?php echo $deliveries_content ?? "" ?>
        </div>
    </div>
</div>

<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="module" src="../assets/js/deliveries.all.js"></script>
<?php echo $deliveries_scripts ?? "" ?>
<?php $scripts = ob_get_clean() ?>

<?php require_once "../shared/layout.php" ?>