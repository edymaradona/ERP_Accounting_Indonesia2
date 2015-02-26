<?php

class leaveSwitchoverForm extends fpdf
{

    function report($model)
    {
        $this->y0 = $this->GetY();
        $this->Cell(0, 5, '', 'T', 0, 'C');
        $this->Image('shareimages/company/logoAlt1.jpg', 15, 12, 30);
        $this->SetY($this->y0);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 5, '', 'LR');
        $this->Ln();
        $this->Cell(30, 5, '', 'L');
        $this->Cell(0, 5, 'FORMULIR PENAMBAHAN CUTI MASUK HARI LIBUR', 'R', 0, 'C');
        $this->Ln();
        $this->Cell(0, 5, '', 'LBR');
        $this->Ln(1);

        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, '', 'B', 0, 'C');
        $this->Ln();
        $this->Cell(35, 8, 'Nama', 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(80, 8, ':  ' . $model->person->employee_name);
        $this->SetFont('Arial', '', 10);
        $this->Cell(40, 8, 'NIK');
        $this->Cell(60, 8, ':  ' . $model->person->employeeShortID);
        $this->Cell(0, 8, '', 'R');
        $this->Ln();
        $this->Cell(35, 6, 'Departemen', 'L');
        $this->Cell(80, 6, ':  ' . $model->person->mDepartment());
        $this->Cell(40, 6, 'Tanggal Bergabung');
        $this->Cell(40, 6, ':  ' . $model->person->companyfirst->start_date);
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(35, 6, 'Jabatan', 'L');
        $this->Cell(80, 6, ':  ' . $model->person->mJobTitle());
        $this->Cell(0, 6, '', 'R');
        $this->Ln(6);
        $this->Cell(0, 6, '', 'T');
        $this->Ln(1);

        $this->SetFillColor(230, 230, 230);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 6, 'PERPANJANGAN CUTI', 'LTR', 0, 'C', true);
        $this->Ln();
        $this->SetFont('Arial', '', 10);
        //$this->Cell(0,6,'CUTI TAHUNAN','LR');
        //$this->Ln();
        //$this->Cell(0, 5, 'Mengajukan permohonan perpanjangan masa berlaku sisa cuti tahunan (sesuai dengan Peraturan Perusahaan', 'LR');
        //$this->Ln();
        //$this->Cell(0, 5, 'pasal 18 ayat 2):', 'LR');
        //$this->Ln();
        $this->Cell(0, 5, '', 'LR');
        $this->Ln();
        $this->Cell(60, 6, 'Periode Cuti', 'L');
        $this->Cell(10, 6, ': ' . date('Y', strtotime(date("Y-m-d") . ' -1 year')) . ' - ' . date('Y'));
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(60, 6, 'Tanggal Masuk Libur', 'L');
        $this->Cell(20, 6, ': ' . $model->start_date);
        $this->Cell(0, 6, ' s/d  ' . $model->end_date, 'R');
        $this->Ln();
        $this->Cell(60, 6, 'Total Hari Penambahan Cuti ', 'L');
        $this->Cell(0, 6, ': ' . $model->number_of_day, 'R');
        $this->Ln();

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 6, 'Alasan', 'LRT', 0, 'C', true);
        $this->Ln();
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, $model->leave_reason, 'LR');
        $this->Ln();

        $w = [63, 63, 64];

        $this->Cell(0, 1, '', 'B');
        $this->Ln();
        $this->SetFont('Arial', '', 10);
        $this->Cell($w[0], 5, 'Diajukan oleh:', 'LTR', 0, 'C', true);
        $this->Cell($w[1], 5, 'Disetujui oleh:', 'LTR', 0, 'C', true);
        $this->Cell($w[2], 5, 'Diketahui oleh:', 'LTR', 0, 'C', true);
        $this->Ln();
        $this->Cell($w[0], 25, '', 'LR');
        $this->Cell($w[1], 25, '', 'LR');
        $this->Cell($w[2], 25, '', 'LR');
        $this->Ln();
        $this->SetFont('Arial', '', 8);
        $this->Cell($w[0], 8, $model->person->employee_name, 1, 0, 'C');
        $this->Cell($w[1], 8, 'Nama:', 1);
        $this->Cell($w[2], 8, 'Nama:', 1);
        $this->Ln();
        $this->Cell($w[0], 6, $model->input_date, 'LTR', 0, 'C');
        $this->Cell($w[1], 6, 'Tanggal:', 'LTR');
        $this->Cell($w[2], 6, 'Tanggal:', 'LTR');
        $this->Ln();
        $this->SetFont('Arial', 'B', 8);
        $this->Cell($w[0], 4, 'Karyawan', 'LBR', 0, 'C', true);
        $this->Cell($w[1], 4, 'Atasan Terkait', 'LBR', 0, 'C', true);
        $this->Cell($w[2], 4, 'Pihak HR', 'LBR', 0, 'C', true);
    }

}

