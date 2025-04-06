<?php
session_start();

require_once "../util/DbHelper.php";
require_once "../util/EmailSender.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$es = new EmailSender();
$ms = new Misc;

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (!empty(trim($username)) && !empty(trim($password))) {
        $account = $db->fetchRecords("account", ["username" => $username]);
        if ($account != null) {
            if (password_verify($password, $account[0]["password"])) {
                $db->updateRecord("account", ["accountId" => $account[0]["accountId"], "isLogin" => "1"]);

                $_SESSION["accountId"] = $account[0]["accountId"];
                $_SESSION["email"] = $account[0]["email"];
                $_SESSION["username"] = $account[0]["username"];
                $_SESSION["user_type"] = $account[0]["user_type"];

                switch ($account[0]["user_type"]) {
                    case 'barangay_inc':
                        $barangay_inc = $db->fetchRecords("barangay_inc", ["accountId" => $account[0]["accountId"]]);
                        $_SESSION["m"] = "Welcome " . $barangay_inc[0]["fname"] . " " . $students[0]["lname"];
                        header("Location: ../barangay_inc/");
                        break;

                    case 'city_health':
                        $city_health = $db->fetchRecords("city_health", ["accountId" => $account[0]["accountId"]]);
                        $_SESSION["m"] = "Welcome " . $city_health[0]["fname"] . " " . $city_health[0]["lname"];
                        header("Location: ../city_health/");
                        break;

                    case 'deliveries':
                        $deliveries = $db->fetchRecords("deliveries", ["accountId" => $account[0]["accountId"]]);
                        $_SESSION["m"] = "Welcome " . $deliveries[0]["fname"] . " " . $deliveries[0]["lname"];
                        header("Location: ../deliveries/");
                        break;

                    case 'admin':
                        $authentication_code = $ms->generateRandomNumbers();
                        $es->requestAdminAuthentication($account[0]["email"], $account[0]["username"], $authentication_code);
                        $db->updateRecord("admin_auth_tokens", ["admin_Id" => $account[0]["accountId"], "auth_token" => $authentication_code]);
                        $_SESSION["m"] = "Check your email for authentication code";
                        header("Location: ../admin/");
                        break;

                    default:
                        break;
                }
            } else {
                $_SESSION["m"] = "Invalid password!";
                $_SESSION["username"] = $username;
                header("Location: ../page/login.php");
                exit();
            }
        } else {
            $_SESSION["m"] = "Invalid username!";
            $_SESSION["username"] = $username;
            header("Location: ../page/login.php");
            exit();
        }
    } else {
        $_SESSION["m"] = "Fill out the missing fields!";
        $_SESSION["username"] = $username;
        header("Location: ../page/login.php");
        exit();
    }
} else {
    header("Location: ../page/login.php");
    exit();
}