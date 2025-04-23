<?php
session_start();
require_once "../shared/session.delivery.php";
require_once "../enums/DeliveryStatus.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;

$account_id = $_SESSION["accountId"];

// Get page and limit from query string
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 5;
$offset = ($page - 1) * $limit;

$total = $db->count_all_records('med_deliveries', ['deliveries_accountId' => $account_id]);
$totalPages = ceil($total / $limit);

$delivery_status = $_GET['delivery_status'] ?? DeliveryStatus::Claimed->value;
$status_not_equal = isset($_GET['not_equal']) ? (bool) $_GET['not_equal'] : true;

$data = $db->display_medicine_requests_to_deliver($account_id, $limit, $offset, null, $delivery_status, $status_not_equal);

$response = [
    'data' => $data,
    'pagination' => [
        'currentPage' => $page,
        'totalPages' => $totalPages,
        'totalRecords' => $total,
        'limit' => $limit
    ]
];

echo $ms->json_response($response, "All Data");