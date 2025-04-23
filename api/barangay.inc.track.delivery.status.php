<?php
session_start();
require_once "../shared/session.barangay_inc.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;

$account_id = $_SESSION["accountId"];
$delivery_id = '';
$data = [];

if ((!isset($_GET['med-delivery']) || empty(trim($_GET['med-delivery']))) && (!isset($_GET['custom-med-delivery']) || empty(trim($_GET['custom-med-delivery'])))) {
    echo $ms->json_response(null, 'med delivery id or custom med delivery id is required!', 422);
    exit();
}

if (isset($_GET['med-delivery'])) {
    $delivery_id = $_GET['med-delivery'];
    $data = $db->display_track_delivery_status_on_barangay($delivery_id, $account_id);
    if (empty($data)) {
        echo $ms->json_response(null, 'Delivery Details Not Found', 404);
        exit();
    }
    echo $ms->json_response($data, 'Delivery Status History Details');
    exit();
}

$delivery_id = $_GET['custom-med-delivery'];
$data = $db->display_track_delivery_status_on_barangay_custom($delivery_id, $account_id);
if (empty($data)) {
    echo $ms->json_response(null, 'Delivery Details Not Found', 404);
    exit();
}
echo $ms->json_response($data, 'Delivery Status History Details');
exit();
