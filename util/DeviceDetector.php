<?php

require_once '../vendor/autoload.php';

use Detection\MobileDetect;

class DeviceDetector
{
    private $detect;

    public function __construct()
    {
        $this->detect = new MobileDetect();
    }

    public function type()
    {
        if ($this->detect->isMobile() || $this->detect->isTablet()) {
            return "mobile";
        } else {
            return "desktop";
        }
    }
}