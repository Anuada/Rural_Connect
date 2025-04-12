<?php
session_start();
require_once "../shared/session.admin.php";
require_once "../admin/is.admin.authenticated.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;

$total_earnings_this_month = $db->total_earnings_this_month();

echo $ms->json_response($total_earnings_this_month, "Total Earnings This Month");