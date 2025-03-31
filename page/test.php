<?php

require_once "../util/DbHelper.php";
session_start();
$db = new DbHelper();

echo json_encode($db->DisplayMed_to_Delivery($_SESSION['accountId']));
echo $_SESSION['accountId'];
