<?php

require_once "../util/Misc.php";

enum SubscriptionPlan: int
{
    case Annual = 2999;
    case Monthly = 299;

    public static function all()
    {
        return Misc::displayEnumNames(self::cases());
    }
}