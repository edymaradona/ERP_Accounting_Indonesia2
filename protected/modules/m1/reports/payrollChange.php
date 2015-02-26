<?php

class payrollChange extends fpdf
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

    function myheader($rows, $w, $yearmonth)
    {
        $this->y0 = $this->GetY();
        $this->Cell(0, 5, '', 'T', 0, 'C');
        $this->Image('shareimages/company/logoAlt1.jpg', 15, 12, 30);
        $this->SetY($this->y0);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 5, '', 'LR');
        $this->Ln();
        $this->Cell(30, 5, '', 'L');
        $this->Cell(0, 5, 'LAPORAN PERUBAHAN GAJI (RINGKASAN)', 'R', 0, 'C');
        $this->Ln();
        $this->Cell(0, 5, '', 'LBR');
        $this->Ln(1);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 6, '', 'B', 0, 'C');
        $this->Ln();
        $this->Cell(0, 6, 'PERIODE:  ' . peterFunc::bulantahun($yearmonth), 1, 0, 'C');

        $this->Ln(6);
        $this->Cell(0, 6, '', 'T');
        $this->Ln(1);

        $this->SetFillColor(230, 230, 230);

        $this->Cell(0, 1, '', 'B');
        $this->Ln();
        $this->SetFont('Arial', 'B', 7);
        $this->Cell($w[0], 4, 'No', 'LTR', 0, 'C');
        $this->Cell($w[1], 4, 'Nama', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, 'Tgl Bergabung', 'LTR', 0, 'C');
        $this->Cell($w[3], 4, 'Komponen', 'LR', 0, 'C');
        $this->Cell($w[4], 4, 'Sebelumnya', 'LR', 0, 'C');
        $this->Cell($w[5], 4, 'Gaji', 'LR', 0, 'C');
        $this->Cell($w[6], 4, 'Prorate', 'LR', 0, 'C');
        $this->Cell($w[7] + $w[8], 4, 'Total', 1, 0, 'C');
        $this->Cell($w[9], 4, 'Keterangan', 'LTR', 0, 'C');
        $this->Ln();
        $this->SetFont('Arial', '', 7);
        $this->Cell($w[0], 4, '', 'LBR', 0, 'C');
        $this->Cell($w[1], 4, '', 'LBR', 0, 'C');
        $this->Cell($w[2], 4, '', 'LBR', 0, 'C');
        $this->Cell($w[3], 4, '', 'LBR', 0, 'C');
        $this->Cell($w[4], 4, '', 'LBR', 0, 'C');
        $this->Cell($w[5], 4, '', 'LBR', 0, 'C');
        $this->Cell($w[6], 4, '', 'LBR', 0, 'C');

        $this->Cell($w[7], 4, 'Tanpa Prorate', 'LBR', 0, 'C');
        $this->Cell($w[8], 4, 'Dengan Prorate', 'LBR', 0, 'C');
        $this->Cell($w[9], 4, '', 'LBR', 0, 'C');
        $this->Ln();
    }

    function report($rows, $yearmonth)
    {
        $w = [6, 50, 20, 20, 25, 25, 25, 25, 25, 56];
        $this->myheader($rows, $w, $yearmonth);
        $type = null;
        $counter = 1;

        foreach ($rows as $row) {
            if ($row['category_id'] != $type) {
                $this->SetFont('Arial', 'B', 9);
                $this->Cell(0, 5, '', 'T', 0);
                $this->Ln();
                $this->Cell(0, 7, $row['category'], 'B', 0);
                $this->Ln();
                $type = $row['category_id'];
            }
            $this->SetFont('Arial', '', 9);
            $this->Cell($w[0], 5, $counter, 'L', 0, 'R');
            $this->SetFont('Arial', 'B', 9);
            $this->Cell($w[1], 5, $row['employee_name'], 'L');
            $this->SetFont('Arial', '', 9);
            $this->Cell($w[2], 5, date('d-m-Y', strtotime($row['join_date'])), 'L');
            $this->Cell($w[3], 5, 'Gaji Pokok:', 'L', 0, 'R');
            $this->Cell($w[4], 5, peterFunc::indoFormat($row['basic_salary_previous']), 0, 0, 'R');
            $this->Cell($w[5], 5, peterFunc::indoFormat($row['basic_salary']), 0, 0, 'R');
            $this->Cell($w[6], 5, peterFunc::indoFormat($row['prorate_salary']), 'R', 0, 'R');
            $this->SetFont('Arial', 'B', 9);
            $this->Cell($w[7], 5, peterFunc::indoFormat($row['basic_salary'] + $row['t_benefit'] - $row['t_deduction']), 'LR', 0, 'R');

            if ($row['prorate_salary'] == 0) {
                $this->Cell($w[8], 5, peterFunc::indoFormat($row['basic_salary'] + $row['t_benefit'] - $row['t_deduction']), 'LR', 0, 'R');
            } else
                $this->Cell($w[8], 5, peterFunc::indoFormat($row['prorate_salary'] + $row['t_benefit'] - $row['t_deduction']), 'LR', 0, 'R');

            $this->SetFont('Arial', '', 9);
            if ($row['category_id'] == 1) {
                $this->Cell($w[9], 5, 'Bank: ' . $row['bank_name'], 'LR');
            } else
                $this->Cell($w[9], 5, '', 'LR');

            $this->Ln();

            $this->SetFont('Arial', '', 8);
            $this->Cell($w[0], 5, '', 'L', 0, 'R');
            $this->Cell($w[1], 5, $row['department'], 'L');
            $this->Cell($w[2], 5, '', 'L');
            $this->SetFont('Arial', '', 9);
            $this->Cell($w[3], 5, 'Tunjangan:', 'L', 0, 'R');
            $this->Cell($w[4], 5, peterFunc::indoFormat($row['t_benefit_previous']), 0, 0, 'R');
            $this->Cell($w[5], 5, peterFunc::indoFormat($row['t_benefit']), 0, 0, 'R');
            $this->Cell($w[6], 5, '', 'R', 0, 'R');
            $this->Cell($w[7], 5, '', 'R', 0, 'R');
            $this->Cell($w[8], 5, '', 'LR', 0, 'R');

            $this->SetFont('Arial', '', 9);
            if ($row['category_id'] == 1) {
                $this->Cell($w[9], 5, 'Acc No: ' . $row['account_number'], 'LR');
            } else
                $this->Cell($w[9], 5, '', 'LR');
            $this->Ln();

            $this->SetFont('Arial', '', 8);
            $this->Cell($w[0], 5, '', 'LB', 0, 'R');
            $this->Cell($w[1], 5, $row['employee_status'], 'LB');
            $this->Cell($w[2], 5, '', 'LB');
            $this->SetFont('Arial', '', 9);
            $this->Cell($w[3], 5, 'Potongan:', 'LB', 0, 'R');
            $this->Cell($w[4], 5, peterFunc::indoFormat($row['t_deduction_previous']), 'B', 0, 'R');
            $this->Cell($w[5], 5, peterFunc::indoFormat($row['t_deduction']), 'B', 0, 'R');
            $this->Cell($w[6], 5, '', 'RB', 0, 'R');
            $this->Cell($w[7], 5, '', 'RB', 0, 'R');
            $this->Cell($w[8], 5, '', 'LRB', 0, 'R');

            $this->SetFont('Arial', '', 9);
            if ($row['category_id'] == 1) {
                $this->Cell($w[9], 5, 'Acc Name: ' . $row['account_name'], 'LRB');
            } else
                $this->Cell($w[9], 5, '', 'LRB');
            $this->Ln();

            $counter++;

            if ($this->GetY() > 178) {
                $this->Cell(0, 5, '', 'T');
                $this->AddPage();
                $dept = null;
                $this->myheader($rows, $w, $yearmonth);
                $this->SetFont('Arial', 'B', 9);
                $this->Cell(0, 7, $row['category'], 1, 0);
                $this->Ln();
                $type = $row['category_id'];
            }
        }
        $this->Cell(0, 5, '', 'T');
    }

}

