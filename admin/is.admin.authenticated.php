<?php
require_once "../util/DbHelper.php";
$db = new DbHelper;
$admin = $db->fetchRecords('admin_auth_tokens', ['admin_id' => $_SESSION["accountId"]])[0];
if ($admin["is_authenticated"] == 0) {
    header("Location: ./authentication.php");
    exit();
}
