<?php

require_once "../util/DbHelper.php";

$db = new DbHelper();

$barangay_subscriptions = $db->fetchRecords("subscription", ["barangay_id" => $_SESSION["accountId"]]);

if (empty($barangay_subscriptions)) {
    header("Location:../subscription/");
    exit();
}

$date = new DateTime();

$subscribed_barangay = [];
$pending_barangay = [];
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

if (empty($subscribed_barangay)) {
    header("Location: ../subscription/");
    exit();
} elseif (!empty($pending_barangay)) {
    header("Location: ../subscription/");
    exit();
} else {

}