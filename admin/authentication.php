<?php

session_start();
require_once "../shared/session.admin.php";
require_once "../util/DbHelper.php";
$db = new DbHelper();
$account = $db->fetchRecords('admin_auth_tokens', ['admin_id' => $_SESSION["accountId"]])[0];
if ($account["is_authenticated"] != 0) {
    header("Location: ./");
    exit();
}

$title = "Admin Authentication";

?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/admin.auth.css">
<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>
<div class="container">
    <div class="bg-white shadow-sm rounded"
        style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%); padding: 50px">
        <p class="p-6 text-center">
            <img src="../assets/img/misc/RuralConnectAltLogo.png" alt="Elevate Her Logo" width="300">
        <div style="text-align:center" class="header-desc">
            <p>Please enter the authentication code</p>
            <p>we sent to your email</p>
        </div>
        <h5 style="padding-bottom: 15px; color:#D3D3D3">
            <form action="../logic/admin-authentication.php" method="post" style="padding-top: 20px">
                <div class="otp-container">
                    <?php for ($i = 0; $i < 8; $i++): ?>
                        <input type="text" name="auth_token[]" id="otp-<?php echo $i; ?>" class="otp-input" maxlength="1"
                            oninput="moveFocus(this)">
                    <?php endfor; ?>
                </div>
                <button type="submit" id="submit"
                    style="background-color: #007bff;color: #fff; margin-top: 20px; width:100%"
                    class="btn btn-block">Send</button>
            </form>
        </h5>
        </p>
        <hr>
        <div class="d-flex justify-content-center align-items-center">
            <form action="../logic/resend-authentication-code.php" method="post" style="padding-right: 60px">
                <button class="btn shadow-sm" style="background-color: #007bff;color: #fff;" type="submit"
                    name="resend_email">Resend Authentication Code</button>
            </form>
            <form action="../logic/logout.php" method="post" id="logout">
                <button type="submit" class="btn btn-danger shadow-sm">Logout</button>
            </form>
        </div>
    </div>
</div>

<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<script>
    function moveFocus(current) {
        if (current.value.length >= current.maxLength) {
            const next = current.nextElementSibling;
            if (next) {
                next.focus();
            }
        } else if (current.value.length === 0) {
            const previous = current.previousElementSibling;
            if (previous) {
                previous.focus();
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const inputs = document.querySelectorAll('.otp-input');
        inputs.forEach((input, index) => {
            input.addEventListener('paste', function (e) {
                e.preventDefault();
                const pasteData = (e.clipboardData || window.clipboardData).getData('text');
                const pasteValues = pasteData.split('');
                pasteValues.forEach((char, i) => {
                    if (index + i < inputs.length) {
                        inputs[index + i].value = char;
                    }
                });
            });
        });
    });
</script>
<script type="module" src="../assets/js/form-logout.js"></script>
<?php $scripts = ob_get_clean() ?>

<?php require_once "../shared/layout.php" ?>