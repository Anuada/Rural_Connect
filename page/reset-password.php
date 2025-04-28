<?php
session_start();
require_once "../util/DbHelper.php";
$db = new DbHelper();

if ((isset($_GET["accountId"]) && isset($_GET["token"])) && (!empty(trim($_GET["accountId"])) && !empty(trim($_GET["token"])))) {
    $account = $db->fetchRecords("account", ["accountId" => $_GET["accountId"], "recovery_token" => $_GET["token"]]);
    if ($account == null) {
        $_SESSION["m"] = "Token Not Found!";
        header("Location: ../page/");
        exit();
    }
} else {
    $_SESSION["m"] = "Parameter Not Found!";
    header("Location: ../page/");
    exit();
}

$title = "Reset Password";
?>

<?php ob_start(); ?>
<link rel="stylesheet" href="../assets/css/login.css">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="../page/">Rural Connect</a>
    </div>
</nav>

<form action="../logic/reset-password.php" method="post" id="loginform">
    <div class="login-container">
        <img src="../assets/img/misc/rural_connect_icon_logo.png" alt="Logo" />
        <div class="login-form">
            <h2>Reset Password</h2>
            <input type="hidden" name="accountId" id="accountId">
            <input type="hidden" name="token" id="token">
            <input placeholder="Password" required aria-label="Password" type="password" id="password"
                name="password" />
            <input placeholder="Confirm Password" required aria-label="Confirm Password" type="password"
                id="re-password" name="re-password" />
            <button type="submit" name="submit">Submit</button>
            <a class="create-account" href="../page/login.php">Back to Login →</a>
        </div>
    </div>
</form>

<!-- <form action="../logic/reset-password.php" method="post" id="loginform">
    <div class="login-container">
        <img src="../assets/img/misc/delivery_pic.jpeg" alt="Logo" />
        <div class="login-form">
            <center>
                <h2>Reset Password</h2>
            </center>
            <input type="hidden" name="accountId" id="accountId">
            <input type="hidden" name="token" id="token">
            <input placeholder="Password" required aria-label="Password" type="password" id="password"
                name="password" />
            <input placeholder="Confirm Password" required aria-label="Confirm Password" type="password"
                id="re-password" name="re-password" />
            <button type="submit" name="submit">SUBMIT</button>
            <a class="create-account" href="../page/login.php">Back To Login →</a>
        </div>
    </div>
</form> -->
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<?php if (isset($_GET["accountId"]) && isset($_GET["token"])): ?>
    <script>
        document.getElementById("accountId").value = "<?php echo $_GET["accountId"] ?>";
        document.getElementById("token").value = "<?php echo $_GET["token"] ?>";
    </script>
<?php endif; ?>
<?php $scripts = ob_get_clean(); ?>
<?php require_once "../shared/layout.php"; ?>