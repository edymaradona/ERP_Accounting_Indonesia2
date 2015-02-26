<?php

class permissionSummaryByDept extends fpdf
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
        $this->Cell(0, 5, 'DAFTAR IJIN KARYAWAN', 'R', 0, 'C');
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
        $this->SetFont('Arial', 'B', 7);
        $this->Cell($w[0], 4, 'No', 1, 0, 'C');
        $this->Cell($w[1], 4, 'Nama', 1, 0, 'C');
        $this->Cell($w[2], 4, 'Departmen', 1, 0, 'C');
        $this->Cell($w[3], 4, 'Dari Tanggal', 1, 0, 'C');
        $this->Cell($w[4], 4, 's/d Tanggal', 1, 0, 'C');
        $this->Cell($w[5], 4, 'Alasan', 1, 0, 'C');
        $this->Ln();
    }

    function report($rows, $model)
    {
        $w = [8, 49, 50, 30, 30, 110];
        $this->myheader($rows, $w, $model);
        $type = null;
        $counter = 1;
        $checkname = "";

        foreach ($rows as $row) {
            if ($row['permission_type_id'] != $type) {
                if ($type != null) {
                    $this->Cell(0, 5, '', 'T');
                    $this->AddPage();
                    $this->myheader($rows, $w, $model);
                    $counter = 1;
                }
                $this->SetFont('Arial', 'B', 9);
                $this->Cell(0, 7, $row['name'], 1, 0, 'C');
                $this->Ln();
                $type = $row['permission_type_id'];
            }
            $this->SetFont('Arial', '', 9);
            $this->Cell($w[0], 7, $counter, 'L', 0, 'R');
            if ($checkname != $row['employee_name']) {                    
                $this->Cell($w[1], 7, $row['employee_name'], 'L');
                $this->Cell($w[2], 7, substr($row['department'], 0, 30), 'LR');
            } else {
                $this->Cell($w[1], 7, '', 'L');
                $this->Cell($w[2], 7, '', 'LR');
            }

            $checkname = $row['employee_name'];

            $this->Cell($w[3], 7, date('d-m-Y h:i', strtotime($row['start_date'])), 'L');
            $this->Cell($w[4], 7, date('d-m-Y h:i', strtotime($row['end_date'])), 'L');
            $this->Cell($w[5], 7, $row['permission_reason'], 'LR');
            $this->Ln();
            $counter++;

            if ($this->GetY() > 178) {
                $this->Cell(0, 5, '', 'T');
                $this->AddPage();
                $dept = null;
                $this->myheader($rows, $w, $model);
                $this->SetFont('Arial', 'B', 9);
                $this->Cell(0, 7, $row['name'], 1, 0, 'C');
                $this->Ln();
                $type = $row['permission_type_id'];
            }
        }
        $this->Cell(0, 5, '', 'T');
    }

}

