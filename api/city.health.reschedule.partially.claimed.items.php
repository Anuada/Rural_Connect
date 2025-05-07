<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";
require_once "../enums/RequestType.php";
require_once "../enums/DeliveryStatus.php";

$db = new DbHelper();
$ms = new Misc;

if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    echo $ms->json_response(null, 'Method Not Allowed', 405);
    exit();
}

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$reschedule_delivery_date = (new DateTime($data['reschedule-delivery']))->setTime(0, 0, 0);
$today = (new DateTime())->setTime(0, 0, 0);

if ($reschedule_delivery_date < $today) {
    echo $ms->json_response(null, "Looks like you picked a date that's behind us—let's stay current!", 422);
    exit();
}

switch ($data['data-request-type']) {
    case RequestType::Standard_Request->value:
        $check_delivery = $db->getRecord("med_deliveries", ["id" => $data['data-delivery-id']]);
        if (empty($check_delivery)) {
            echo $ms->json_response(null, "Delivery Not Found", 422);
            exit();
        }

        $reschedule_delivery = $db->updateRecord("med_deliveries", ["id" => $data['data-delivery-id'], "date_of_supply" => $data['reschedule-delivery'], "delivery_status" => DeliveryStatus::To_Deliver->value]);
        if ($reschedule_delivery > 0) {
            $db->addRecord("delivery_status_history", ["delivery_id" => $data['data-delivery-id'], "status" => DeliveryStatus::To_Deliver->value]);
            echo $ms->json_response(null, "Delivery Successfully Rescheduled");
            exit();
        }
        break;

    case RequestType::Customized_Request->value:
        $check_delivery = $db->getRecord("custom_med_deliveries", ["id" => $data['data-delivery-id']]);
        if (empty($check_delivery)) {
            echo $ms->json_response(null, "Delivery Not Found", 422);
            exit();
        }

        $reschedule_delivery = $db->updateRecord("custom_med_deliveries", ["id" => $data['data-delivery-id'], "date_of_supply" => $data['reschedule-delivery'], "delivery_status" => DeliveryStatus::To_Deliver->value]);
        if ($reschedule_delivery > 0) {
            $db->addRecord("custom_med_delivery_status_history", ["delivery_id" => $data['data-delivery-id'], "status" => DeliveryStatus::To_Deliver->value]);
            echo $ms->json_response(null, "Delivery Successfully Rescheduled");
            exit();
        }
        break;

    default:
        echo $ms->json_response(null, "Invalid Request Type", 422);
        exit();
}