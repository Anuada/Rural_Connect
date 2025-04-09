<?php $title = "Account Pending" ?>

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
            <img src="../assets/img/misc/RuralConnectAltLogo.png" alt="Rural Connect Logo" width="300">
        <h3 class="text-center" style="padding-top: 15px">
            ACCOUNT REJECTED! <i class="fa-solid fa-user-slash"></i>
        </h3>
        <h5 style="padding-bottom: 15px; color:#D3D3D3">Unfortunately, your account application has been rejected; if
            you have any questions or wish to appeal, please don't hesitate to contact us.
        </h5>
        </p>
        <div class="d-flex justify-content-end">
            <a href="../logic/logout.php" class="btn btn-danger shadow-sm">Logout</a>
        </div>
    </div>
</div>
<?php $content = ob_get_clean() ?>

<?php require_once "../shared/layout.php" ?>