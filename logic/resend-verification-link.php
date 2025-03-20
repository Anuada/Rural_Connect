<?php
session_start();
require_once "../util/DbHelper.php";
require_once "../util/EmailSender.php";
require_once "../vendor/autoload.php";

use Ramsey\Uuid\Uuid;

$db = new DbHelper();
$em = new EmailSender();

if (isset($_POST['accountId'])) {
    $email = $_SESSION["email"];
    $accountId = $_POST['accountId'];
    $verificationToken = Uuid::uuid4();
    $username = $_SESSION["username"];

    $db->updateRecord('account', ['accountId' => $accountId, 'verify_token' => $verificationToken]);
    $em->requestAccountVerification($email, $accountId, $username, $verificationToken);
    $_SESSION["m"] = "Check your email for verification";
    header("Location: ../shared/resend-verification-link.php");
} else {
    header("Location: ../page/");
    exit();
}