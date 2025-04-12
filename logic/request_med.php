<?php
session_start();
require_once "../util/Misc.php";
require_once "../util/DbHelper.php";
require_once "../util/DirHandler.php";

$db = new DbHelper();
$ms = new Misc();
$dir = new DirHandler();

if (isset($_POST['submit'])) {
    request_med($db, $ms, $dir);
} elseif (isset($_POST['acceptRequest'])) {
    $requestId = $_POST['requestId'];
    handleAcceptRequest($db, $requestId);
} elseif (isset($_POST['cancelledRequest'])) {
    $requestId = $_POST['requestId'];
    handleCancelledRequest($db, $requestId);
}

function request_med(DbHelper $db, Misc $ms, DirHandler $dir)
{
    $city_health_id = $_POST['city_health_id'];
    $barangay_inc_id = $_POST['barangay_inc_id'];
    $med_avail_id = $_POST['med_avail_id'];
    $request_quantity = (int) $_POST['request_quantity'];

    $med_avail = $db->getRecord('med_availability', ['id' => $med_avail_id]);
    $limit = (int) ($med_avail['quantity'] * 0.20);

    if ($request_quantity > $limit) {
        $_SESSION["m"] = "You've requested more than the allowed amount of this medicine!";
        header("Location: ../barangay_inc/request_med.php?city_health_id=$city_health_id&id=$med_avail_id");
        exit();
    }

    $table = "request_med";
    $data = [
        "city_health_id" => $city_health_id,
        "barangay_inc_id" => $barangay_inc_id,
        "med_avail_id" => $med_avail_id,
        "request_quantity" => $request_quantity,
        "document" => $ms->uploadImage($_FILES["document"], $ms->generateUUID(), $dir->upload_document)
    ];

    $success = $db->addRecord($table, $data);

    if ($success) {
        $_SESSION["m"] = "Request successfully";
        header("Location: ../barangay_inc/view_med.php");
        exit();
    } else {
        $_SESSION["m"] = "Error Requesting!";
        header("Location: ../barangay_inc/request_med.php?city_health_id=$city_health_id&id=$med_avail_id");
        exit();
    }
}

function handleAcceptRequest(DbHelper $db, string $requestId)
{
    $requested_med = $db->getRecord("request_med", ['id' => $requestId]);
    $med_avail = $db->getRecord('med_availability', ['id' => $requested_med['med_avail_Id']]);
    $new_total_quantity = (int) $med_avail['quantity'] - (int) $requested_med['request_quantity'];
    $db->updateRecord('med_availability', ['id' => $requested_med['med_avail_Id'], 'quantity' => $new_total_quantity]);
    $result = $db->updateRecord("request_med", ['id' => $requestId, 'requestStatus' => 'Accepted']);

    if ($result > 0) {
        $_SESSION["m"] = "Request accepted";
        header("Location: ../city_health/select_date_req.php?requestId=" . $requestId);
        exit();
    } else {
        $_SESSION["m"] = "Error updating request. Please try again!";
        header("Location: ../city_health/select_date_req.php");
        exit();
    }
}

function handleCancelledRequest(DbHelper $db, string $requestId)
{
    $result = $db->updateRecord("request_med", ['id' => $requestId, 'requestStatus' => 'Cancelled']);

    if ($result > 0) {
        $_SESSION["m"] = "Request Cancelled";
    } else {
        $_SESSION["m"] = "Error updating request. Please try again!";
    }
    header("Location: ../city_health/request_med.php");
    exit();
}
