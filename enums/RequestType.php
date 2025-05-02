<?php

require_once "../util/Misc.php";

enum RequestType: string
{
    case Standard_Request = 'Standard Request';
    case Customized_Request = 'Customized Request';

    public static function all()
    {
        return Misc::displayEnums(self::cases());
    }
}