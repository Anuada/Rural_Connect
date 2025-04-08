<?php

require_once "../util/Misc.php";

enum Barangay: string
{
    case Adlaon = 'Adlaon';
    case Agsungot = 'Agsungot';
    case Babag = 'Babag';
    case Binaliw = 'Binaliw';
    case Bonbon = 'Bonbon';
    case Budlaan = 'Budlaan';
    case Buhisan = 'Buhisan';
    case Buot = 'Buot';
    case Busay = 'Busay';
    case Cambinocot = 'Cambinocot';
    case Guba = 'Guba';
    case Lusaran = 'Lusaran';
    case Malubog = 'Malubog';
    case Pamutan = 'Pamutan';
    case Paril = 'Paril';
    case PitOs = 'Pit-os';
    case PungOlSibugay = 'Pung-ol Sibugay';
    case Pulangbato = 'Pulangbato';
    case Sapangdaku = 'Sapangdaku';
    case Sinsin = 'Sinsin';
    case Sirao = 'Sirao';
    case SudlonI = 'Sudlon I';
    case SudlonII = 'Sudlon II';
    case Tabunan = 'Tabunan';
    case TagbaO = 'Tagba-o';
    case Taptap = 'Taptap';
    case ToOng = 'To-ong';

    public static function all()
    {
        return Misc::displayEnums(self::cases());
    }
}