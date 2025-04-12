<?php
session_start();
require_once "../shared/session.admin.php";
require_once "../admin/is.admin.authenticated.php";
require_once "../enums/UserType.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";

$user_types = UserType::all();
$db = new DbHelper();
$ms = new Misc;

$total = [];

foreach ($user_types as $user_type) {
    $total[] = $db->count_all_records('account', ['user_type' => $user_type, 'account_status' => 'Approved'], 
    " AND DATE_FORMAT(created_at,'%Y-%m') = DATE_FORMAT(CURRENT_DATE(), '%Y-%m')");
}

$data = [
    "total" => $total,
    "month_year" => $db->get_month_year()
];

echo $ms->json_response($data, "Barangay Incharge, City Health, Delivery");