<?php

require_once '../vendor/autoload.php';
require_once '../util/Misc.php';

class ReceiptGenerator
{
    private $pdf;
    private $misc;

    public function __construct()
    {
        $this->pdf = new FPDF();
        $this->misc = new Misc();
    }

    public function generateReceipt()
    {
        $this->pdf->AddPage();

        // Add logo
        $imageWidth = 70; // Set the desired width of the image
        $imageHeight = 0; // Automatically calculate the height based on the aspect ratio
        $imageX = ($this->pdf->GetPageWidth() - $imageWidth) / 2; // Calculate the X position to center the image

        // Add logo
        $this->pdf->Image($this->misc->url("assets/img/misc/RuralConnectAltLogo.png"), $imageX, 10, $imageWidth, $imageHeight);

        // Output PDF
        $this->pdf->Output();
    }
}