<?php
session_start();

require_once "../util/DbHelper.php";
$db = new DbHelper();

if (isset($_POST['submit'])) {
    request_med($db);
} elseif (isset($_POST['acceptRequest'])) {
    $requestId = $_POST['requestId'];
    handleAcceptRequest($db, $requestId);
} elseif (isset($_POST['cancelledRequest'])) {
    $requestId = $_POST['requestId'];
    handleCancelledRequest($db, $requestId);
}


function request_med($db)
{   $id = $_POST['id'];
    $city_health_id = $_POST['city_health_id'];
    $barangay_inc_id = $_POST['barangay_inc_id'];
    $request_quantity = $_POST['request_quantity'];
    $requestStatus = $_POST['requestStatus'];



    $table = "request_med";
    $data = array(
        "id" =>$id,
        "city_health_id" => $city_health_id,
        "barangay_inc_id" => $barangay_inc_id,
        "request_quantity" => $request_quantity,
        "requestStatus" => "Pending"

    );

    $success = $db->addRecord($table, $data);

    if ($success) {
        $_SESSION["m"] = "Request successfully";
        header("Location: ../barangay_inc/view_med.php");
        exit();
    } else {
        $_SESSION["m"] = "Error Requesting!";
        header("Location: ../barangay_inc/view_med.php");
        exit();
    }
}
function handleAcceptRequest(DbHelper $db, string $requestId)
{


    $result = $db->updateRecord("request_med", ['id' => $requestId, 'requestStatus' => 'Accept']);

    if ($result > 0) {
        $_SESSION["m"] = "Request accepted";
        header("Location: ../city_health/view_med.php");
        exit();
    } else {
        $_SESSION["m"] = "Error updating Requesting. Please try again!";
        header("Location: ../city_health/view_med.php");
        exit();
    }
}

function handleCancelledRequest(DbHelper $db, string $requestId)
{


    $result = $db->updateRecord("request_med", ['id' => $requestId, 'requestStatus' => 'Cancelled']);

    if ($result > 0) {
        $_SESSION["m"] = "Cancelled Requesting";
        header("Location: ../city_health/view_med.php");
        exit();
    } else {
        $_SESSION["m"] = "Error cancelled Requesting. Please try again!";
        header("Location: ../city_health/view_med.php");
        exit();
    }
}
