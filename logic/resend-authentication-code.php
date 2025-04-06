<?php
session_start();
require_once "../shared/session.admin.php";
require_once "../util/DbHelper.php";
require_once "../util/EmailSender.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$es = new EmailSender();
$ms = new Misc;

if (!isset($_POST['resend_email'])) {
    header("Location: ../page/");
    exit();
}

$email = $_SESSION["email"];
$username = $_SESSION["username"];
$account_id = $_SESSION["accountId"];
$authentication_code = $ms->generateRandomNumbers();

$es->requestAdminAuthentication($email, $username, $authentication_code);
$db->updateRecord("admin_auth_tokens", ["admin_Id" => $account_id, "auth_token" => $authentication_code]);

$_SESSION["m"] = "Check your email for authentication code";
header("Location: ../admin/authentication.php");

