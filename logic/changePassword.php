<?php
session_start();

if (!isset($_SESSION['accountId'])) {
    header("Location: ../login.php");
    exit();
}

require_once "../util/DbHelper.php";

$db = new DbHelper();

if (!isset($_POST["submit"])) {
    header("Location: ../");
    exit();
}

$user = $db->fetchRecords("account", ["accountId" => $_SESSION["accountId"]])[0];

$infos = ["current_password", "new_password", "repeat_password"];
$errorMessages = [];

foreach ($infos as $i) {
    if (!isset($_POST[$i]) || empty(trim($_POST[$i]))) {
        $var = str_replace("_", " ", $i);
        $errorMessages[$i] = "$var is required";
    }
}

if (!password_verify($_POST["current_password"], $user["password"])) {
    $errorMessages["current_password"] = "Incorrect Password";
}

if ($_POST["new_password"] !== $_POST["repeat_password"]) {
    $errorMessages["new_password"] = "New password and confirmation do not match.";
}

if (!empty($errorMessages)) {
    $_SESSION["errorMessages"] = $errorMessages;
    header("Location: ../barangay_inc/changePassword.php");
    exit();
}

$newPassword = password_hash($_POST["new_password"], PASSWORD_DEFAULT);
$changePassword = $db->updateRecord("account", ["accountId" => $user["accountId"], "password" => $newPassword]);

if ($changePassword <= 0) {
    $_SESSION["m"] = "Password Not Changed!";
    header("Location: ../barangay_inc/changePassword.php");
    exit();
}

$_SESSION["m"] = "Password changed successfully";
switch ($user["user_type"]) {
    case 'barangay_inc':
        header("Location: ../barangay_inc/changePassword.php");
        break;

    case 'deliveries':
        header("Location: ../deliveries/changePassword.php");
        break;

    case 'city_health':
        header("Location: ../city_health/changePassword.php");
        break;

    default:
        break;
}