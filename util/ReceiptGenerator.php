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

    public function generateReceipt($name, $user_email, $barangay, $receipt_no, $date, $plan, $start_date, $end_date, $amount)
    {
        $this->pdf->AddPage();

        // Add logo
        $this->pdf->Image($this->misc->url("assets/img/misc/RuralConnectAltLogo.png"), 10, 10, 70);

        $this->pdf->Ln(15);
        $this->pdf->SetFont('Arial', '', 12);
        $this->pdf->Cell(95, 7, 'Rural Connect Inc.', 0, 1);
        $this->pdf->Cell(95, 7, 'Sanciangko St. Cebu City,', 0, 1);
        $this->pdf->Cell(95, 7, 'Cebu, Philippines, 6000', 0, 1);

        $this->pdf->Ln(15);
        $this->pdf->SetFont('Arial', '', 12);

        $this->pdf->Cell(95, 7, $name, 0, 1);
        $this->pdf->Cell(95, 7, $user_email, 0, 1);
        $this->pdf->Cell(95, 7, 'Barangay ' . $barangay, 0, 1);

        $this->pdf->Ln(15);
        $this->pdf->SetFont('Arial', '', 12);

        $this->pdf->Cell(30.4, 10, 'Receipt No.', 0, 0);
        $this->pdf->Cell(30.4, 10, strtoupper($receipt_no), 0, 1);

        $this->pdf->Ln(1);
        $this->pdf->Cell(190, 0, '', 'T');
        $this->pdf->Ln();

        // Capture table top Y
        $startY = $this->pdf->GetY();

        // Table header
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->Cell(30.4, 10, 'Date', 0, 0, 'L');
        $this->pdf->Cell(50.16, 10, 'Description', 0, 0, 'L');
        $this->pdf->Cell(28.58, 10, 'Plan', 0, 0, 'L');
        $this->pdf->Cell(42.86, 10, 'Service Period', 0, 0, 'L');
        $this->pdf->Cell(38, 10, 'Amount', 0, 1, 'R');
        $this->pdf->Cell(190, 0, '', 'T');
        $this->pdf->Ln();

        // Subscription details
        $this->pdf->SetFont('Arial', '', 12);
        $this->pdf->Cell(30.4, 10, $date, 0, 0, 'L');
        $this->pdf->Cell(50.16, 10, 'Medication Request', 0, 0, 'L');
        $this->pdf->Cell(28.58, 10, $plan, 0, 0, 'L');
        $this->pdf->Cell(42.86, 10, $start_date . ' - ' . $end_date, 0, 0, 'L');
        $this->pdf->Cell(38, 10, 'PHP ' . number_format($amount, 2), 0, 1, 'R');
        $this->pdf->Ln(15);
        $this->pdf->Cell(190, 0, '', 'T');
        $this->pdf->Ln();

        // Total amount
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->Cell(155, 10, 'Total Amount', 0, 0, 'R');
        $this->pdf->Cell(35, 10, 'PHP ' . number_format($amount, 2), 0, 1, 'R');
        $this->pdf->Cell(190, 0, '', 'T');

        // Capture table bottom Y
        $endY = $this->pdf->GetY();

        // Draw left and right border lines
        $this->pdf->Line(10, $startY, 10, $endY);
        $this->pdf->Line(200, $startY, 200, $endY);

        $this->pdf->Ln(5);


        $this->pdf->Cell(65, 10, 'Payment Method:', 0, 0);
        $this->pdf->Image($this->misc->url("assets/img/misc/gcash-logo.png"), 48, 160, 25);
        // $this->pdf->Cell(40, 10, '**** *** 2810', 0, 0);

        // Output PDF
        $this->pdf->Output('', $receipt_no . ".pdf");
    }
}