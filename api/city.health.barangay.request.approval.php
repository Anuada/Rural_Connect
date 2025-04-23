<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";
require_once "../enums/RequestStatus.php";
require_once "../vendor/autoload.php";

use Ramsey\Uuid\Uuid;

$db = new DbHelper();
$ms = new Misc;
$request_statuses = RequestStatus::all();

if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    echo $ms->json_response(null, 'Method Not Allowed', 405);
    exit();
}

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$main_fields = ['request_type', 'status', 'barangay_request_id'];
$error_main_fields = [];

foreach ($main_fields as $field) {
    if (!isset($data[$field]) || empty(trim($data[$field]))) {
        $error_main_fields[] = str_replace("_", " ", $field);
    }
}

if (!empty($error_main_fields)) {
    $message = strtolower($ms->formatListWithOxfordComma($error_main_fields)) . (count($error_main_fields) > 1 ? " are required!" : " is required!");
    echo $ms->json_response(null, $message, 422);
    exit();
}

if (!in_array($data['status'], $request_statuses)) {
    echo $ms->json_response(null, "invalid status!", 422);
    exit();
}

switch ($data['request_type']) {
    case 'default request':
        $check = $db->getRecord('request_med', ['id' => $data['barangay_request_id']]);
        if (empty($check)) {
            echo $ms->json_response(null, "request id not found!", 422);
            exit();
        }

        if ($data['status'] == RequestStatus::Accepted->value) {
            $dateOfSupply = (new DateTime($data['date_of_supply']))->setTime(0, 0, 0);
            $today = (new DateTime())->setTime(0, 0, 0);

            if ($dateOfSupply < $today) {
                echo $ms->json_response(null, "Looks like you picked a date that's behind us—let's stay current!", 422);
                exit();
            }

            $d = ["id" => $data['barangay_request_id'], "requestStatus" => $data['status']];

            $db->updateRecord('request_med', $d);

            $delivery_id = Uuid::uuid4();

            $e = ["id" => $delivery_id, "request_med_id" => $data['barangay_request_id'], "deliveries_accountId" => $data['delivery_id'], "date_of_supply" => $data['date_of_supply']];

            $db->addRecord('med_deliveries', $e);

            $db->addRecord("delivery_status_history", ["delivery_id" => $delivery_id]);

            echo $ms->json_response(null, "Request successfully " . strtolower($data['status']));
            exit();
        }

        $d = ["id" => $data['barangay_request_id'], "requestStatus" => $data['status']];
        $db->updateRecord('request_med', $d);
        echo $ms->json_response(null, "Request successfully " . strtolower($data['status']));
        exit();

    case 'customized request':
        $check = $db->getRecord('custom_med_request', ['id' => $data['barangay_request_id']]);
        if (empty($check)) {
            echo $ms->json_response(null, "request id not found!", 422);
            exit();
        }

        if ($data['status'] == RequestStatus::Accepted->value) {
            $dateOfSupply = (new DateTime($data['date_of_supply']))->setTime(0, 0, 0);
            $today = (new DateTime())->setTime(0, 0, 0);

            if ($dateOfSupply < $today) {
                echo $ms->json_response(null, "Looks like you picked a date that's behind us—let's stay current!", 422);
                exit();
            }

            $d = ["id" => $data['barangay_request_id'], "request_status" => $data['status']];

            $db->updateRecord('custom_med_request', $d);

            $delivery_id = Uuid::uuid4();

            $e = ["id" => $delivery_id, "custom_med_request_id" => $data['barangay_request_id'], "delivery_account_id" => $data['delivery_id'], "date_of_supply" => $data['date_of_supply']];

            $db->addRecord('custom_med_deliveries', $e);

            $db->addRecord("custom_med_delivery_status_history", ["delivery_id" => $delivery_id]);

            echo $ms->json_response(null, "Request successfully " . strtolower($data['status']));
            exit();
        }

        $d = ["id" => $data['barangay_request_id'], "request_status" => $data['status']];
        $db->updateRecord('custom_med_request', $d);
        echo $ms->json_response(null, "Request successfully " . strtolower($data['status']));
        exit();

    default:
        echo $ms->json_response(null, "invalid request type!", 422);
        exit();
}