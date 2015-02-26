<?php

class attendanceDetailByDept extends fpdf
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

    function myheader($rows, $w, $model)
    {
        $this->y0 = $this->GetY();
        $this->Cell(0, 5, '', 'T', 0, 'C');
        $this->Image('shareimages/company/logoAlt1.jpg', 15, 12, 30);
        $this->SetY($this->y0);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 5, '', 'LR');
        $this->Ln();
        $this->Cell(30, 5, '', 'L');
        $this->Cell(0, 5, 'PERHITUNGAN KEHADIRAN PER DEPARTEMEN (DETAIL)', 'R', 0, 'C');
        $this->Ln();
        $this->Cell(0, 5, '', 'LBR');
        $this->Ln(1);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 6, '', 'B', 0, 'C');
        $this->Ln();
        if ($model->period == date('Ym')) {
            $this->Cell(0, 6, 'PERIODE:  01-' . date('m-Y') . '  s/d  ' . date('d-m-Y', strtotime('yesterday')), 1, 0, 'C');
        } else {
            $start = '01-' . substr($model->period, 4, 2) . '-' . substr($model->period, 0, 4);
            $end = date('d-m-Y', strtotime('last day', strtotime($start . ' +1 month')));
            $this->Cell(0, 6, 'PERIODE:  ' . $start . '  s/d  ' . $end, 1, 0, 'C');
        }

        $this->Ln(6);
        $this->Cell(0, 6, '', 'T');
        $this->Ln(1);

        $this->SetFillColor(230, 230, 230);

        $this->Cell(0, 1, '', 'B');
        $this->Ln();
        $this->SetFont('Arial', 'B', 6);
        $this->Cell($w[0], 4, 'No', 'LTR', 0, 'C');
        $this->Cell($w[1], 4, 'Nama', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '1', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '2', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '3', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '4', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '5', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '6', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '7', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '8', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '9', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '10', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '11', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '12', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '13', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '14', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '15', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '16', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '17', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '18', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '19', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '20', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '21', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '22', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '23', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '24', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '25', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '26', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '27', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '28', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '29', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '30', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, '31', 'LTR', 0, 'C');
        $this->Ln();
    }

    function report($rows, $model)
    {
        $w = [8, 48, 6];
        $this->myheader($rows, $w, $model);
        $dept = null;
        $counter = 1;

        foreach ($rows as $row) {
            if ($row['department'] != $dept) {
                if ($dept != null) {
                    $this->Cell(0, 5, '', 'T');

                    $this->Ln(6);

                    $w2 = [140, 53];

                    $this->Cell($w2[0], 4, '');
                    $this->Cell($w2[1], 4, 'Mengetahui');
                    $this->Ln();
                    $this->Cell($w2[0], 22, '');
                    $this->Cell($w2[1], 22, '');
                    $this->Ln();
                    $this->SetFont('Arial', '', 8);
                    $this->Cell($w2[0], 5, '');
                    $this->Cell($w2[1], 5, 'HR Manager');

                    $this->AddPage();
                    $this->myheader($rows, $w, $model);
                    $counter = 1;
                }
                $this->SetFont('Arial', 'B', 8);
                $this->Cell(0, 7, $row['department'], 1, 0, 'C');
                $this->Ln();
                $dept = $row['department'];
            }
            $this->SetFont('Arial', '', 8);
            $this->Cell($w[0], 6, $counter, 'L', 0, 'R');
            $this->Cell($w[1], 6, $row['employee_name'], 'L');
            $this->Cell($w[2], 6, $row['c01'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c02'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c03'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c04'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c05'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c06'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c07'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c08'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c09'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c10'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c11'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c12'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c13'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c14'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c15'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c16'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c17'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c18'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c19'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c20'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c21'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c22'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c23'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c24'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c25'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c26'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c27'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c28'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c29'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c30'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $row['c31'], 'LR', 0, 'C');
            $this->Cell(0, 6, '', 'LR', 0, 'C');
            $this->Ln();
            $counter++;

            if ($this->GetY() > 265) {
                $this->Cell(0, 5, '', 'T');
                $this->AddPage();
                $dept = null;
                $this->myheader($rows, $w, $model);
            }
        }
        $this->Cell(0, 5, '', 'T');
    }

}

