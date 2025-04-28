<?php

require_once "../util/Misc.php";

enum Unit: string
{
    case Piece = "Piece";
    case Box = "Box";
    case Bottle = "Bottle";

    public static function all()
    {
        return Misc::displayEnumNames(self::cases());
    }
}

// 'Piece','Box','Bottle'