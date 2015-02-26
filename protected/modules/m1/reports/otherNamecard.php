<?php

class otherNamecard extends fpdf
{

    function report($model)
    {
        $this->y0 = $this->GetY();
        $this->Cell(0, 1, '', 0, 0, 'C');
        $this->Image('shareimages/company/logoAlt1.jpg', 5, 11, 35);
        if ($model->mCompanyLogo() != null)
            $this->Image('shareimages/company/' . $model->mCompanyLogo(), 170, 11, 22);
        $this->SetY($this->y0);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 2, '');
        $this->Ln();
        $this->Cell(25, 5, '');
        $this->Cell(130, 5, 'FORMULIR PERMOHONAN KARTU NAMA', 'B', 0, 'C');
        $this->Ln(5);

        $this->SetFillColor(230, 230, 230);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(25, 2, '');
        $this->Cell(130, 5, $model->mCompany(), 0, 0, 'C');
        $this->Ln(4);

        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 2, '', 'B', 0, 'C');
        $this->Ln();
        $this->Cell(45, 6, 'Nama', 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 6, ':  ' . $model->employee_name, 'R');
        $this->Ln();
        $this->SetFont('Arial', '', 10);
        $this->Cell(45, 6, 'NIK', 'L');
        $this->Cell(0, 6, ':  ' . $model->employeeShortID, 'R');
        $this->Ln();
        $this->Cell(45, 6, 'Tgl Bergabung', 'L');
        $this->Cell(0, 6, ':  ' . $model->companyfirst->start_date, 'R');
        $this->Ln();
        $this->Cell(45, 6, 'Departemen', 'L');
        $this->Cell(0, 6, ':  ' . $model->mDepartment(), 'R');
        $this->Ln();
        $this->Cell(45, 6, 'Jabatan', 'L');
        $this->Cell(0, 6, ':  ' . $model->mJobTitle(), 'R');
        $this->Ln();
        $this->Cell(45, 6, 'No. HP', 'L');
        $this->Cell(0, 6, ':  ' . $model->handphone, 'R');
        $this->Ln();
        $this->Cell(45, 6, 'Email', 'L');
        $this->Cell(0, 6, ':  ' . $model->email, 'R');
        $this->Ln();
        $this->Cell(45, 6, 'Pembebanan', 'L');
        $this->Cell(0, 6, ':  ' . $model->mCompany(), 'R');
        $this->Ln();
        $this->Cell(45, 6, 'Keterangan', 'L');
        $this->Cell(0, 6, ':  ', 'R');
        $this->Ln();
        $this->Cell(0, 14, '', 'LR');
        $this->Ln();
        $this->Cell(0, 6, '', 'T');
        $this->Ln(1);


        $w = [60, 65, 65];

        $this->Cell(0, 1, '', 'B');
        $this->Ln();
        $this->SetFont('Arial', '', 8);
        $this->Cell($w[0], 4, 'Diajukan oleh:', 'LTR', 0, 'C', true);
        $this->Cell($w[1], 4, 'Pengganti oleh:', 'LTR', 0, 'C', true);
        $this->Cell($w[2], 4, 'Disetujui oleh:', 'LTR', 0, 'C', true);
        $this->Ln();
        $this->Cell($w[0], 22, '', 'LR');
        $this->Cell($w[1], 22, '', 'LR');
        $this->Cell($w[2], 22, '', 'LR', 0, 'C');
        $this->Ln();
        $this->SetFont('Arial', '', 8);
        $this->Cell($w[0], 5, $model->employee_name, 1, 0, 'C');
        $this->Cell($w[1], 5, '', 1, 0, 'C');
        $this->Cell($w[2], 5, 'Nama: ', 1);
        $this->Ln();
        $this->Cell($w[0], 4, date('d-m-Y'), 'LTR', 0, 'C');
        $this->Cell($w[1], 4, '', 'LTR', 0, 'C');
        $this->Cell($w[2], 4, 'Tanggal:', 'LTR');
        $this->Ln();
        $this->SetFont('Arial', 'B', 8);
        $this->Cell($w[0], 4, 'Karyawan', 'LBR', 0, 'C', true);
        $this->Cell($w[1], 4, 'Atasan', 'LBR', 0, 'C', true);
        $this->Cell($w[2], 4, 'HR', 'LBR', 0, 'C', true);
        $this->Ln(6);
    }

}

