<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";
$db = new DbHelper();
$ms = new Misc;

if (isset($_SESSION["accountId"])) {
    $account = $db->fetchRecords("account", ["accountId" => $_SESSION["accountId"]])[0];

    switch ($account["user_type"]) {
        case 'admin':
            header("Location: " . $ms->url('admin/'));
            exit;

        case 'barangay_inc':
            header("Location: " . $ms->url('barangay_inc/'));
            exit;

        case 'deliveries':
            header("Location: " . $ms->url('deliveries/'));
            exit;

        case 'city_health':
            header("Location: " . $ms->url('city_health/'));
            exit;

        default:
            exit;
    }
}