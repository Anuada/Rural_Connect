<?php
session_start();
require_once "../shared/session.delivery.php";
require_once "../enums/DeliveryStatus.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: " . $ms->url('deliveries'));
    exit();
}

$errorCount = 0;
$delivery_table = '';
$delivery_history_table = '';
$delivery_statuses = array_values(array_filter(DeliveryStatus::all(), function ($status) {
    return $status != DeliveryStatus::Claimed->value && $status != DeliveryStatus::Returned->value;
}));

foreach ($_POST as $key => $value) {
    if (empty(trim($value))) {
        $errorCount++;
    }
}

if ($errorCount > 0) {
    $_SESSION['m'] = 'Fill out the missing fields!';
    header("Location: " . $ms->url('deliveries/delivery-details.php?' . $_POST['request-type'] . '=' . $_POST['id']));
    exit();
}

$requestType = $_POST['request-type'];
unset($_POST['request-type']);

switch ($requestType) {
    case 'med-delivery':
        $delivery_table = 'med_deliveries';
        $delivery_history_table = 'delivery_status_history';
        break;

    case 'custom-med-delivery':
        $delivery_table = 'custom_med_deliveries';
        $delivery_history_table = 'custom_med_delivery_status_history';
        break;

    default:
        header("Location: " . $ms->url('deliveries/delivery-details.php?' . $requestType . '=' . $_POST['id']));
        exit();
}

$check = $db->getRecord($delivery_table, ['id' => $_POST['id']]);

if (empty($check)) {
    header("Location: " . $ms->url('deliveries/delivery-details.php?' . $requestType . '=' . $_POST['id']));
    exit();
}


$updateStatus = $db->updateRecord($delivery_table, $_POST);

if ($updateStatus > 0) {
    $add_delivery_history = $db->addRecord($delivery_history_table, ['delivery_id' => $_POST['id'], 'status' => $_POST['delivery_status']]);
    if ($add_delivery_history > 0) {
        $_SESSION['m'] = "Status updated successfully";
        header("Location: " . $ms->url('deliveries/delivery-details.php?' . $requestType . '=' . $_POST['id']));
        exit();
    } else {
        header("Location: " . $ms->url('deliveries/delivery-details.php?' . $requestType . '=' . $_POST['id']));
        exit();
    }
} else {
    header("Location: " . $ms->url('deliveries/delivery-details.php?' . $requestType . '=' . $_POST['id']));
    exit();
}