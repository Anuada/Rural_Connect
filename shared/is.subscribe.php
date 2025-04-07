<?php
require_once "../util/DbHelper.php";
$db = new DbHelper;
$account = $db->fetchRecords('subscription', ['barangay_id' => $_SESSION["accountId"]])[0];
if (empty($account)) {
    header("Location: ../shared/subscription.php");
    exit();

}