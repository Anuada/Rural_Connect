<?php
require_once "../util/DbHelper.php";
session_start();

$db = new DbHelper();

// echo $db->isBarangayRegisteredAlready("Taptap") ? "yes" : "no";