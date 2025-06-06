<?php
session_start();
require_once "../util/DbHelper.php";
require_once "../util/DirHandler.php";
require_once "../util/Misc.php";
require_once "../enums/SubscriptionPlan.php";
require_once "../vendor/autoload.php";

$db = new DbHelper();
$dir = new DirHandler;
$ms = new Misc;
$plans = SubscriptionPlan::all();

use Ramsey\Uuid\Uuid;

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("Location: ../page/");
    exit();
}

if (!isset($_POST["submit"])) {
    header("Location: ../page/");
    exit();
}

$receipt_id = Uuid::uuid4();

$fieldInputs = [
    "id" => $receipt_id,
    "barangay_id" => $_SESSION["accountId"]
];

if (!isset($_POST['plan']) || !in_array($_POST['plan'], $plans)) {
    $_SESSION['m'] = "Invalid Plan!";
    header("Location: ../subscription/details.php?plan=" . $_POST['plan']);
    exit();
}

$fieldInputs['plan'] = $_POST['plan'];

if (!isset($_FILES['receipt']) || $_FILES['receipt']['size'] <= 0) {
    $_SESSION['m'] = "Receipt Is Required!";
    header("Location: ../subscription/details.php?plan=" . $_POST['plan']);
    exit();
}

$fieldInputs['receipt'] = $ms->uploadImage($_FILES['receipt'], $receipt_id, $dir->upload_receipt);

$fieldInputs['amount'] = $fieldInputs['plan'] == SubscriptionPlan::Annual->name ?
    SubscriptionPlan::Annual->value : SubscriptionPlan::Monthly->value;

$subscribe = $db->addRecord("subscription", $fieldInputs);

if ($subscribe > 0) {
    $_SESSION["m"] = "Wait for admin\'s approval for your subscription";
    header("Location: ../subscription/");
    exit();
}