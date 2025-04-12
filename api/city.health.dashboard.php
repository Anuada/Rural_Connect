<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;

$pendingCount = $db->countPending();
$acceptedCount = $db->countAccempted();
$cancelledCount = $db->countCancelled();

$data = [$pendingCount, $acceptedCount, $cancelledCount];

echo $ms->json_response($data, "Requests");