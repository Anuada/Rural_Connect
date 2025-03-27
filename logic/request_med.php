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
    $request_quantity = $_POST['request_quantity'];
    $request_category = $_POST['request_category'];
    $request_DosageForm = $_POST['request_DosageForm'];
    $request_DosageStrength = $_POST['request_DosageStrength'];
    $upload_receipt = $_FILES['upload_receipt'];

    if (!isset($_FILES["upload_receipt"]) && $_FILES['upload_receipt']['size'] == 0) {
        $_SESSION["m"] = "Please Upload Your Receipt!";
        header("Location: ../barangay_inc/request_med.php?city_health_id=$city_health_id&id=$med_avail_id");
        exit();
    }

    $receipt_uploaded = $ms->uploadImage($upload_receipt, $ms->generateUUID(), $dir->upload_receipt);
    $table = "request_med";
    $data = array(
        "city_health_id" => $city_health_id,
        "barangay_inc_id" => $barangay_inc_id,
        "med_avail_id" => $med_avail_id,
        "request_quantity" => $request_quantity,
        "request_category" => $request_category,
        "request_DosageForm" => $request_DosageForm,
        "request_DosageStrength" => $request_DosageStrength,
        "receipt_image" => $receipt_uploaded,

    );

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
    // Update the request status to 'Accepted'
    $result = $db->updateRecord("request_med", ['id' => $requestId, 'requestStatus' => 'Accepted']);

    if ($result > 0) {
        $_SESSION["m"] = "Request accepted";
        // Redirect to the select delivery date page with the request ID
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
    // Update only the specific record where the ID matches
    $result = $db->updateRecord("request_med", ['id' => $requestId, 'requestStatus' => 'Cancelled']);

    if ($result > 0) {
        $_SESSION["m"] = "Request Cancelled";
    } else {
        $_SESSION["m"] = "Error updating request. Please try again!";
    }
    header("Location: ../city_health/request_med.php");
    exit();
}
