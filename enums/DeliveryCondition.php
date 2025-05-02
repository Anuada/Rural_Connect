<?php

require_once "../util/Misc.php";

enum DeliveryCondition: string
{
    case Good = 'good';
    case Damaged = 'damaged';
    case Missing_Items = 'missing items';

    public static function all()
    {
        return Misc::displayEnums(self::cases());
    }
}