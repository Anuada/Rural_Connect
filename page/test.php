<?php
require_once "../util/Misc.php";
require_once "../util/DbHelper.php";
require_once "../enums/SubscriptionPlan.php";
session_start();

$ms = new Misc;
// $db = new DbHelper();
// $subscription_plans = SubscriptionPlan::all();

// echo json_encode($db->DisplayMed_to_Delivery($_SESSION['accountId']));
// echo $_SESSION['accountId'];

// foreach ($subscription_plans as $plan) {
//     echo "$plan <br>";
// }

// echo $ms->url("city_health/uploadMedEdit.php?id=19");
