<?php
session_start();
require_once "../shared/session.barangay_inc.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;

$account_id = $_SESSION["accountId"];

// Get page and limit from query string
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 5;
$offset = ($page - 1) * $limit;

$total = $db->count_all_records('request_med', ['barangay_inc_id' => $account_id]);
$totalPages = ceil($total / $limit);

$data = $db->display_barangay_inc_request_med($account_id, $limit, $offset);

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