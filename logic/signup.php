<?php
session_start();
require_once "../util/DbHelper.php";
require_once "../util/DirHandler.php";
require_once "../util/EmailSender.php";
require_once "../util/Misc.php";
require_once "../enums/UserType.php";
require_once "../enums/Barangay.php";
require_once "../vendor/autoload.php";

use Ramsey\Uuid\Uuid;

$db = new DbHelper();
$dh = new DirHandler();
$es = new EmailSender();
$ms = new Misc();
$userTypes = UserType::all();
$barangays = Barangay::all();

if (isset($_POST["signup"])) {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $contact = $_POST["contactNo"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $user_type = $_POST["user_type"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $con_password = $_POST["con_password"];
    $barangay = $_POST["barangay"] ?? '';
    $id_verification = $_FILES["id_verification"];

    $informations = ["fname" => $fname, "lname" => $lname, "address" => $address, "contactNo" => $contact, "email" => $email, "user_type" => $user_type, "username" => $username];

    if (
        !empty(trim($fname)) && !empty(trim($lname)) && !empty(trim($contact)) && !empty(trim($address)) && !empty(trim($email)) && !empty(trim($user_type)) && !empty(trim($username)) && !empty(trim($password)) && !empty(trim($con_password)) &&
        ($user_type !== 'barangay_inc' || !empty(trim($barangay)))
    ) {
        if (in_array($user_type, $userTypes)) {

            if ($user_type == 'barangay_inc' && !in_array($barangay, $barangays)) {
                $_SESSION['m'] = "Unknown Barangay!";
                $_SESSION["informations"] = $informations;
                header("Location: ../page/signup.php");
                exit();
            }
            // elseif ($user_type == 'barangay_inc' && in_array($barangay, $barangays)) {
            //     $informations['barangay'] = $barangay;
            // }

            $check_email = $db->fetchRecords("account", ["email" => $email]);
            if ($check_email == null) {
                $check_username = $db->fetchRecords("account", ["username" => $username]);
                if ($check_username == null) {
                    if ($password === $con_password) {
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        $accountId = Uuid::uuid4();
                        $verificationToken = Uuid::uuid4();
                        $es->requestAccountVerification($email, $accountId, $username, $verificationToken);
                        $db->addRecord("account", ["accountId" => $accountId, "email" => $email, "username" => $username, "password" => $password, "user_type" => $user_type, "verify_token" => $verificationToken]);
                        if (isset($_FILES["id_verification"]) && $_FILES['id_verification']['size'] > 0) {
                            $img_name = $accountId . ".png";
                            $info = ["accountId" => $accountId, "fname" => $fname, "lname" => $lname, "address" => $address, "contactNo" => $contact, "id_verification" => $img_name];

                            switch ($user_type) {
                                case 'barangay_inc':
                                    $info["barangay"] = $barangay;
                                    $info["id_verification"] = $ms->uploadImage($id_verification, $accountId, $dh->barangay_incharge_profile);
                                    $db->addRecord("barangay_inc", $info);
                                    break;
                                case 'city_health':
                                    $info["id_verification"] = $ms->uploadImage($id_verification, $accountId, $dh->city_health);
                                    $db->addRecord("city_health", $info);
                                    break;
                                case 'deliveries':
                                    $info["id_verification"] = $ms->uploadImage($id_verification, $accountId, $dh->deleviries);
                                    $db->addRecord("deliveries", $info);
                                    break;
                                default:
                                    break;
                            }
                        } else {
                            $info = ["accountId" => $accountId, "fname" => $fname, "lname" => $lname, "address" => $address, "contactNo" => $contact];
                            switch ($user_type) {
                                case 'barangay_inc':
                                    $info["barangay"] = $barangay;
                                    $db->addRecord("barangay_inc", $info);
                                    break;
                                case 'city_health':
                                    $db->addRecord("city_health", $info);
                                    break;
                                case 'deliveries':
                                    $db->addRecord("deliveries", $info);
                                    break;
                                default:
                                    break;
                            }
                        }
                        $_SESSION["m"] = "Registration Complete! Please check your email for verification";
                        header("Location: ../page/");
                        exit();
                    } else {
                        $_SESSION["m"] = "Passwords do not match!";
                        $_SESSION["informations"] = $informations;
                        header("Location: ../page/signup.php");
                        exit();
                    }
                } else {
                    $_SESSION["m"] = "Username already exists!";
                    $_SESSION["informations"] = $informations;
                    header("Location: ../page/signup.php");
                    exit();
                }
            } else {
                $_SESSION["m"] = "Email already exists!";
                $_SESSION["informations"] = $informations;
                header("Location: ../page/signup.php");
                exit();
            }
        } else {
            $_SESSION["m"] = "Invalid user type!";
            $_SESSION["informations"] = $informations;
            header("Location: ../page/signup.php");
            exit();
        }
    } else {
        $_SESSION["m"] = "Fill out the missing fields!";
        $_SESSION["informations"] = $informations;
        header("Location: ../page/signup.php");
        exit();
    }
} else {
    header("Location: ../page/signup.php");
    exit();
}
