<?php

class selection1 extends fpdf
{

    //Page footer
    function Footer()
    {
        //Position at 1.5 cm from bottom
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial', 'I', 6);
        //Page number
        $this->Cell(0, 10, 'Printed Date: ' . Yii::app()->dateFormatter->format("dd-MM-yyyy", time()) . '                        ' .
            'Page: ' . $this->PageNo() . '/{nb}' . '                        ' .
            'Issued By: ' . Yii::app()->params["title"] . ' - ' . Yii::app()->params["custom2"], 0, 0, 'C');
    }

    function myheader($begindate, $enddate)
    {
        $this->y0 = $this->GetY();
        $this->Cell(0, 5, '', 'T', 0, 'C');
        $this->Image('shareimages/company/logoAlt1.jpg', 15, 12, 30);
        $this->SetY($this->y0);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 5, '', 'LR');
        $this->Ln();
        $this->Cell(30, 5, '', 'L');
        $this->Cell(0, 5, 'LAPORAN RECRUITMENT', 'R', 0, 'C');
        $this->Ln();
        $this->Cell(0, 5, '', 'LBR');
        $this->Ln();


        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, 'PERIODE: ' . $begindate . " s/d " . $enddate, 0, 0, 'C');
        $this->Ln();

        $this->SetFillColor(230, 230, 230);

        $w = [20, 50, 30, 25, 22, 22, 22];

        $this->Cell(0, 1, '', 'B');
        $this->Ln();
        $this->SetFont('Arial', '', 8);
        $this->Cell($w[0], 5, 'Tanggal', 'LTR', 0, 'C', true);
        $this->Cell($w[1], 5, 'Nama Kandidat', 'LTR', 0, 'C', true);
        $this->Cell($w[2], 5, 'Posisi yang dilamar', 'LTR', 0, 'C', true);
        $this->Cell($w[3], 5, 'Utk Departemen', 'LTR', 0, 'C', true);
        $this->Cell($w[4], 5, 'Pangkat', 'LTR', 0, 'C', true);
        $this->Cell($w[5], 5, 'Sumber', 'LTR', 0, 'C', true);
        $this->Cell($w[6], 5, 'Status', 'LTR', 0, 'C', true);
        $this->Ln();
    }

    function report($models, $begindate, $enddate)
    {
        $this->myheader($begindate, $enddate);

        $this->SetFillColor(230, 230, 230);

        $w = [20, 50, 30, 25, 22, 22, 22];

        $fill = false;
        foreach ($models as $model) {
            $this->SetFont('Arial', '', 8);
            $this->Cell($w[0], 5, $model->input_date, 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 5, $model->candidate_name, 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 5, $model->for_position, 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 5, $model->department->name, 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 5, isset($model->level) ? $model->level->name : "", 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 5, $model->source->name, 'LR', 0, 'L', $fill);
            $this->Cell($w[6], 5, isset($model->status) ? $model->status->name : "", 'LR', 0, 'L', $fill);
            $this->Ln();
            $this->SetFont('Arial', '', 7);
            $this->Cell($w[0], 3, '', 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 3, '  ' . $model->birthdate, 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 3, '', 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 3, '', 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 3, '', 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 3, '', 'LR', 0, 'L', $fill);
            $this->Cell($w[6], 3, '', 'LR', 0, 'L', $fill);
            $this->Ln();
            $this->Cell($w[0], 3, '', 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 3, '  ' . $model->handphone, 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 3, '', 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 3, '', 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 3, '', 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 3, '', 'LR', 0, 'L', $fill);
            $this->Cell($w[6], 3, '', 'LR', 0, 'L', $fill);
            $this->Ln();
            $this->Cell($w[0], 3, '', 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 3, '  ' . $model->email, 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 3, '', 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 3, '', 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 3, '', 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 3, '', 'LR', 0, 'L', $fill);
            $this->Cell($w[6], 3, '', 'LR', 0, 'L', $fill);
            $this->Ln();
            $this->Cell($w[0], 2, '', 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 2, '', 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 2, '', 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 2, '', 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 2, '', 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 2, '', 'LR', 0, 'L', $fill);
            $this->Cell($w[6], 2, '', 'LR', 0, 'L', $fill);
            $this->Ln();

            $fill = !$fill;

            if ($this->GetY() >= 260) {
                $this->Cell(array_sum($w), 4, '', 'T');
                $this->AddPage();
                $this->myheader($begindate, $enddate);
            }
        }
    }

}

