<?php
session_start();
require_once "../shared/session.admin.php";
require_once "../admin/is.admin.authenticated.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";
require_once "../enums/ApproveStatus.php";

$db = new DbHelper();
$ms = new Misc;
$approve_statuses = ApproveStatus::all();

if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    echo $ms->json_response(null, 'Method Not Allowed', 405);
    exit();
}

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$errorMessages = [];

foreach ($data as $key => $value) {
    if (!isset($value) || empty(trim($value))) {
        $errorMessages[] = "'$key' is required";
    }
}

if (!empty($errorMessages)) {
    echo $ms->json_response(null, implode(" and ", $errorMessages), 422);
    exit();
}

if (!in_array($data['account_status'], $approve_statuses)) {
    $errorMessages[] = "incorrect account status";
}

$check_user = $db->getRecord('account', ['accountId' => $data['accountId']]);
if (empty($check_user)) {
    $errorMessages[] = "user not found";
}

if (!empty($errorMessages)) {
    echo $ms->json_response(null, implode(" and ", $errorMessages), 422);
    exit();
}

if ($check_user['user_type'] == 'barangay_inc') {
    $check_barangay = $db->getRecord('barangay_inc', ['accountId' => $data['accountId']]);
    $barangay = $check_barangay['barangay'];
    if ($data['account_status'] == 'Approved' && $db->isBarangayRegisteredAlready($barangay)) {
        $message = "A Barangay In-Charge is already registered for Barangay $barangay!";
        echo $ms->json_response(null, $message, 422);
        exit();
    }
}

$updateApproveStatus = $db->updateRecord('account', $data);
if ($updateApproveStatus > 0) {
    echo $ms->json_response(null, "Account Successfully " . $data['account_status']);
    exit();
}
