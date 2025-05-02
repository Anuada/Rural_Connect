<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../enums/RequestType.php";
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
$delivery_feedback_details = [];

if (!in_array($request_type, $request_types)) {
    echo $ms->json_response(null, 'invalid request type', 422);
    exit();
}

if ($request_type == RequestType::Standard_Request->value) {
    $check = $db->fetchStandardRequestDeliveryFeedback($delivery_id);
    if (empty($check)) {
        echo $ms->json_response(null, 'delivery feedback not found', 422);
        exit();
    }
    $delivery_feedback_details = $check;
} else {
    $check = $db->fetchCustomizedRequestDeliveryFeedback($delivery_id);
    if (empty($check)) {
        echo $ms->json_response(null, 'delivery feedback not found', 422);
        exit();
    }
    $delivery_feedback_details = $check;
}


echo $ms->json_response($delivery_feedback_details,"Delivery Feedback");
exit();