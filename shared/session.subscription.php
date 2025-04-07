<?php

if (!isset($_SESSION['accountId'])) {
    header("Location: ../page/login.php");
    exit();
}
require_once "../shared/is.user.verified.php";
require_once "../util/dbhelper.php";

$db = new DbHelper();

$barangay_subscriptions = $db->fetchRecords("subscription", ["barangay_id" => $_SESSION["accountId"]]);

$date = new DateTime();

$pending_barangay = [];
$subscribed_barangay = [];
foreach ($barangay_subscriptions as $bs) {
    $start_date = new DateTime($bs['start_date']);
    $end_date = new DateTime($bs['end_date']);
    $approve_status = $bs['approve_status'];
    if ($date >= $start_date && $date <= $end_date) {
        if ($approve_status == 'Approved') {
            $subscribed_barangay[] = $bs;
        } elseif ($approve_status == 'Pending') {
            $pending_barangay[] = $bs;
        }
    }
}

if (!empty($pending_barangay)) {
    require_once "../shared/subscription.pending.php";
    exit();
} elseif (!empty($subscribed_barangay)) {
    header("Location: ../barangay_inc/");
    exit();
} else {

}

