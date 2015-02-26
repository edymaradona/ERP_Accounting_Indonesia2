<?php

class attendanceSummaryByDept extends fpdf
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
        $this->Cell(0, 5, 'PERHITUNGAN KEHADIRAN PER DEPARTEMEN', 'R', 0, 'C');
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
        $this->Cell($w[2], 4, 'Target', 'LTR', 0, 'C');
        $this->Cell($w[3], 4, 'Aktual', 'LTR', 0, 'C');
        $this->Cell($w[4], 4, 'Aktual / ', 'LTR', 0, 'C');
        $this->Cell($w[5], 4, 'Cuti', 'LTR', 0, 'C');
        $this->Cell($w[6], 4, 'Alpha', 'LTR', 0, 'C');
        $this->Cell($w[7] + $w[8], 4, 'TERLAMBAT', 1, 0, 'C');
        $this->Cell($w[9] + $w[10], 4, 'PULANG CEPAT', 1, 0, 'C');
        $this->Cell($w[11], 4, 'TAD', 'LTR', 0, 'C');
        $this->Cell($w[12], 4, 'TAP', 'LTR', 0, 'C');
        $this->Cell($w[13] + $w[14], 4, 'IJIN', 1, 0, 'C');
        $this->Ln();
        $this->Cell($w[0], 4, '', 'BLR', 0, 'C');
        $this->Cell($w[1], 4, '', 'BLR', 0, 'C');
        $this->Cell($w[2], 4, 'Jam Krj', 'BLR', 0, 'C');
        $this->Cell($w[3], 4, 'Jam Krj', 'BLR', 0, 'C');
        $this->Cell($w[4], 4, 'Target (%)', 'BLR', 0, 'C');
        $this->Cell($w[5], 4, '', 'BLR', 0, 'C');
        $this->Cell($w[6], 4, '', 'BLR', 0, 'C');
        $this->Cell($w[7], 4, 'jmlh', 'BLR', 0, 'C');
        $this->Cell($w[8], 4, 'menit', 'BLR', 0, 'C');
        $this->Cell($w[9], 4, 'jmlh', 'BLR', 0, 'C');
        $this->Cell($w[10], 4, 'menit', 'BLR', 0, 'C');
        $this->Cell($w[11], 4, '', 'BLR', 0, 'C');
        $this->Cell($w[12], 4, '', 'BLR', 0, 'C');
        $this->Cell($w[13], 4, 'sakit', 'BLR', 0, 'C');
        $this->Cell($w[14], 4, 'special', 'BLR', 0, 'C');
        $this->Ln();
    }

    function report($rows, $model)
    {
        $w = [8, 48, 16, 16, 14, 7, 7, 7, 15, 7, 15, 7, 7, 8, 8];
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
            $this->Cell($w[2], 6, $row['targethour'], 'LR', 0, 'R');
            $this->Cell($w[3], 6, $row['workhour'], 'LR', 0, 'R');
            $this->Cell($w[4], 6, peterFunc::indoFormat($row['workpertarget'], 2), 'LR', 0, 'R');
            $this->Cell($w[5], 6, $row['cuti'], 'LR', 0, 'C');
            $this->Cell($w[6], 6, ($row['alpha'] <= 0) ? '' : $row['alpha'], 'LR', 0, 'C');

            $this->Cell($w[7], 6, ($row['lateIn'] == 0) ? '' : $row['lateIn'], 'LR', 0, 'C');
            $this->Cell($w[8], 6, ($row['lateInCount'] == 0) ? '' : $row['lateInCount'], 'LR', 0, 'C');
            $this->Cell($w[9], 6, ($row['earlyOut'] == 0) ? '' : $row['earlyOut'], 'LR', 0, 'C');
            $this->Cell($w[10], 6, ($row['earlyOutCount'] == 0) ? '' : $row['earlyOutCount'], 'LR');

            $this->Cell($w[11], 6, ($row['tad'] == 0) ? '' : $row['tad'], 'LR', 0, 'C');
            $this->Cell($w[12], 6, ($row['tap'] == 0) ? '' : $row['tap'], 'LR', 0, 'C');
            //$this->Cell($w[11], 7, '', 'LR');
            $this->Cell($w[13], 6, ($row['sakit'] == 0) ? '' : $row['sakit'], 'LR', 0, 'C');
            $this->Cell($w[14], 6, ($row['special'] == 0) ? '' : $row['special'], 'LR', 0, 'C');
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

