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

$name = "$data->fname $data->lname";
$user_email = $data->email;
$barangay = $data->barangay;
$receipt_no = $data->id;
$date = date("m/d/Y", strtotime($data->created_at));
$plan = $data->plan;
$start_date = date("m/d/Y", strtotime($data->start_date));
$end_date = date("m/d/Y", strtotime($data->end_date));
$amount = $data->amount;

$receipt->generateReceipt($name, $user_email, $barangay, $receipt_no, $date, $plan, $start_date, $end_date, $amount);