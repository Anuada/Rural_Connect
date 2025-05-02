<?php
session_start();
require_once "../shared/session.delivery.php";
require_once "../enums/AvailabilityStatus.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;
$availability_statuses = AvailabilityStatus::all();

if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    echo $ms->json_response(null, 'Method Not Allowed', 405);
    exit();
}

$accountId = $_SESSION["accountId"];

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!in_array($data['availability_status'], $availability_statuses)) {
    echo $ms->json_response(null, "Invalid Availability Status", 422);
    exit();
}

$update_availability_status = $db->updateRecord('deliveries', ['accountId' => $accountId, 'availability_status' => $data['availability_status']]);

if ($update_availability_status > 0) {
    echo $ms->json_response(null, "Updated Availability Status");
    exit();
} else {
    echo $ms->json_response(null, "Error Updating Availability Status", 422);
    exit();
}