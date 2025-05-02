<?php

require_once "../util/Misc.php";

enum AvailabilityStatus: string
{
    case Available = 'Available';
    case Unavailable = 'Unavailable';

    public static function all()
    {
        return Misc::displayEnums(self::cases());
    }
}