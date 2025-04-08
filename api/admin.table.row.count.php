<?php
session_start();
require_once "../shared/session.admin.php";
require_once "../admin/is.admin.authenticated.php";
require_once "../util/dbhelper.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;

if (!isset($_GET['table']) || empty(trim($_GET['table']))) {
    echo $ms->json_response(null, "table is required", 422);
    exit();
}

$table = $_GET['table'];

$count = $db->count_all_records($table);

echo $ms->json_response($count, "$table count");
exit();