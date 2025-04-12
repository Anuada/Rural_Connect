<?php
session_start();
require_once "../shared/session.admin.php";
require_once "../admin/is.admin.authenticated.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;

$pending_accounts = $db->count_all_records('account', ['account_status' => 'Pending']);

$pending_subscribers = $db->count_all_records('subscription', ['approve_status' => 'Pending']);

$pendings = [
    'accounts' => $pending_accounts,
    'subscribers' => $pending_subscribers
];

echo $ms->json_response($pendings, "Pending Accounts, Pending Subscribers");