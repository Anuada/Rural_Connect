<?php
require_once "../util/Misc.php";
$ms = new Misc;
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/landing_page.css">
<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>
<div class="container">
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo" style="margin-left: 20px">
            <img src="../assets/img/misc/delivery_pic.jpeg" style="object-fit: cover;" alt="Company Logo">
        </div>
        <ul>
            <li><a href="../page/"
                    style="color: <?php echo $ms->url() == strtolower($ms->url("page/")) ? '#ffdd57' : ''; ?>">Home</a>
            </li>
            <li><a href="aboutus.php"
                    style="color: <?php echo $ms->url() == strtolower($ms->url("page/aboutus.php")) ? '#ffdd57' : ''; ?>">About
                    Us</a></li>
            <li><a href="value.php"
                    style="color: <?php echo $ms->url() == strtolower($ms->url("page/value.php")) ? '#ffdd57' : ''; ?>">Value</a>
            </li>
            <li><a href="contact.php"
                    style="color: <?php echo $ms->url() == strtolower($ms->url("page/contact.php")) ? '#ffdd57' : ''; ?>">Contact</a>
            </li>
        </ul>
        <a class="get-started" href="../page/login.php" style="margin-right: 20px" aria-label="Login">Login</a>
    </nav>

    <div class="hero">
        <?php echo $land_page_content; ?>
    </div>
</div>
<?php $content = ob_get_clean() ?>

<?php require_once "../shared/layout.php" ?>