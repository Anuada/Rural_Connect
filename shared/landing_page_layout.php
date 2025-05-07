<?php
require_once "../util/Misc.php";
$ms = new Misc;
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/landing_page.css">
<?php echo $landing_page_styles ?? "" ?>
<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>
<div class="container">
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo" style="margin-left: 20px">
            <img src="../assets/img/misc/rural_connect_circle_icon_logo.png" style="object-fit: cover;"
                alt="Company Logo">
        </div>
        <ul>
            <li><a href="<?php echo $ms->url("page/") ?>"
                    style="color: <?php echo strtolower($ms->url()) == strtolower($ms->url("page/")) || strtolower($ms->url()) == strtolower($ms->url("page/index.php")) ? '#ffdd57' : ''; ?>">Home</a>
            </li>
            <li><a href="<?php echo $ms->url("page/aboutus.php") ?>"
                    style="color: <?php echo strtolower($ms->url()) == strtolower($ms->url("page/aboutus.php")) ? '#ffdd57' : ''; ?>">About
                    Us</a></li>
            <li><a href="<?php echo $ms->url("page/value.php") ?>"
                    style="color: <?php echo strtolower($ms->url()) == strtolower($ms->url("page/value.php")) ? '#ffdd57' : ''; ?>">Value</a>
            </li>
            <li><a href="<?php echo $ms->url("page/contact.php") ?>"
                    style="color: <?php echo strtolower($ms->url()) == strtolower($ms->url("page/contact.php")) ? '#ffdd57' : ''; ?>">Contact</a>
            </li>
            <li><a href="<?php echo $ms->url("page/barangay-subscription.php") ?>"
                    style="color: <?php echo strtolower($ms->url()) == strtolower($ms->url("page/barangay-subscription.php")) ? '#ffdd57' : ''; ?>">Barangay
                    Subscription</a>
            </li>
        </ul>
        <?php if (isset($_SESSION["accountId"])): ?>
            <a class="get-started" href="#" style="margin-right: 20px" aria-label="Open" id="openRuralConnect">Open</a>
        <?php else: ?>
            <a class="get-started" href="../page/login.php" style="margin-right: 20px" aria-label="Login">Login</a>
        <?php endif ?>
    </nav>

    <div class="hero">
        <?php echo $land_page_content; ?>
    </div>
</div>
<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<script>
    document.getElementById("openRuralConnect").addEventListener("click", () => {
        location.href = "../shared/session.redirect.php";
    });
</script>
<?php echo $landing_page_scripts ?? "" ?>
<?php $scripts = ob_get_clean() ?>

<?php require_once "../shared/layout.php" ?>