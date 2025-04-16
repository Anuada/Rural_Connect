<?php
require_once "../util/Misc.php";
$ms = new Misc;
$title = "Admin";
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/admin.all.css">
<?php echo $admin_styles ?? "" ?>
<?php $styles = ob_get_clean() ?>
<?php ob_start() ?>

<div class="sidenav">
    <h3>
        <a href="">
            <img src="../assets/img/misc/RuralConnectAltLogo.png" alt="Rural Connect Logo" width="200px">
            <h4>Admin</h4>
        </a>
    </h3>
    <a href="<?php echo $ms->url('admin') ?>" name="nav-link" <?php echo $ms->url() === $ms->url('admin/') ? "class='sidenav-active'" : "" ?>>
        <div class="row align-items-center">
            <div class="col-sm-2"><i class="fas fa-home"></i></div>
            <div class="col"><span>Dashboard</span></div>
        </div>
    </a>

    <a href="<?php echo $ms->url('admin/pending-accounts.php') ?>" name="nav-link" <?php echo $ms->url() === $ms->url('admin/pending-accounts.php') ? "class='sidenav-active'" : "" ?>>
        <div class="row align-items-center">
            <div class="col-sm-2"><i class="fas fa-user"></i></div>
            <div class="col"><span>Pending Accounts</span></div>
        </div>
    </a>

    <a href="<?php echo $ms->url('admin/subscription.php') ?>" name="nav-link" <?php echo $ms->url() === $ms->url('admin/subscription.php') ? "class='sidenav-active'" : "" ?>>
        <div class="row align-items-center">
            <div class="col-sm-2"><i class="fas fa-clipboard-list"></i></div>
            <div class="col"><span>Subscriptions</span></div>
        </div>
    </a>

    <a href="<?php echo $ms->url('admin/ratings-and-feedbacks.php') ?>" name="nav-link" <?php echo $ms->url() === $ms->url('admin/ratings-and-feedbacks.php') ? "class='sidenav-active'" : "" ?>>
        <div class="row align-items-center">
            <div class="col-sm-2"><i class="fas fa-pen-to-square"></i></div>
            <div class="col"><span>Ratings and Feedbacks</span></div>
        </div>
    </a>

    <a href="<?php echo $ms->url('admin/settings.php') ?>" name="nav-link" <?php echo $ms->url() === $ms->url('admin/settings.php') ? "class='sidenav-active'" : "" ?>>
        <div class="row align-items-center">
            <div class="col-sm-2"><i class="fas fa-gear"></i></div>
            <div class="col"><span>Settings</span></div>
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
                    <h3 class="fw-bold"><?php echo $admin_title ?? "" ?></h3>
                </span>
            </div>
        </div>
        <div style="margin-top:20px">
            <?php echo $admin_content ?? "" ?>
        </div>
    </div>
</div>

<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<script type="module" src="../assets/js/admin.all.js"></script>
<?php echo $admin_scripts ?? "" ?>
<?php $scripts = ob_get_clean() ?>

<?php require_once "../shared/layout.php" ?>