<?php
session_start();

require_once "../util/DbHelper.php";
require_once "../util/EmailSender.php";
require_once "../vendor/autoload.php";

use Ramsey\Uuid\Uuid;

$db = new DbHelper();
$es = new EmailSender();

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    if (!empty(trim($email))) {
        $check_account = $db->fetchRecords("account", ["email" => $email]);
        if ($check_account != null) {
            $recovery_token = Uuid::uuid4();
            $account = $db->fetchRecords("account", ["email" => $email]);
            $accountId = $account[0]["accountId"];
            $username = $account[0]["username"];
            $token = $recovery_token;
            $es->requestPasswordReset($email, $accountId, $username, $token);
            $db->updateRecord("account", ["accountId" => $check_account[0]["accountId"], "recovery_token" => $recovery_token]);
            $_SESSION["m"] = "Check your email";
            header("Location: ../page/forgot-password.php");
            exit();
        } else {
            $_SESSION["m"] = "Email does not exist!";
            header("Location: ../page/forgot-password.php");
            exit();
        }
    } else {
        $_SESSION["m"] = "Input your email!";
        header("Location: ../page/forgot-password.php");
        exit();
    }
} else {
    header("Location: ../page/forgot-password.php");
    exit();
}