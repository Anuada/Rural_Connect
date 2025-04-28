<?php
session_start();
require_once "../shared/session.barangay_inc.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";
require_once "../enums/RequestStatus.php";

$db = new DbHelper();
$ms = new Misc;
$request_statuses[] = "Pending";
$request_statuses = array_merge($request_statuses, RequestStatus::all());


$account_id = $_SESSION["accountId"];

//Pending | Accepted | Cancelled

$total_requests = [];
$standard_requests = [];
$customized_requests = [];

foreach ($request_statuses as $status) {
    $standard_requests[] = $db->count_all_records('request_med', ['barangay_inc_id' => $account_id, 'requestStatus' => $status]);
}

foreach ($request_statuses as $status) {
    $customized_requests[] = $db->count_all_records('custom_med_request', ['barangay_inc_id' => $account_id, 'request_status' => $status]);
}

for ($i = 0; $i < count($request_statuses); $i++) {
    $total_requests[$request_statuses[$i]] = $standard_requests[$i] + $customized_requests[$i];
}

$data = [
    "total_requests" => $total_requests,
    "standard_requests" => $standard_requests,
    "customized_requests" => $customized_requests
];

echo $ms->json_response($data, "Pending | Accepted | Cancelled");