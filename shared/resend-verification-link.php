<?php
session_start();
if (isset($_SESSION['accountId'])) {
    require_once "../util/DbHelper.php";
    $db = new DbHelper;
    $account = $db->fetchRecords('account', ['accountId' => $_SESSION["accountId"]]);
    if ($account[0]["isVerify"] != 0) {
        header("Location: ../barangay_inc/");
        exit();
    }
} else {
    header("Location: ../page/login.php");
    exit();
}

?>

<?php $title = "Verify Account" ?>

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
        <h3 style="padding-top: 15px">It seems that you are not verified yet!</h3>
        <h5 style="padding-bottom: 15px; color:#D3D3D3">Please check your email for the verification link or click the
            'Resend
            Verification Link' button to have the link resent to your email.</h5>
        </p>
        <div class="d-flex justify-content-center align-items-center">
            <form action="../logic/resend-verification-link.php" method="post" style="padding-right: 60px">
                <input type="hidden" name="accountId" id="accountId" value="<?php echo $_SESSION['accountId'] ?>">
                <button class="btn shadow-sm" style="background-color: #354eab;color: #fff;" type="submit"
                    name="resend_email">Resend Verification Link</button>
            </form>
            <form action="../logic/logout.php" method="post" id="logout">
                <button type="submit" class="btn btn-danger shadow-sm">Logout</button>
            </form>
        </div>
    </div>
</div>
<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<script type="module" src="../assets/js/form-logout.js"></script>
<?php $scripts = ob_get_clean() ?>

<?php require_once "./layout.php" ?>