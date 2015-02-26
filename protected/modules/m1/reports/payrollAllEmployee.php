<?php

class payrollAllEmployee extends fpdf
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
        $this->Cell(0, 5, 'LAPORAN PERUBAHAN GAJI (DETIL)', 'R', 0, 'C');
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
        $this->Cell($w[1], 4, 'Nama', 'TR', 0, 'C');
        $this->Cell($w[2], 4, 'Departemen', 'TR', 0, 'C');
        $this->Cell($w[3], 4, 'Status', 'TR', 0, 'C');
        $this->Cell($w[4], 4, 'TOTAL', 'TR', 0, 'C');
        $this->Cell($w[4], 4, 'Gaji', 'TR', 0, 'C');
        $this->Cell($w[5] + $w[5] + $w[5] + $w[5] + $w[5], 4, 'Tunjangan', 'TRB', 0, 'C');
        $this->Cell($w[5] + $w[5] + $w[5] + $w[5] + $w[5], 4, 'Potongan', 'TRB', 0, 'C');
        $this->Cell($w[6], 4, 'Keterangan', 'TR', 0, 'C');
        $this->Ln();
        $this->Cell($w[0], 4, '', 'LBR', 0, 'C');
        $this->Cell($w[1], 4, '', 'LR', 0, 'C');
        $this->Cell($w[2], 4, '', 'LR', 0, 'C');
        $this->Cell($w[3], 4, '', 'LR', 0, 'C');
        $this->Cell($w[4], 4, '', 'LR', 0, 'C');
        $this->Cell($w[4], 4, '', 'LR', 0, 'C');
        $this->Cell($w[5], 4, 'Transportasi', 'LR', 0, 'C');
        $this->Cell($w[5], 4, 'Uang Makan', 'LR', 0, 'C');
        $this->Cell($w[5], 4, 'Lain-Lain', 'LR', 0, 'C');
        $this->Cell($w[5], 4, '', 'LR', 0, 'C');
        $this->Cell($w[5], 4, '', 'LR', 0, 'C');
        $this->Cell($w[5], 4, 'Jamsostek', 'LR', 0, 'C');
        $this->Cell($w[5], 4, 'Tabungan', 'LR', 0, 'C');
        $this->Cell($w[5], 4, 'Lain-Lain', 'LR', 0, 'C');
        $this->Cell($w[5], 4, '', 'LR', 0, 'C');
        $this->Cell($w[5], 4, '', 'LR', 0, 'C');
        $this->Cell($w[6], 4, '', 'LR', 0, 'C');
        $this->Ln();
    }

    function report($rows, $yearmonth)
    {
        $w = [6, 30, 30, 17, 14, 14, 26];
        $this->myheader($rows, $w, $yearmonth);
        $type = null;
        $counter = 1;

        foreach ($rows as $row) {
            if ($row['category_id'] != $type) {
                $this->SetFont('Arial', 'B', 8);
                $this->Cell(0, 5, '', 'T', 0);
                $this->Ln();
                $this->Cell(0, 7, $row['category'], 'B', 0);
                $this->Ln();
                $type = $row['category_id'];
            }
            $this->SetFont('Arial', '', 7);
            $this->Cell($w[0], 5, $counter, 'L', 0, 'R');
            $this->Cell($w[1], 5, $row['employee_name'], 'L');
            $this->Cell($w[2], 5, substr($row['department'], 0, 22), 'L');
            $this->Cell($w[3], 5, $row['employee_status'], 'L');
            $this->SetFont('Arial', 'B', 7);
            $this->Cell($w[4], 5, peterFunc::indoFormat(
                $row['basic_salary'] + $row['t_benefit1'] + $row['t_benefit2'] + $row['t_benefit3'] + $row['t_benefit4'] + $row['t_benefit5'] + $row['t_deduction1'] + $row['t_deduction2'] + $row['t_deduction3'] + $row['t_deduction4'] + $row['t_deduction5']
            ), 'LR', 0, 'R');
            $this->SetFont('Arial', '', 7);
            $this->Cell($w[4], 5, peterFunc::indoFormat($row['basic_salary']), 'LR', 0, 'R');
            $this->Cell($w[5], 5, peterFunc::indoFormat($row['t_benefit1']), 'LR', 0, 'R');
            $this->Cell($w[5], 5, peterFunc::indoFormat($row['t_benefit2']), 'LR', 0, 'R');
            $this->Cell($w[5], 5, peterFunc::indoFormat($row['t_benefit3']), 'LR', 0, 'R');
            $this->Cell($w[5], 5, peterFunc::indoFormat($row['t_benefit4']), 'LR', 0, 'R');
            $this->Cell($w[5], 5, peterFunc::indoFormat($row['t_benefit5']), 'LR', 0, 'R');
            $this->Cell($w[5], 5, peterFunc::indoFormat($row['t_deduction1']), 'LR', 0, 'R');
            $this->Cell($w[5], 5, peterFunc::indoFormat($row['t_deduction2']), 'LR', 0, 'R');
            $this->Cell($w[5], 5, peterFunc::indoFormat($row['t_deduction3']), 'LR', 0, 'R');
            $this->Cell($w[5], 5, peterFunc::indoFormat($row['t_deduction4']), 'LR', 0, 'R');
            $this->Cell($w[5], 5, peterFunc::indoFormat($row['t_deduction5']), 'LR', 0, 'R');
            $this->Cell($w[6], 5, $row['remark'], 'LR');
            $this->Ln();
            $counter++;

            if ($this->GetY() > 178) {
                $this->Cell(0, 5, '', 'T');
                $this->AddPage();
                $dept = null;
                $this->myheader($rows, $w, $yearmonth);
                $this->SetFont('Arial', 'B', 8);
                $this->Cell(0, 7, $row['category'], 1, 0);
                $this->Ln();
                $type = $row['category_id'];
            }
        }
        $this->Cell(0, 5, '', 'T');
    }

}

