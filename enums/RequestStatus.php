<?php

require_once "../util/Misc.php";

enum RequestStatus: string
{
    case Accepted = 'Accepted';
    case Cancelled = 'Cancelled';

    public static function all()
    {
        return Misc::displayEnums(self::cases());
    }
}