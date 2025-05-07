<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";
require_once "../enums/RequestType.php";

$db = new DbHelper();
$ms = new Misc;

$parameters = ['request_type', 'delivery_id'];

$error_fields = [];

foreach ($parameters as $param) {
    if (!isset($_GET[$param]) || empty(trim($_GET[$param]))) {
        $error_fields[] = str_replace("_", " ", $param);
    }
}

if (!empty($error_fields)) {
    $message = implode(" and ", $error_fields) . (count($error_fields) > 1 ? " are" : " is") . " required.";
    echo $ms->json_response(null, $message, 422);
    exit();
}

$request_type = $_GET['request_type'];
$delivery_id = $_GET['delivery_id'];


switch ($request_type) {
    case RequestType::Standard_Request->value:
        $data = $db->display_total_partially_claimed("standard_total_partially_claimed", ["delivery_id" => $delivery_id]);
        if (empty($data)) {
            echo $ms->json_response(null, "Data Not Found", 422);
            exit();
        }
        echo $ms->json_response((int) $data["total_partially_claimed"], "total partially claimed");
        exit();

    case RequestType::Customized_Request->value:
        $data = $db->display_total_partially_claimed("custom_total_partially_claimed", ["delivery_id" => $delivery_id]);
        if (empty($data)) {
            echo $ms->json_response(null, "Data Not Found", 422);
            exit();
        }
        echo $ms->json_response((int) $data["total_partially_claimed"], "total partially claimed");
        exit();

    default:
        echo $ms->json_response(null, "Invalid Request Type", 422);
        exit();
}