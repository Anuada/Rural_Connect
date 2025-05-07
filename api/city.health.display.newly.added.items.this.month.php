<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;

$data = $db->display_newly_added_items_this_month();

echo $ms->json_response($data, "Newly Added Items This Month");
exit();