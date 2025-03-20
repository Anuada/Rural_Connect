<?php

require_once "../util/DbHelper.php";

$db = new DbHelper();

echo json_encode($db->fetchRecords("account",["accountId" => 34])[0]);