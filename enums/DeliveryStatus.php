<?php

require_once "../util/Misc.php";

enum DeliveryStatus: string
{
    case To_Deliver = 'To Deliver';
    case In_Transit = 'In Transit';
    case Failed_Delivery = 'Failed Delivery';
    case Returned = 'Returned';
    case Delivered = 'Delivered';
    case Partially_Claimed = 'Partially Claimed';
    case Claimed = 'Claimed';

    public static function all()
    {
        return Misc::displayEnums(self::cases());
    }
}