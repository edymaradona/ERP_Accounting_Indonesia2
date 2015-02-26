<?php

class medicalSummary extends fpdf
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
        $this->Cell(0, 5, 'INFORMASI MEDICAL KARYAWAN', 'R', 0, 'C');
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
        $w = [20, 20, 20, 30, 27, 33, 20, 20];

        $this->Cell(0, 1, '', 'B');
        $this->Ln();
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[0], 4, 'Tanggal', 'LTR', 0, 'C');
        $this->Cell($w[1], 4, 'Tanggal', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, 'Tanggal', 'LTR', 0, 'C');
        $this->Cell($w[3], 4, 'Tertanggung', 'LTR', 0, 'C');
        $this->Cell($w[4], 4, 'Tipe', 'LTR', 0, 'C');
        $this->Cell($w[5], 4, 'Gejala', 'LTR', 0, 'C');
        $this->Cell($w[6], 4, 'Jumlah', 'LTR', 0, 'C');
        $this->Cell($w[7], 4, 'Jumlah', 'LTR', 0, 'C');
        $this->Ln();
        $this->Cell($w[0], 4, 'Nota', 'BLR', 0, 'C');
        $this->Cell($w[1], 4, 'Process', 'BLR', 0, 'C');
        $this->Cell($w[2], 4, 'Settlement', 'BLR', 0, 'C');
        $this->Cell($w[3], 4, '', 'BLR', 0, 'C');
        $this->Cell($w[4], 4, 'Medical', 'BLR', 0, 'C');
        $this->Cell($w[5], 4, '', 'BLR', 0, 'C');
        $this->Cell($w[6], 4, 'Pengajuan', 'BLR', 0, 'C');
        $this->Cell($w[7], 4, 'Disetujui', 'BLR', 0, 'C');
        $this->Ln();
        $this->SetFont('Arial', '', 9);
        foreach ($models->medical as $model) {
            $this->Cell($w[0], 5, $model->receipt_date, 'LR', 0, 'C');
            $this->Cell($w[1], 5, $model->process_date, 'LR', 0, 'C');
            $this->Cell($w[2], 5, $model->settlement_date, 'LR', 0, 'L');
            $this->Cell($w[3], 5, $model->medicalForPlusR, 'LR', 0, 'L');
            $this->Cell($w[4], 5, (isset($model->medical_type)) ? $model->medical_type->name : "", 'LR');
            $this->Cell($w[5], 5, $model->sympthom, 'LR', 0, 'L');
            $this->Cell($w[6], 5, peterFunc::indoFormat($model->original_amount), 'LR', 0, 'R');
            $this->Cell($w[7], 5, peterFunc::indoFormat($model->approved_amount), 'LR', 0, 'R');
            $this->Ln();

            if ($this->GetY() > 265) {
                $this->Cell(0, 5, '', 'T');
                $this->AddPage();
                $this->myheader($models);
            }
        }
        $this->Cell(0, 5, '', 'T');
    }

}

