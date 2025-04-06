<?php
session_start();
require_once "../shared/session.admin.php";

require_once "../util/DbHelper.php";
$db = new DbHelper();

if (!isset($_POST['auth_token'])) {
    header("Location: ../page/");
    exit();
}

$admin_id = $_SESSION["accountId"];
$auth_token = implode($_POST['auth_token']);

$check_token = $db->fetchRecords('admin_auth_tokens', ['admin_id' => $admin_id, 'auth_token' => $auth_token]);

if (empty($check_token)) {
    $_SESSION["m"] = "Token Not Found!";
    header("Location: ../admin/authentication.php");
    exit();
}

$authenticate = $db->updateRecord('admin_auth_tokens', ['admin_id' => $admin_id, 'auth_token' => null, 'is_authenticated' => 1]);

if ($authenticate > 0) {
    $admin = $db->fetchRecords("admin", ["accountId" => $admin_id])[0];
    $_SESSION["m"] = "Welcome " . $admin["fname"] . " " . $admin["lname"];
    header("Location: ../admin/");
    exit();
} else {
    $_SESSION["m"] = "Error Authenticating Admin!";
    header("Location: ../admin/authentication.php");
    exit();
}