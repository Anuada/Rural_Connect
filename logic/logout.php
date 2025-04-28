<?php
session_start();

require_once "../util/DbHelper.php";

$db = new DbHelper();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    $allowed_method = 'POST';
    include "../shared/405.page.php";
    exit();
}

$db->updateRecord("account", ["accountId" => $_SESSION["accountId"], "isLogin" => "0"]);
if ($_SESSION["user_type"] == "admin") {
    $db->updateRecord("admin_auth_tokens", ["admin_id" => $_SESSION["accountId"], "is_authenticated" => "0", "auth_token" => null]);
}

session_unset();
session_destroy();
header("Location: ../page/login.php");