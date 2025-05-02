<?php
session_start();
require_once "../shared/session.delivery.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;

$accountId = $_SESSION["accountId"];

$account_detail = $db->getRecord('deliveries', ['accountId' => $accountId]);

$availability_status = $account_detail['availability_status'];

echo $ms->json_response($availability_status, 'Availability Status');