<?php

class selection5 extends fpdf
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
        $this->Cell(0, 5, 'REKAP CANDIDATE SOURCE', 'R', 0, 'C');
        $this->Ln();
        $this->Cell(0, 5, '', 'LBR');
        $this->Ln();


        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, 'PERIODE: ' . $begindate . " s/d " . $enddate, 0, 0, 'C');
        $this->Ln();

        $this->SetFillColor(230, 230, 230);

        $w = [55, 30, 25, 20, 20, 20, 20];

        $this->Cell(0, 1, '', 'B');
        $this->Ln();
        $this->SetFont('Arial', '', 8);
        $this->Cell($w[0], 5, 'Sumber', 'LTR', 0, 'C', true);
        $this->Cell($w[1], 5, 'Level', 'LTR', 0, 'C', true);
        $this->Cell($w[2], 5, 'Data Baru', 'LTR', 0, 'C', true);
        $this->Cell($w[3], 5, 'Sdg Diproses', 'LTR', 0, 'C', true);
        $this->Cell($w[4], 5, 'Diterima', 'LTR', 0, 'C', true);
        $this->Cell($w[5], 5, 'Ditolak', 'LTR', 0, 'C', true);
        $this->Cell($w[6], 5, 'Total', 'LTR', 0, 'C', true);
        $this->Ln();
    }

    function report($models, $begindate, $enddate)
    {
        $this->myheader($begindate, $enddate);

        $this->SetFillColor(230, 230, 230);

        $w = [55, 30, 25, 20, 20, 20, 20];

        $fill = false;
        $_N1 = 0;
        $_N2 = 0;
        $_N3 = 0;
        $_N4 = 0;
        $_gtotal = 0;
        foreach ($models->getData() as $model) {
            $this->SetFont('Arial', '', 8);
            $this->Cell($w[0], 5, $model['name'], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 5, '', 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 5, $model['N1'], 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 5, $model['N2'], 'LR', 0, 'R', $fill);
            $this->Cell($w[4], 5, $model['N3'], 'LR', 0, 'R', $fill);
            $this->Cell($w[5], 5, $model['N4'], 'LR', 0, 'R', $fill);
            $_total = $model['N1'] + $model['N2'] + $model['N3'] + $model['N4'];
            $_N1 = $_N1 + $model['N1'];
            $_N2 = $_N2 + $model['N2'];
            $_N3 = $_N3 + $model['N3'];
            $_N3 = $_N4 + $model['N4'];
            $_gtotal = $_gtotal + $_total;
            $this->Cell($w[6], 5, $_total, 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill = !$fill;

            if ($this->GetY() >= 260) {
                $this->Cell(array_sum($w), 4, '', 'T');
                $this->AddPage();
                $this->myheader($begindate, $enddate);
            }
        }
        $this->Cell(array_sum($w), 4, '', 'T');
        $this->Ln(1);

        $fill = true;
        $this->SetFont('Arial', '', 8);
        $this->Cell($w[0], 7, 'TOTAL', 1, 0, 'L', $fill);
        $this->Cell($w[1], 7, '', 1, 0, 'L', $fill);
        $this->Cell($w[2], 7, $_N1, 1, 0, 'R', $fill);
        $this->Cell($w[3], 7, $_N2, 1, 0, 'R', $fill);
        $this->Cell($w[4], 7, $_N3, 1, 0, 'R', $fill);
        $this->Cell($w[5], 7, $_N4, 1, 0, 'R', $fill);
        $this->Cell($w[6], 7, $_gtotal, 1, 0, 'R', $fill);
        $this->Ln();
    }

}

