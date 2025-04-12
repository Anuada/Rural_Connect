<?php
session_start();
require_once "../shared/session.admin.php";
require_once "../admin/is.admin.authenticated.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";
require_once "../enums/UserType.php";
require_once "../enums/ApproveStatus.php";

$db = new DbHelper();
$ms = new Misc;
$user_types = UserType::all();
$approve_statuses = ApproveStatus::all();

$variables = ['user_type', 'approve_status'];
$errorMessages = [];

foreach ($variables as $v) {
    if (!isset($_GET[$v]) || empty(trim($_GET[$v]))) {
        $var = str_replace("_", " ", $v);
        $errorMessages[] = "$var is required";
    }
}

if (!empty($errorMessages)) {
    $em = implode(" and ", $errorMessages);
    echo $ms->json_response(null, $em, 422);
    exit();
}

$user_type = $_GET['user_type'];
$approve_status = $_GET['approve_status'];

if (!in_array($user_type, $user_types)) {
    echo $ms->json_response(null, "invalid user type", 422);
    exit();
}

if (!in_array($approve_status, $approve_statuses)) {
    echo $ms->json_response(null, "invalid approve status", 422);
    exit();
}

// Get page and limit from query string
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 5;
$offset = ($page - 1) * $limit;

// Get total count
$total = $db->count_all_records('account', ['user_type' => $user_type, 'account_status' => $approve_status, 'isVerify' => 1]);
$totalPages = ceil($total / $limit);

// Get data
$data = $db->display_all_accounts($user_type, ["account_status" => $approve_status, 'isVerify' => 1], $limit, $offset);

// Return data with pagination info
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