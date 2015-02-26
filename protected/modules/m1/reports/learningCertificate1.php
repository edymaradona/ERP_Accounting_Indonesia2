<?php

class learningCertificate1 extends fpdf
{

    function report($model)
    {

        $this->SetFont('Arial', '', 14);
        $this->Ln(58);
        //$this->Cell(0, 5, $model->sertificate_number.'NO.1000/SFT/HR-APLC/VIII/2014',0,0,'C');
        $this->Cell(10, 5, "");
        $this->Cell(270, 5, 'NO.' . $model->certificate_number, 0, 0, 'C');
        $this->Ln(25);
        $this->SetFont('Times', 'BU', 30);
        //$this->Cell(0, 5, $model->employee->employee_name, 0, 0, 'C');
        $this->Cell(10, 5, "");
        $this->Cell(270, 5, $model->employee->employee_name, 0, 0, 'C');
        $this->Ln(32);
        $this->SetFont('Times', 'B', 24);
        //$this->Cell(0, 5, $model->getparent->getparent->learning_title, 0, 0, 'C');
        $this->Cell(10, 5, "");
        $this->Cell(270, 5, $model->getparent->getparent->learning_title, 0, 0, 'C');

        $this->Ln(16);
        $this->Cell(178, 5, '');
        $this->SetFont('Arial', '', 13);
        $this->Cell(70, 5, "on " . date("M jS, Y", strtotime($model->getparent->schedule_date)), 0, 0, 'L');
        $this->Ln(42);

        if ($model->getparent->certificate_template_id == 1) {
            $this->Image('shareimages/hr/yanu.jpg', $this->GetX() + 85, $this->GetY() - 27, 50);
            $this->Image('shareimages/hr/koes.jpg', $this->GetX() + 165, $this->GetY() - 30, 50);
            $this->Cell(70, 5, "");
            $this->SetFont('Times', 'BU', 12);
            $this->Cell(80, 5, "YANUARSIH P. LOMPATAN", 0, 0, 'C');
            $this->Cell(80, 5, "KOESHARTANTO", 0, 0, 'C');
            $this->Ln();
            $this->Cell(70, 5, "");
            $this->SetFont('Times', 'B', 11);
            $this->Cell(80, 5, "HEAD OF LEARNING CENTER", 0, 0, 'C');
            $this->Cell(80, 5, "VP OF CORPORATE HUMAN RESOURCE", 0, 0, 'C');
        } elseif ($model->getparent->certificate_template_id == 2) {
            $this->Image('shareimages/hr/hardi.jpg', $this->GetX() + 55, $this->GetY() - 27, 50);
            $this->Image('shareimages/hr/yanu.jpg', $this->GetX() + 122, $this->GetY() - 27, 50);
            $this->Image('shareimages/hr/koes.jpg', $this->GetX() + 185, $this->GetY() - 30, 50);
            $this->Cell(45, 5, "");
            $this->SetFont('Times', 'BU', 12);
            $this->Cell(65, 5, "SUHARDI", 0, 0, 'C');
            $this->Cell(65, 5, "YANUARSIH P. LOMPATAN", 0, 0, 'C');
            $this->Cell(80, 5, "KOESHARTANTO", 0, 0, 'C');
            $this->Ln();
            $this->Cell(45, 5, "");
            $this->SetFont('Times', 'B', 11);
            $this->Cell(65, 5, "FACILITATOR", 0, 0, 'C');
            $this->Cell(65, 5, "HEAD OF LEARNING CENTER", 0, 0, 'C');
            $this->Cell(80, 5, "VP OF CORPORATE HUMAN RESOURCE", 0, 0, 'C');
        } else {
            $this->Image('shareimages/hr/yanu.jpg', $this->GetX() + 122, $this->GetY() - 27, 50);
            $this->Image('shareimages/hr/koes.jpg', $this->GetX() + 185, $this->GetY() - 30, 50);
            $this->Cell(45, 5, "");
            $this->SetFont('Times', 'BU', 12);
            $this->Cell(65, 5, strtoupper($model->getparent->trainer_name), 0, 0, 'C');
            $this->Cell(65, 5, "YANUARSIH P. LOMPATAN", 0, 0, 'C');
            $this->Cell(80, 5, "KOESHARTANTO", 0, 0, 'C');
            $this->Ln();
            $this->Cell(45, 5, "");
            $this->SetFont('Times', 'B', 11);
            $this->Cell(65, 5, "FACILITATOR", 0, 0, 'C');
            $this->Cell(65, 5, "HEAD OF LEARNING CENTER", 0, 0, 'C');
            $this->Cell(80, 5, "VP OF CORPORATE HUMAN RESOURCE", 0, 0, 'C');
        }

    }

}

