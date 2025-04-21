<?php
session_start();
require_once "../util/Misc.php";
require_once "../util/DbHelper.php";
require_once "../util/DirHandler.php";

$db = new DbHelper();
$ms = new Misc();
$dir = new DirHandler();

if (isset($_POST['submitRequest'])) {
    request_med($db, $ms, $dir);
} elseif (isset($_POST['customRequest'])) {
    custom_med_request($db, $ms, $dir);
}

function request_med(DbHelper $db, Misc $ms, DirHandler $dir)
{
    $barangay_inc_id = $_POST['barangay_inc_id'];
    $med_avail_id = $_POST['med_avail_id'];
    $request_quantity = (int) $_POST['request_quantity'];

    $med_avail = $db->getRecord('med_availability', ['id' => $med_avail_id]);
    $limit = (int) ($med_avail['quantity'] * 0.20);

    if ($request_quantity <= 0) {
        $_SESSION["m"] = "Please select quantity!";
        header("Location: ../barangay_inc/request_med.php?id=$med_avail_id");
        exit();
    }

    if ($request_quantity > $limit) {
        $_SESSION["m"] = "You've requested more than the allowed amount of this medicine!";
        header("Location: ../barangay_inc/request_med.php?id=$med_avail_id");
        exit();
    }

    if (!isset($_FILES["document"]) || $_FILES["document"]["size"] <= 0) {
        $_SESSION["m"] = "Please upload a valid document!";
        header("Location: ../barangay_inc/request_med.php?id=$med_avail_id");
        exit();
    }


    $table = "request_med";
    $data = [
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
        header("Location: ../barangay_inc/request_med.php?id=$med_avail_id");
        exit();
    }
}

function custom_med_request(DbHelper $db, Misc $ms, DirHandler $dir)
{
    $formInputs = [
        "barangay_inc_id" => $_SESSION["accountId"]
    ];

    $errorMessages = [];

    foreach ($_POST as $key => $value) {
        if ($key !== "customRequest" && empty(trim($value))) {
            $_key = str_replace("_"," ", $key);
            $errorMessages[$key] = "$_key is required.";
        }
    }

    if (!empty($errorMessages)) {
        $_SESSION['errorMessages'] = $errorMessages;
        $_SESSION['formFields'] = $_POST;
        header("Location: ../barangay_inc/custom-med-request.php");
        exit();
    }

    $requested_quantity = (int) $_POST['requested_quantity'];
    if ($requested_quantity <= 0) {
        $errorMessages["requested_quantity"] = "Please select quantity!";
        $_SESSION['errorMessages'] = $errorMessages;
        $_SESSION['formFields'] = $_POST;
        header("Location: ../barangay_inc/custom-med-request.php");
        exit();
    }

    if (!isset($_FILES["document"]) || $_FILES["document"]["size"] <= 0) {
        $errorMessages["document"] = "Please upload a valid document!";
        $_SESSION['errorMessages'] = $errorMessages;
        $_SESSION['formFields'] = $_POST;
        header("Location: ../barangay_inc/custom-med-request.php");
        exit();
    }

    foreach ($_POST as $key => $value) {
        if ($key !== "customRequest") {
            $formInputs[$key] = $value;
        }
    }

    $formInputs['document'] = $ms->uploadImage($_FILES["document"], $ms->generateUUID(), $dir->upload_document);

    $createRequest = $db->addRecord("custom_med_request", $formInputs);
    if ($createRequest > 0) {
        $_SESSION["m"] = "Request successfully";
        header("Location: ../barangay_inc/custom-med-request.php");
        exit();
    } else {
        $_SESSION["m"] = "Error Requesting!";
        header("Location: ../barangay_inc/custom-med-request.php");
        exit();
    }
}