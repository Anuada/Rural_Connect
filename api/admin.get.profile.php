<?php
session_start();
require_once "../shared/session.admin.php";
require_once "../admin/is.admin.authenticated.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;

$user = $db->getRecord("admin", ["accountId" => $_SESSION["accountId"]]);

echo $ms->json_response($user, "User Found");
