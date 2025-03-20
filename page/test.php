<?php

require_once "../util/DbHelper.php";
session_start();
$db = new DbHelper();

echo json_encode($db->barangayRequested_med($_SESSION['accountId']));
