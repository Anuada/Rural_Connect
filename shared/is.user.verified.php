<?php
require_once "../util/DbHelper.php";
require_once "../enums/ApproveStatus.php";
$db = new DbHelper;
$account = $db->fetchRecords('account', ['accountId' => $_SESSION["accountId"]])[0];
if ($account["isVerify"] == 0) {
    header("Location: ../shared/resend-verification-link.php");
    exit();

} elseif ($account["account_status"] != ApproveStatus::Approved->value) {
    if ($account["account_status"] == ApproveStatus::Pending->value) {
        require_once "../shared/account-pending.php";
        exit();
    } else {
        require_once "../shared/account-rejected.php";
        exit();
    }
}