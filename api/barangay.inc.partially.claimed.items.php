<?php
session_start();
require_once "../shared/session.barangay_inc.php";
require_once "../util/DbHelper.php";
require_once "../enums/UserType.php";
require_once "../enums/RequestType.php";
require_once "../enums/DeliveryStatus.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;

if ($_SERVER['REQUEST_METHOD'] != 'PUT') {
    echo $ms->json_response(null, "Method Not Allowed", 405);
    exit();
}

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$errorFields = [];

foreach ($data as $key => $value) {
    if (empty(trim($value))) {
        $errorFields[] = str_replace(" pc", "", str_replace("_", " ", $key));
    }
}

if (!empty($errorFields)) {
    $message = $ms->formatListWithOxfordComma($errorFields) . (count($errorFields) > 1 ? " are" : " is") . " required";
    echo $ms->json_response(null, $message, 422);
    exit();
}

switch ($data['request_type_pc']) {
    case RequestType::Standard_Request->value:
        $check_delivery = $db->getRecord("med_deliveries", ["id" => $data['delivery_id_pc']]);
        if (empty($check_delivery)) {
            echo $ms->json_response(null, "Delivery Not Found", 422);
            exit();
        }
        $check_request = $db->getRecord("request_med", ["id" => $check_delivery['request_med_id']]);
        $requested_quantity = (int) $check_request['request_quantity'];

        if ($data['total_partially_claimed'] <= 0) {
            echo $ms->json_response(null, "Number Must Be Greater Than 1", 422);
            exit();
        }

        if ($data['total_partially_claimed'] >= $requested_quantity) {
            echo $ms->json_response(null, "Number must not exceed or equal the requested quantity.", 422);
            exit();
        }

        $new_total_requested_quantity = $requested_quantity - (int) $data['total_partially_claimed'];

        $update_status = $db->updateRecord("med_deliveries", ["id" => $data['delivery_id_pc'], "delivery_status" => DeliveryStatus::Partially_Claimed->value]);
        if ($update_status > 0) {
            $db->updateRecord("request_med", ["id" => $check_delivery['request_med_id'], "request_quantity" => $new_total_requested_quantity]);
            $db->addRecord("delivery_status_history", ["delivery_id" => $data['delivery_id_pc'], "status" => DeliveryStatus::Partially_Claimed->value]);
            $db->addRecord("standard_total_partially_claimed", ["delivery_id" => $data['delivery_id_pc'], "total_partially_claimed" => $data['total_partially_claimed']]);
            echo $ms->json_response(null, "Item Was Partially Claimed, Wait for the City Health to reschedule delivery");
            exit();
        }
        break;

    case RequestType::Customized_Request->value:
        $check_delivery = $db->getRecord("custom_med_deliveries", ["id" => $data['delivery_id_pc']]);
        if (empty($check_delivery)) {
            echo $ms->json_response(null, "Delivery Not Found", 422);
            exit();
        }

        $check_request = $db->getRecord("custom_med_request", ["id" => $check_delivery['custom_med_request_id']]);
        $requested_quantity = (int) $check_request['requested_quantity'];

        if ($data['total_partially_claimed'] <= 0) {
            echo $ms->json_response(null, "Number Must Be Greater Than 1", 422);
            exit();
        }

        if ($data['total_partially_claimed'] >= $requested_quantity) {
            echo $ms->json_response(null, "Number must not exceed or equal the requested quantity.", 422);
            exit();
        }

        $new_total_requested_quantity = $requested_quantity - (int) $data['total_partially_claimed'];
        $update_status = $db->updateRecord("custom_med_deliveries", ["id" => $data['delivery_id_pc'], "delivery_status" => DeliveryStatus::Partially_Claimed->value]);
        if ($update_status > 0) {
            $db->updateRecord("custom_med_request", ["id" => $check_delivery['custom_med_request_id'], "requested_quantity" => $new_total_requested_quantity]);
            $db->addRecord("custom_med_delivery_status_history", ["delivery_id" => $data['delivery_id_pc'], "status" => DeliveryStatus::Partially_Claimed->value]);
            $db->addRecord("custom_total_partially_claimed", ["delivery_id" => $data['delivery_id_pc'], "total_partially_claimed" => $data['total_partially_claimed']]);
            echo $ms->json_response(null, "Item Was Partially Claimed, wait for the City Health to reschedule delivery");
            exit();
        }
        break;

    default:
        echo $ms->json_response(null, "Invalid Request Type", 422);
        exit();

}