<?php

require_once "../util/Misc.php";

enum UserType: string
{
    case barangay_inc = "barangay_inc";
    case city_health = "city_health";
    case deliveries = "deliveries";

    public static function all()
    {
        return Misc::displayEnums(self::cases());
    }
}