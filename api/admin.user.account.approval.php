<?php
session_start();
require_once "../shared/session.admin.php";
require_once "../admin/is.admin.authenticated.php";
require_once "../util/dbhelper.php";
require_once "../util/Misc.php";
require_once "../enums/ApproveStatus.php";

$db = new DbHelper();
$ms = new Misc;
$approve_statuses = ApproveStatus::all();

if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    http_response_code(405);
    echo json_encode(['message' => 'Method Not Allowed']);
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

$updateApproveStatus = $db->updateRecord('account', $data);
if ($updateApproveStatus > 0) {
    echo $ms->json_response(null, "Account Successfully " . $data['account_status']);
}
