<?php

require_once "../util/Misc.php";

enum ApproveStatus: string
{
    case Approved = 'Approved';
    case Cancelled= 'Cancelled';
    case Pending = 'Pending';

    public static function all()
    {
        return Misc::displayEnums(self::cases());
    }
}