<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;

$couriers = $db->fetchDeliveries();

echo $ms->json_response($couriers, 'All Available Couriers');
exit();