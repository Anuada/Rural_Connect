<?php
session_start();
require_once "../util/DbHelper.php";
require_once "../enums/UserType.php";
require_once "../enums/RequestType.php";
require_once "../enums/DeliveryStatus.php";
require_once "../enums/DeliveryCondition.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;

if (!isset($_SESSION['accountId'])) {
    echo $ms->json_response(null, "Unauthorized Access", 401);
    exit();
}

if ($_SESSION["user_type"] != UserType::barangay_inc->value && $_SESSION["user_type"] != UserType::city_health->value) {
    echo $ms->json_response(null, "Unauthorized Access", 401);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] != 'PUT') {
    echo $ms->json_response(null, "Method Not Allowed", 405);
    exit();
}

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$errorFields = [];

foreach ($data as $key => $value) {
    if ($key != 'feedback' && $key != 'delivery_condition' && empty(trim($value))) {
        $errorFields[] = str_replace("_", " ", $key);
    }
}

if (!empty($errorFields)) {
    $message = $ms->formatListWithOxfordComma($errorFields) . (count($errorFields) > 1 ? " are" : " is") . " required";
    echo $ms->json_response(null, $message, 422);
    exit();
}

switch ($data['delivery_status']) {
    case DeliveryStatus::Claimed->value:
        if (!in_array($data['delivery_condition'], DeliveryCondition::all())) {
            echo $ms->json_response(null, "Invalid Delivery Condition", 422);
            exit();
        }
        switch ($data['request_type']) {
            case RequestType::Standard_Request->value:
                $check = $db->getRecord('med_deliveries', ['id' => $data['delivery_id']]);
                if (empty($check)) {
                    echo $ms->json_response(null, "delivery not found", 422);
                    exit();
                }

                $claimed = $db->updateRecord('med_deliveries', ['id' => $data['delivery_id'], 'delivery_status' => DeliveryStatus::Claimed->value]);
                if ($claimed > 0) {
                    $db->addRecord('delivery_status_history', ['delivery_id' => $data['delivery_id'], 'status' => DeliveryStatus::Claimed->value]);
                    $db->addRecord('med_deliveries_feedback', [
                        'med_delivery_id' => $data['delivery_id'],
                        'delivery_condition' => $data['delivery_condition'],
                        'feedback' => $data['feedback']
                    ]);
                    echo $ms->json_response(null, "Medicine successfully claimed and delivery feedback sent");
                    exit();
                }
                break;

            case RequestType::Customized_Request->value:
                $check = $db->getRecord('custom_med_deliveries', ['id' => $data['delivery_id']]);
                if (empty($check)) {
                    echo $ms->json_response(null, "delivery not found", 422);
                    exit();
                }

                $claimed = $db->updateRecord('custom_med_deliveries', ['id' => $data['delivery_id'], 'delivery_status' => DeliveryStatus::Claimed->value]);
                if ($claimed > 0) {
                    $db->addRecord('custom_med_delivery_status_history', ['delivery_id' => $data['delivery_id'], 'status' => DeliveryStatus::Claimed->value]);
                    $db->addRecord('custom_med_deliveries_feedback', [
                        'med_delivery_id' => $data['delivery_id'],
                        'delivery_condition' => $data['delivery_condition'],
                        'feedback' => $data['feedback']
                    ]);
                    echo $ms->json_response(null, "Medicine successfully claimed and delivery feedback sent");
                    exit();
                }
                break;

            default:
                echo $ms->json_response(null, "Invalid Request Type", 422);
                exit();
        }
        break;

    case DeliveryStatus::Returned->value:
        switch ($data['request_type']) {
            case RequestType::Standard_Request->value:
                $check = $db->getRecord('med_deliveries', ['id' => $data['delivery_id']]);
                if (empty($check)) {
                    echo $ms->json_response(null, "delivery not found", 422);
                    exit();
                }
                $request_med_detail = $db->getRecord('request_med', ['id' => $check['request_med_id']]);
                $medicine_detail = $db->getRecord('med_availability', ['id' => $request_med_detail['med_avail_Id']]);

                $requested_quantity = (int) $request_med_detail['request_quantity'];
                $original_stocks = (int) $medicine_detail['quantity'];
                $new_total_stocks = $original_stocks + $requested_quantity;

                $failed_delivery_count = $db->count_all_records('delivery_status_history', ['delivery_id' => $data['delivery_id'], 'status' => DeliveryStatus::Failed_Delivery->value]);
                if ($failed_delivery_count < 3) {
                    echo $ms->json_response(null, "There have only been $failed_delivery_count failed delivery attempts so far; it has not yet reached three or more.", 422);
                    exit();
                }

                $returned = $db->updateRecord('med_deliveries', ['id' => $data['delivery_id'], 'delivery_status' => DeliveryStatus::Returned->value]);
                if ($returned > 0) {
                    $db->updateRecord('med_availability', ['id' => $request_med_detail['med_avail_Id'], 'quantity' => $new_total_stocks]);
                    $db->addRecord('delivery_status_history', ['delivery_id' => $data['delivery_id'], 'status' => DeliveryStatus::Returned->value]);
                    echo $ms->json_response(null, "Medicine successfully returned");
                    exit();
                }

            case RequestType::Customized_Request->value:
                $check = $db->getRecord('custom_med_deliveries', ['id' => $data['delivery_id']]);
                if (empty($check)) {
                    echo $ms->json_response(null, "delivery not found", 422);
                    exit();
                }

                $failed_delivery_count = $db->count_all_records('custom_med_delivery_status_history', ['delivery_id' => $data['delivery_id'], 'status' => DeliveryStatus::Failed_Delivery->value]);
                if ($failed_delivery_count < 3) {
                    echo $ms->json_response(null, "There have only been $failed_delivery_count failed delivery attempts so far; it has not yet reached three or more.", 422);
                    exit();
                }

                $returned = $db->updateRecord('custom_med_deliveries', ['id' => $data['delivery_id'], 'delivery_status' => DeliveryStatus::Returned->value]);
                if ($returned > 0) {
                    $db->addRecord('custom_med_delivery_status_history', ['delivery_id' => $data['delivery_id'], 'status' => DeliveryStatus::Returned->value]);
                    echo $ms->json_response(null, "Medicine successfully returned");
                    exit();
                }
                break;
            default:
                echo $ms->json_response(null, "Invalid Request Type", 422);
                exit();
        }

    default:
        echo $ms->json_response(null, "Invalid Status", 422);
        exit();
}