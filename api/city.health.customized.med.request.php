<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;

// Get page and limit from query string
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 5;
$offset = ($page - 1) * $limit;

$total = $db->count_all_records('custom_med_request');
$totalPages = ceil($total / $limit);

$data = $db->display_barangay_inc_customized_requests($limit, $offset);

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