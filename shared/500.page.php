<?php require_once "../util/Misc.php" ?>
<?php $misc = new Misc() ?>
<?php $title = "500 Internal Server Error" ?>

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
            <img src="<?php echo $misc->url('assets/img/misc/logo1.png') ?>"
                alt="Elevate Her Logo" width="500">
        <h3 style="padding-top: 15px; text-align: center">Oops! Something went wrong. 🛑</h3>
        <h5 style="padding-bottom: 15px; color:#D3D3D3">We're sorry, but there was an internal server error. Please try
            again later or contact support if the problem persists. 🚀 <a href="<?php echo $misc->url('page/') ?>"
                style="text-decoration: none">Go To Homepage</a></h5>
        </p>
    </div>
</div>
<?php $content = ob_get_clean() ?>

<?php require_once "../shared/layout.php" ?>