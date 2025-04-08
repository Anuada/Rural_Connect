<?php

require_once "../util/Misc.php";

enum SubscriptionPlan: string
{
    case Annual = "Annual";
    case Monthly = "Monthly";

    public static function all()
    {
        return Misc::displayEnums(self::cases());
    }
}