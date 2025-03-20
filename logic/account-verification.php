<?php
session_start();
require_once "../util/DbHelper.php";
$db = new DbHelper();

if ((isset($_GET["accountId"]) && isset($_GET["token"])) && (!empty(trim($_GET["accountId"])) && !empty(trim($_GET["token"])))) {
    $accountId = $_GET["accountId"];
    $token = $_GET["token"];
    $check_token = $db->fetchRecords("account", ["accountId" => $accountId, "verify_token" => $token]);
    if ($check_token != null) {
        $verify = $db->updateRecord("account", ["accountId" => $accountId, "isVerify" => "1", "verify_token" => null]);
        if ($verify > 0) {
            $_SESSION["m"] = "Account Successfully Verified";
            header("Location: ../page/");
            exit();
        } else {
            $_SESSION["m"] = "Error Verifying Account!";
            header("Location: ../page/");
            exit();
        }
    } else {
        $_SESSION["m"] = "Token Not Found!";
        header("Location: ../page/");
        exit();
    }
} else {
    $_SESSION["m"] = "Token Not Found!";
    header("Location: ../page/");
    exit();
}