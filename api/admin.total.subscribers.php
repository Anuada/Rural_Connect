<?php
session_start();
require_once "../shared/session.admin.php";
require_once "../admin/is.admin.authenticated.php";
require_once "../enums/SubscriptionPlan.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";

$plans = SubscriptionPlan::all();
$db = new DbHelper();
$ms = new Misc;

$total = [];

foreach ($plans as $plan) {
    $total[] = $db->count_all_subscribers_per_plan($plan);
}

echo $ms->json_response($total, "Annual Subscribers, Monthly Subscribers");