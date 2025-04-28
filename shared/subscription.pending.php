<?php $title = "Pending Subscription" ?>

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
        <h3 class="text-center" style="padding-top: 15px">Your subscription is under review and awaiting administrative
            approval.</h3>
        <h5 class="text-center" style="padding-bottom: 15px; color:#D3D3D3">You'll be notified upon confirmation.</h5>
        </p>
        <div>
            <form action="../logic/logout.php" method="post" id="logout">
                <button type="submit" class="btn btn-danger shadow-sm w-100">Logout</button>
            </form>
        </div>
    </div>
</div>
<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<script type="module" src="../assets/js/form-logout.js"></script>
<?php $scripts = ob_get_clean() ?>

<?php require_once "../shared/layout.php" ?>