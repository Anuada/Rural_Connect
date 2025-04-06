<?php
session_start();
require_once "../shared/session.admin.php";
require_once "../admin/is.admin.authenticated.php";
require_once "../util/dbhelper.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;

$feedbacks = [];

if (isset($_GET['rating']) && !empty(trim($_GET['rating']))) {
    $feedbacks = $db->displayAllFeedbacks($_GET['rating']);
} else {
    $feedbacks = $db->displayAllFeedbacks();
}

echo $ms->json_response($feedbacks, "All Feedbacks");