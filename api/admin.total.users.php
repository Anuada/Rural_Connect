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
    $total[] = $db->count_all_records('account', ['user_type' => $user_type, 'account_status' => 'Approved']);
}

echo $ms->json_response($total, "Barangay Incharge, City Health, Delivery");