<?php
session_start();
require_once "../util/DbHelper.php";

$db = new DbHelper();

if (isset($_POST['submit'])) {
    $requestId = $_POST['requestId'];
    $deliveryDate = $_POST['med_date'];

    // Update the request_med table with the selected delivery date
    $result = $db->updateRecord("request_med", ['id' => $requestId, 'delivery_date' => $deliveryDate]);

    if ($result > 0) {
        $_SESSION["m"] = "Delivery date set successfully";
        header("Location: ../city_health/request_med.php");
        exit();
    } else {
        $_SESSION["m"] = "Error setting delivery date.!";
        header("Location: ../city_health/select_date_req.php?requestId=" . $requestId);
        exit();
    }
}
?>
