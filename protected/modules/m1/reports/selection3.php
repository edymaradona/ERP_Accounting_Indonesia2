<?php

class selection3 extends fpdf
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
        $this->Cell(0, 5, 'REKAP INTERVIEW HR', 'R', 0, 'C');
        $this->Ln();
        $this->Cell(0, 5, '', 'LBR');
        $this->Ln();


        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, 'PERIODE: ' . $begindate . " s/d " . $enddate, 0, 0, 'C');
        $this->Ln();

        $this->SetFillColor(230, 230, 230);

        $w = [60, 30, 25, 25, 25, 25];

        $this->Cell(0, 1, '', 'B');
        $this->Ln();
        $this->SetFont('Arial', '', 8);
        $this->Cell($w[0], 5, 'Department', 'LTR', 0, 'C', true);
        $this->Cell($w[1], 5, 'Level', 'LTR', 0, 'C', true);
        $this->Cell($w[2], 5, 'Disarankan', 'LTR', 0, 'C', true);
        $this->Cell($w[3], 5, 'Dipertimbangkan', 'LTR', 0, 'C', true);
        $this->Cell($w[4], 5, 'Tidak Disarankan', 'LTR', 0, 'C', true);
        $this->Cell($w[5], 5, 'Total', 'LTR', 0, 'C', true);
        $this->Ln();
    }

    function report($models, $begindate, $enddate)
    {
        $this->myheader($begindate, $enddate);

        $this->SetFillColor(230, 230, 230);

        $w = [60, 30, 25, 25, 25, 25];

        $fill = false;
        $_OK = 0;
        $_DP = 0;
        $_NOK = 0;
        $_gtotal = 0;
        foreach ($models->getData() as $model) {
            $this->SetFont('Arial', '', 8);
            $this->Cell($w[0], 5, $model['name'], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 5, '', 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 5, $model['OK'], 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 5, $model['DP'], 'LR', 0, 'R', $fill);
            $this->Cell($w[4], 5, $model['NOK'], 'LR', 0, 'R', $fill);
            $_total = $model['OK'] + $model['DP'] + $model['NOK'];
            $_OK = $_OK + $model['OK'];
            $_DP = $_DP + $model['DP'];
            $_NOK = $_NOK + $model['NOK'];
            $_gtotal = $_gtotal + $_total;
            $this->Cell($w[5], 5, $_total, 'LR', 0, 'R', $fill);
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
        $this->Cell($w[2], 7, $_OK, 1, 0, 'R', $fill);
        $this->Cell($w[3], 7, $_DP, 1, 0, 'R', $fill);
        $this->Cell($w[4], 7, $_NOK, 1, 0, 'R', $fill);
        $this->Cell($w[5], 7, $_gtotal, 1, 0, 'R', $fill);
        $this->Ln();
    }

}

