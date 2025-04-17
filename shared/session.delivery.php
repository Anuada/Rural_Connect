<?php

require_once "../util/Misc.php";
$ms = new Misc;

if (isset($_SESSION['accountId'])) {
    switch ($_SESSION["user_type"]) {

        case 'barangay_inc':
            header("Location: " . $ms->url('barangay_inc/'));
            exit;

        case 'city_health':
            header("Location: " . $ms->url('city_health/'));
            exit;
        case 'admin':
            header("Location: " . $ms->url('admin/'));
            exit;

        default:
            break;
    }
    require_once "../shared/is.user.verified.php";
} else {
    header("Location: " . $ms->url("page/login.php"));
    exit;
}
