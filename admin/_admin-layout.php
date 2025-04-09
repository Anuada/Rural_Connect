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

<div class="navbar">
    <div>
        <h3>
            <a href=""><b class="rc-blue-text">Rural Connect</b> Admin</a>
        </h3>
    </div>
    <div class="nav-links">
        <a href="<?php echo $ms->url('admin') ?>" <?php echo $ms->url() === $ms->url('admin/') ? "class='navbar-active'" : "" ?>>Dashboard</a>
        <a href="<?php echo $ms->url('admin/accounts.php') ?>" <?php echo $ms->url() === $ms->url('admin/accounts.php') ? "class='navbar-active'" : "" ?>>Accounts</a>
        <a href="<?php echo $ms->url('admin/pending-accounts.php') ?>" <?php echo $ms->url() === $ms->url('admin/pending-accounts.php') ? "class='navbar-active'" : "" ?>>Pending Accounts</a>
        <a href="<?php echo $ms->url('admin/subscription.php') ?>" <?php echo $ms->url() === $ms->url('admin/subscription.php') ? "class='navbar-active'" : "" ?>>Subscriptions</a>
        <a href="<?php echo $ms->url('admin/feedback.php') ?>" <?php echo $ms->url() === $ms->url('admin/feedback.php') ? "class='navbar-active'" : "" ?>>Feedback</a>
        <a href="<?php echo $ms->url('admin/settings.php') ?>" <?php echo $ms->url() === $ms->url('admin/settings.php') ? "class='navbar-active'" : "" ?>>Settings</a>
        <a href="#" id="admin_logout">Logout</a>
    </div>
</div>

<div class="container">
    <?php echo $admin_content ?? "" ?>
</div>

<?php $content = ob_get_clean() ?>



<?php ob_start() ?>
<script src="../assets/js/admin.all.js"></script>
<?php echo $admin_scripts ?? "" ?>

<?php $scripts = ob_get_clean() ?>

<?php require_once "../shared/layout.php" ?>