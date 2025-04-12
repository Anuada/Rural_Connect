<?php

if (!isset($_SESSION['accountId'])) {
    header("Location: ../page/login.php");
    exit();
}

require_once "../shared/is.user.verified.php";
require_once "../enums/UserType.php";
require_once "../util/DbHelper.php";

if ($_SESSION['user_type'] != UserType::barangay_inc->value) {
    header("Location: ../page/login.php");
    exit();
}

$db = new DbHelper();

$barangay_subscriptions = $db->fetchRecords("subscription", ["barangay_id" => $_SESSION["accountId"]]);

$date = new DateTime();

$pending_barangay = [];
$subscribed_barangay = [];
foreach ($barangay_subscriptions as $bs) {
    $start_date = !empty($bs['start_date']) ? new DateTime($bs['start_date']) : null;
    $end_date = !empty($bs['end_date']) ? new DateTime($bs['end_date']) : null;
    $approve_status = $bs['approve_status'];

    if ($approve_status === 'Pending') {
        $pending_barangay[] = $bs;
    } elseif ($start_date !== null && $end_date !== null && $date >= $start_date && $date <= $end_date) {
        if ($approve_status === 'Approved') {
            $subscribed_barangay[] = $bs;
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

