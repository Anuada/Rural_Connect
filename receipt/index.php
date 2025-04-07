<?php
session_start();
require_once "../util/ReceiptGenerator.php";
require_once "../util/dbhelper.php";

$db = new DbHelper();

$id = $_GET['id'];

if (!isset($_GET['id']) || empty(trim($_GET['id']))) {
    $_SESSION['m'] = "ID Is Required!";
    header("Location:../page/");
    exit();
}

$check = $db->getRecord("subscription", ["id" => $id]);

if (empty($check) || $check['approve_status'] == 'Pending' || $check['approve_status'] == 'Cancelled') {
    $_SESSION['m'] = "Invalid ID!";
    header("Location:../page/");
    exit();
}

$receipt = new ReceiptGenerator();
$data = (object) $db->display_details_for_receipt($id);

$user_email = $data->email;
$receipt_no = $data->id;
$date = date("Y-m-d", strtotime($data->created_at));
$plan = $data->plan;
$start_date = $data->start_date;
$end_date = $data->end_date;
$amount = $data->amount;

$receipt->generateReceipt($user_email, $receipt_no, $date, $plan, $start_date, $end_date, $amount);