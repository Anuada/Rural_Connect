<?php
require_once "../util/DbHelper.php";
$db = new DbHelper;
$account = $db->fetchRecords('account', ['accountId' => $_SESSION["accountId"]])[0];
if ($account["isVerify"] == 0) {
    header("Location: ../shared/resend-verification-link.php");
    exit();

}