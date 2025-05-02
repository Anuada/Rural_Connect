<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../enums/RequestType.php";
require_once "../enums/DeliveryStatus.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;
$request_types = RequestType::all();

$fields = ['delivery_id', 'request_type'];

$error_fields = [];

foreach ($fields as $field) {
    if (!isset($_GET[$field]) || empty(trim($_GET[$field]))) {
        $error_fields[] = str_replace("_", " ", $field);
    }
}

if (!empty($error_fields)) {
    $message = $ms->formatListWithOxfordComma($error_fields) . (count($error_fields) > 1 ? " are" : " is") . " required";
    echo $ms->json_response(null, $message, 422);
    exit();
}

$request_type = $_GET['request_type'];
$delivery_id = $_GET['delivery_id'];
$failed_delivery_count = 0;

if (!in_array($request_type, $request_types)) {
    echo $ms->json_response(null, 'invalid request type', 422);
    exit();
}

if ($request_type == RequestType::Standard_Request->value) {
    $failed_delivery_count = $db->count_all_records('delivery_status_history', ['delivery_id' => $delivery_id, 'status' => DeliveryStatus::Failed_Delivery->value]);
} else {
    $failed_delivery_count = $db->count_all_records('custom_med_delivery_status_history', ['delivery_id' => $delivery_id, 'status' => DeliveryStatus::Failed_Delivery->value]);
}

echo $ms->json_response($failed_delivery_count,"Failed Delivery Count");
exit();