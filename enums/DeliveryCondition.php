<?php

require_once "../util/Misc.php";

enum DeliveryCondition: string
{
    case Good = 'good';
    case Damaged = 'damaged';

    public static function all()
    {
        return Misc::displayEnums(self::cases());
    }
}