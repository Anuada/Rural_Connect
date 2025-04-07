<?php

require_once "../util/Misc.php";

enum SubscriptionPlan: string
{
    case Anually = "Annually";
    case Monthly = "Monthly";

    public static function all()
    {
        return Misc::displayEnums(self::cases());
    }
}