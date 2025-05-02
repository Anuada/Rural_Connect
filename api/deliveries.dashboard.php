<?php
session_start();
require_once "../shared/session.delivery.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";
require_once "../enums/DeliveryStatus.php";

$db = new DbHelper();
$ms = new Misc;

$accountId = $_SESSION["accountId"];

// Standard Request | Customized Request

$ongoing_queues_chart = [];
$claimed_chart = [];
$returned_chart = [];

$ongoing_queues_chart[] = $db->count_all_records("med_deliveries", ["deliveries_accountId" => $accountId], " AND delivery_status NOT IN ('Returned', 'Claimed')");
$ongoing_queues_chart[] = $db->count_all_records("custom_med_deliveries", ["delivery_account_id" => $accountId], " AND delivery_status NOT IN ('Returned', 'Claimed')");

$claimed_chart[] = $db->count_all_records("med_deliveries", ["deliveries_accountId" => $accountId, "delivery_status" => DeliveryStatus::Claimed->value]);
$claimed_chart[] = $db->count_all_records("custom_med_deliveries", ["delivery_account_id" => $accountId, "delivery_status" => DeliveryStatus::Claimed->value]);

$returned_chart[] = $db->count_all_records("med_deliveries", ["deliveries_accountId" => $accountId, "delivery_status" => DeliveryStatus::Returned->value]);
$returned_chart[] = $db->count_all_records("custom_med_deliveries", ["delivery_account_id" => $accountId, "delivery_status" => DeliveryStatus::Returned->value]);

$totals = [
    "ongoing_queues" => array_sum($ongoing_queues_chart),
    "claimed" => array_sum($claimed_chart),
    "returned" => array_sum($returned_chart)
];

$data = [
    "totals" => $totals,
    "ongoing_queues_chart" => $ongoing_queues_chart,
    "claimed_chart" => $claimed_chart,
    "returned_chart" => $returned_chart
];

echo $ms->json_response($data, "Standard Request | Customized Request");
exit();