<?php

class medicalForm extends fpdf
{

    function report($model)
    {
        $this->y0 = $this->GetY();
        $this->Cell(0, 1, '', 'T', 0, 'C');
        $this->Image('shareimages/company/logoAlt1.jpg', 15, 11, 22);
        if ($model->person->mCompanyLogo() != null)
            $this->Image('shareimages/company/' . $model->person->mCompanyLogo(), 170, 11, 22);
        $this->SetY($this->y0);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 3, '', 'LR');
        $this->Ln();
        $this->Cell(10, 3, '', 'L');
        $this->Cell(160, 3, 'FORMULIR PENGGANTIAN TUNJANGAN KESEHATAN', 0, 0, 'C');
        $this->Cell(0, 3, '', 'R');
        $this->Ln();
        $this->Cell(0, 3, '', 'LBR');
        $this->Ln(5);

        $this->SetFillColor(230, 230, 230);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 8, $model->person->mCompany(), 0, 0, 'C', true);
        $this->Ln(4);

        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, '', 'B', 0, 'C');
        $this->Ln();
        $this->Cell(25, 8, 'Nama', 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 8, ':  ' . $model->person->employee_name);
        $this->SetFont('Arial', '', 10);
        $this->Cell(15, 8, 'NIK');
        $this->Cell(35, 8, ':  ' . $model->person->employeeShortID);
        $this->Cell(25, 8, 'Tgl Bergabung');
        $this->Cell(20, 8, ':  ' . $model->person->companyfirst->start_date);
        $this->Cell(0, 8, '', 'R');
        $this->Ln();
        $this->Cell(25, 6, 'Departemen', 'L');
        $this->Cell(60, 6, ':  ' . $model->person->mDepartment());
        $this->Cell(15, 6, 'Jabatan');
        $this->Cell(80, 6, ':  ' . $model->person->mJobTitle());
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(0, 6, '', 'T');
        $this->Ln(1);

        $this->SetFillColor(230, 230, 230);
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 2, '', 'LTR');
        $this->Ln();
        $this->Cell(40, 6, 'Pengajuan penggantian pengobatan untuk:', 'L');
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(60, 6, 'Nama  ', 'L');
        $this->Cell(0, 6, ': ' . $model->medicalForPlus . " (" . $model->medicalForPlusR . ")");
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(60, 6, 'Jenis Medical  ', 'L');
        $this->Cell(30, 6, ': ' . $model->medical_type->name);
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(60, 6, 'Diagnosa', 'L');
        $this->Cell(10, 6, ': ' . $model->sympthom);
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 6, 'Total Pengajuan 100%', 'L');
        $this->Cell(0, 6, ': Rp. ' . peterFunc::indoFormat($model->original_amount), 'R');
        if ($model->medical_type->medical_company_id == 1) {
            $this->Ln();
            $this->Cell(60, 6, 'Penggantian Perusahaan 85%', 'L');
            $this->Cell(0, 6, ': Rp. ' . peterFunc::indoFormat($model->original_amount * 0.85), 'R');
        }

        $this->Ln();
        $this->SetFont('Arial', '', 8);
        $this->Cell(15, 6, 'Catatan', 'L');
        $this->Cell(0, 6, '- Lampiran asli kuitansi Dokter/Apotik/Rumah Sakit/Laboratorium yang', 'R');
        $this->Ln(4);
        $this->Cell(15, 6, '', 'L');
        $this->Cell(0, 6, '- Copy Resep', 'R');
        $this->Ln();
        $this->Cell(0, 2, '', 'LBR');
        $this->Ln();

        $w = [63, 63, 64];

        $this->Cell(0, 1, '', 'B');
        $this->Ln();
        $this->SetFont('Arial', '', 9);
        $this->Cell($w[0], 5, 'Diajukan oleh:', 'LTR', 0, 'C', true);
        $this->Cell($w[1], 5, 'Disetujui oleh:', 'LTR', 0, 'C', true);
        $this->Cell($w[2], 5, 'Diketahui oleh:', 'LTR', 0, 'C', true);
        $this->Ln();
        $this->Cell($w[0], 25, '', 'LR');
        $this->Cell($w[1], 25, '', 'LR');
        $this->Cell($w[2], 25, '', 'LR');
        $this->Ln();
        $this->SetFont('Arial', '', 8);
        $this->Cell($w[0], 6, 'Nama:  ' . $model->person->employee_name, 1);
        $this->Cell($w[1], 6, 'Nama:', 1);
        $this->Cell($w[2], 6, 'Nama:', 1);
        $this->Ln();
        $this->Cell($w[0], 5, 'Tanggal:  ' . $model->input_date, 'LTR');
        $this->Cell($w[1], 5, 'Tanggal:', 'LTR');
        $this->Cell($w[2], 5, 'Tanggal:', 'LTR');
        $this->Ln();
        $this->SetFont('Arial', 'B', 8);
        $this->Cell($w[0], 4, 'Karyawan', 'LBR', 0, 'C', true);
        $this->Cell($w[1], 4, 'Atasan Terkait', 'LBR', 0, 'C', true);
        $this->Cell($w[2], 4, 'Pihak HR', 'LBR', 0, 'C', true);
    }

}

