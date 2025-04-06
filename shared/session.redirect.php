<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once "../util/DbHelper.php";
$db = new DbHelper();

if (isset($_SESSION["accountId"])) {
    $account = $db->fetchRecords("account", ["accountId" => $_SESSION["accountId"]])[0];

    switch ($account["user_type"]) {
        case 'admin':
            header("Location: ../admin/");
            break;

        case 'barangay_inc':
            header("Location: ../barangay_inc/");
            break;

        case 'deliveries':
            header("Location: ../deliveries/");
            break;

        case 'city_health':
            header("Location: ../city_health/");
            break;

        default:
            break;
    }
}