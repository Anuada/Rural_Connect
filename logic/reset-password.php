<?php
session_start();
require_once "../util/DbHelper.php";

$db = new DbHelper();

if (isset($_POST["submit"])) {
    $accountId = $_POST["accountId"];
    $token = $_POST["token"];
    $password = $_POST["password"];
    $re_password = $_POST["re-password"];

    $check_acc_token_exist = $db->fetchRecords("account", ["accountId" => $accountId, "recovery_token" => $token]);
    $path = "../page/reset-password.php?accountId=" . $accountId . "&token=" . $token;
    if ($check_acc_token_exist) {
        if (!empty(trim($password)) && !empty(trim($re_password))) {
            if ($password === $re_password) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $change_pass = $db->updateRecord("account", ["accountId" => $accountId, "password" => $password, "recovery_token" => null]);
                if ($change_pass > 0) {
                    $_SESSION["m"] = "Successfully Changed Password";
                    header("Location: ../page/login.php");
                    exit();
                } else {
                    $_SESSION["m"] = "Error Changing Password!";
                    header("Location: " . $path);
                    exit();
                }
            } else {
                $_SESSION["m"] = "Passwords Not Match!";
                header("Location: " . $path);
                exit();
            }
        } else {
            $_SESSION["m"] = "Fill out the missing fields!";
            header("Location: " . $path);
            exit();
        }
    } else {
        $_SESSION["m"] = "Token Not Found!";
        header("Location: ../page/");
        exit();
    }
}