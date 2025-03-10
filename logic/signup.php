<?php
session_start();
require_once "../util/DbHelper.php";
require_once "../util/DirHandler.php";

$db = new DbHelper();
$dh = new DirHandler();

if (isset($_POST["signup"])) {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $contact = $_POST["contact"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $user_type = $_POST["user_type"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $con_password = $_POST["con_password"];

    if (!empty(trim($fname)) && !empty(trim($lname)) && !empty(trim($contact)) && !empty(trim($address)) && !empty(trim($email)) && !empty(trim($user_type)) && !empty(trim($username)) && !empty(trim($password)) && !empty(trim($con_password))) {
        if ($user_type != 'Admin' && $user_type != 'admin') {
            $check_email = $db->fetchRecords("account", ["email" => $email]);
            if ($check_email == null) {
                $check_username = $db->fetchRecords("account", ["username" => $username]);
                if ($check_username == null) {
                    if ($password === $con_password) {
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        $db->addRecord("account", ["email" => $email, "username" => $username, "password" => $password, "user_type" => $user_type, "isLogin" => "0"]);
                        $accountuser = $db->fetchRecords("account", ["email" => $email])[0];
                        $accountId = $accountuser["accountId"];

                        if (isset($_FILES["id_verification"]) && $_FILES['id_verification']['size'] > 0) {
                            $img_name = $accountId . ".png";
                            $info = ["accountId" => $accountId, "fname" => $fname, "lname" => $lname, "address" => $address, "contactNo" => $contact, "id_verification" => $img_name];

                            switch ($user_type) {
                                case 'barangay_inc':
                                    $img_file = $dh->barangay_incharge_profile . $img_name;
                                    move_uploaded_file($_FILES["id_verification"]["tmp_name"], $img_file);
                                    $db->addRecord("barangay_inc", $info);
                                    break;
                                case 'city_health':
                                    $img_file = $dh->city_health . $img_name;
                                    move_uploaded_file($_FILES["id_verification"]["tmp_name"], $img_file);
                                    $db->addRecord("city_health", $info);
                                    break;
                                case 'deliveries':
                                    $img_file = $dh->deleviries . $img_name;
                                    move_uploaded_file($_FILES["id_verification"]["tmp_name"], $img_file);
                                    $db->addRecord("deliveries", $info);
                                    break;
                                default:
                                    break;
                            }
                        } else {
                            $info = ["accountId" => $accountId, "fname" => $fname, "lname" => $lname, "address" => $address, "contactNo" => $contact];
                            switch ($user_type) {
                                case 'barangay_inc':
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
                        $_SESSION["m"] = "Successful Register";
                        header("Location: ../page/");
                        exit();
                    } else {
                        $_SESSION["m"] = "Passwords do not match!";
                        header("Location: ../page/signup.php");
                        exit();
                    }
                } else {
                    $_SESSION["m"] = "Username already exists!";
                    header("Location: ../page/signup.php");
                    exit();
                }
            } else {
                $_SESSION["m"] = "Email already exists!";
                header("Location: ../page/signup.php");
                exit();
            }
        } else {
            $_SESSION["m"] = "Invalid user type!";
            header("Location: ../page/signup.php");
            exit();
        }
    } else {
        $_SESSION["m"] = "Fill out the missing fields!";
        header("Location: ../page/signup.php");
        exit();
    }
} else {
    header("Location: ../page/signup.php");
    exit();
}
