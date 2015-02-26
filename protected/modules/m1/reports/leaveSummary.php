<?php

class leaveSummary extends fpdf
{

    public function myheader($models)
    {
        $this->y0 = $this->GetY();
        $this->Cell(0, 5, '', 'T', 0, 'C');
        $this->Image('shareimages/company/logoAlt1.jpg', 15, 12, 30);
        $this->SetY($this->y0);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 5, '', 'LR');
        $this->Ln();
        $this->Cell(30, 5, '', 'L');
        $this->Cell(0, 5, 'PERHITUNGAN CUTI TAHUNAN KARYAWAN', 'R', 0, 'C');
        $this->Ln();
        $this->Cell(0, 5, '', 'LBR');
        $this->Ln(1);

        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, '', 'B', 0, 'C');
        $this->Ln();
        $this->Cell(35, 8, 'Nama', 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(80, 8, ':   ' . $models->employee_name);
        $this->SetFont('Arial', '', 10);
        $this->Cell(40, 8, 'NIK');
        $this->Cell(40, 8, ": " . $models->employeeShortID);
        $this->Cell(0, 8, '', 'R');
        $this->Ln();
        $this->Cell(35, 6, 'Departemen', 'L');
        $this->Cell(80, 6, ':  ' . $models->mDepartment());
        $this->Cell(40, 6, 'Tanggal Bergabung');
        $this->Cell(40, 6, ':  ' . $models->companyfirst->start_date);
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(35, 6, 'Jabatan', 'L');
        $this->Cell(80, 6, ':  ' . $models->mJobTitle());
        $this->Cell(0, 6, '', 'R');
        $this->Ln(6);
        $this->Cell(0, 6, '', 'T');
        $this->Ln(1);
    }

    function report($models)
    {
        $this->myheader($models);

        $this->SetFillColor(230, 230, 230);
        $w = [10, 10, 23, 23, 23, 23, 78];

        $this->Cell(0, 1, '', 'B');
        $this->Ln();
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[0] + $w[1], 4, 'Tanggal', 'LTR', 0, 'C');
        $this->Cell($w[2] + $w[3], 4, 'Tgl Cuti', 'LTR', 0, 'C');
        $this->Cell($w[4], 4, 'Cuti', 'LTR', 0, 'C');
        $this->Cell($w[5], 4, 'Sisa', 'LTR', 0, 'C');
        $this->Cell($w[6], 4, 'Keterangan', 'LTR', 0, 'C');
        $this->Ln();
        $this->Cell($w[0] + $w[1], 4, 'Hak Cuti', 'BLR', 0, 'C');
        $this->Cell($w[2] + $w[3], 4, '', 'BLR', 0, 'C');
        $this->Cell($w[4], 4, 'diambil', 'BLR', 0, 'C');
        $this->Cell($w[5], 4, 'Cuti', 'BLR', 0, 'C');
        $this->Cell($w[6], 4, '', 'BLR', 0, 'C');
        $this->Ln();
        $this->SetFont('Arial', '', 9);
        foreach ($models->leave as $model) {
            if ($model->approved_id == 9) {
                $this->Cell($w[0] + $w[1], 7, $model->start_date, 'LBR', 0, 'L', true);
                $this->Cell($w[2], 7, '', 'LB', 0, 'L', true);
                $this->Cell($w[3], 7, '', 'B', 0, 'L', true);
                $this->Cell($w[4], 7, '', 'B', 0, 'L', true);
                $this->Cell($w[5], 7, $model->balance, 'BLR', 0, 'C', true);
                $this->Cell($w[6], 7, '', 'BLR', 0, 'L', true);
                $this->Ln();
            } else {
                $this->Cell($w[0] + $w[1], 5, '', 'L');
                $this->Cell($w[2], 5, $model->start_date, 'LR', 0, 'C');
                $this->Cell($w[3], 5, $model->end_date, 'LR', 0, 'C');
                $this->Cell($w[4], 5, $model->number_of_day, 'LR', 0, 'C');
                $this->Cell($w[5], 5, $model->balance, 'LR', 0, 'C');
                $this->Cell($w[6], 5, (strlen($model->leave_reason) >= 45) ? substr($model->leave_reason, 0, 45) . ' ...' : $model->leave_reason, 'LR');
                $this->Ln();
            }

            if ($this->GetY() > 265) {
                $this->Cell(0, 5, '', 'T');
                $this->AddPage();
                $this->myheader($models);
            }
        }
        $this->Cell(0, 5, '', 'T');
    }

}

