<?php

require_once "../util/Misc.php";

// 'medicinal product','medical supply'

enum ItemCategory: string
{
    case Medicinal_Product = 'medicinal product';
    case Medical_Supply = 'medical supply';

    public static function all()
    {
        return Misc::displayEnums(self::cases());
    }
}