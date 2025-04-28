<?php require_once "../util/Misc.php" ?>
<?php $misc = new Misc() ?>
<?php $title = "405 Method Not Allowed" ?>

<?php ob_start() ?>
<style>
    body {
        background-color: #c8d3ff;
    }
</style>
<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>
<div class="container">
    <div class="bg-white shadow-sm rounded"
        style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%); padding: 50px">
        <p class="p-6 text-center">
            <img src="../assets/img/misc/RuralConnectAltLogo.png" alt="Rural Connect Logo" width="500">
        <h3 style="padding-top: 15px; text-align: center">Oops! Method Not Allowed. 🛑</h3>
        <h5 style="padding-bottom: 15px; color:#D3D3D3">The HTTP method used is not allowed for this resource. Please
            use one of the following method: <?php echo $allowed_method ?? "" ?>. 🚀 <a
                href="<?php echo $misc->url('page/') ?>" style="text-decoration: none">Go To
                Homepage</a><?php echo isset($_SESSION['accountId']) ? " Or <a href='#' class='text-danger' style='text-decoration: none' id='admin_logout'>Logout</a>" : "" ?>
        </h5>
        </p>
    </div>
</div>
<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<?php if (isset($_SESSION['accountId'])): ?>
    <script type="module" src="../assets/js/logout.js"></script>
<?php endif ?>
<?php $scripts = ob_get_clean() ?>

<?php require_once "../shared/layout.php" ?>