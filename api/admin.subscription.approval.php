<?php
session_start();
require_once "../shared/session.admin.php";
require_once "../admin/is.admin.authenticated.php";
require_once "../util/dbhelper.php";
require_once "../util/Misc.php";
require_once "../util/EmailSender.php";
require_once "../enums/SubscriptionPlan.php";

$db = new DbHelper();
$ms = new Misc;
$es = new EmailSender();

if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    http_response_code(405);
    echo json_encode(['message' => 'Method Not Allowed']);
    exit();
}

$json = file_get_contents('php://input');
$data = json_decode($json, true);


$fieldInputs = [
    "id" => $data['id'],
    "approve_status" => $data['approve_status'],
];

$approve_status = $data['approve_status'];

$subscription_details = $db->getRecord('subscription', ['id' => $data['id']]);
$account_details = $db->getRecord('account', ['accountId' => $subscription_details['barangay_id']]);
$email = $account_details['email'];
$username = $account_details['username'];
$receipt_id = $subscription_details['id'];
$plan = $subscription_details['plan'];

if ($data['approve_status'] == 'Cancelled') {
    if (!isset($data['cancel_note']) || empty(trim($data['cancel_note']))) {
        echo $ms->json_response(['note' => 'cancel note is required'], '', 422);
        exit();
    }
    $note = $data['cancel_note'];
    $fieldInputs['cancel_note'] = htmlspecialchars($data['cancel_note']);
    $es->barangaySubscriptionCancelled($email, $username, $note, $plan);
    $cancel_subscription = $db->updateRecord('subscription', $fieldInputs);

    if ($cancel_subscription > 0) {
        echo $ms->json_response(null, "Subscription Successfully $approve_status");
        exit();
    }
}

$date = new DateTime();
$fieldInputs["start_date"] = $date->format('Y-m-d');
$fieldInputs['end_date'] = $subscription_details['plan'] == SubscriptionPlan::Annual->value ?
    $date->modify('+1 year')->format('Y-m-d') :
    $date->modify('+1 month')->format('Y-m-d');

$es->barangaySubscriptionApproved($email, $username, $receipt_id, $plan);

$approve_subscription = $db->updateRecord('subscription', $fieldInputs);
if ($approve_subscription > 0) {
    echo $ms->json_response(null, "Subscription Successfully $approve_status");
    exit();
}