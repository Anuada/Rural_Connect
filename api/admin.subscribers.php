<?php
session_start();
require_once "../shared/session.admin.php";
require_once "../admin/is.admin.authenticated.php";
require_once "../util/dbhelper.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;

// Get page and limit from query string
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 5;
$offset = ($page - 1) * $limit;

// Get total count
$total = $db->count_all_records('subscription');
$totalPages = ceil($total / $limit);

// Fetch paginated data
$subscribers = $db->display_all_subscriptions($limit, $offset);

// Return data with pagination info
$response = [
    'data' => $subscribers,
    'pagination' => [
        'currentPage' => $page,
        'totalPages' => $totalPages,
        'totalRecords' => $total,
        'limit' => $limit
    ]
];

echo $ms->json_response($response, "All Subscribers");
