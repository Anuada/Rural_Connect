<?php
session_start();
require_once "../shared/session.admin.php";
require_once "../admin/is.admin.authenticated.php";
require_once "../util/dbhelper.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;

$total_ratings = [];

for ($i = 1; $i < 6; $i++) {
    $total_ratings[] = (int) $db->countRatings($i);
}

echo $ms->json_response($total_ratings, "Number of Ratings");