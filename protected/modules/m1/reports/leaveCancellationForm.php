<?php

class leaveCancellationForm extends fpdf
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
        $this->Cell(0, 5, 'FORMULIR PEMBATALAN CUTI KARYAWAN', 'R', 0, 'C');
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
        $this->Cell(50, 8, 'NRK');
        $this->Cell(60, 8, '');
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
        $this->Cell(0, 6, 'CUTI TAHUNAN', 'LTR', 0, 'C', true);
        $this->Ln();
        $this->SetFont('Arial', '', 10);
        //$this->Cell(0,6,'CUTI TAHUNAN','LR');
        //$this->Ln();
        $this->Cell(60, 6, 'Cuti yang dibatalkan', 'L');
        $this->Cell(10, 6, ': Tgl ');
        $this->Cell(30, 6, $model->start_date);
        $this->Cell(10, 6, 's/d');
        $this->Cell(30, 6, $model->end_date);
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(60, 6, 'Jumlah Hari Kerja', 'L');
        $this->Cell(10, 6, ': ' . $model->number_of_day . '  Hari');
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(60, 6, 'Alasan Pembatalan', 'L');
        $this->Cell(0, 6, ': ' . $model->leave_reason, 'R');
        $this->Ln();

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 6, 'Hak Cuti', 'LRT', 0, 'C', true);
        $this->Ln();
        $this->SetFont('Arial', '', 10);
        $this->Cell(140, 6, 'I.   Total Hak Cuti Tahunan periode tahun', 'L');
        $this->Cell(5, 6, ': ');
        $this->Cell(10, 6, '12', '', 0, 'R');
        $this->Cell(0, 6, 'Hari', 'R');
        $this->Ln();
        $this->Cell(140, 5, 'II.  Cuti yang telah diambil', 'L');
        $this->Cell(5, 5, '');
        $this->Cell(10, 5, '', '', 0, 'R');
        $this->Cell(0, 5, '', 'R');
        $this->Ln();
        $this->SetFont('Arial', 'I', 9);
        $this->Cell(110, 4, '            1. Hutang Cuti Tahun lalu', 'L');
        $this->Cell(5, 4, ': ');
        $this->Cell(10, 4, 12 - $model->person->leaveGenerated->balance, '', 0, 'R');
        $this->Cell(0, 4, 'Hari', 'R');
        $this->Ln();
        $this->Cell(110, 4, '            2. Cuti Masal', 'L');
        $this->Cell(5, 4, ': ');
        $this->Cell(10, 4, $model->person->leaveGenerated->mass_leave - $model->person->leaveBalance->mass_leave, '', 0, 'R');
        $this->Cell(0, 4, 'Hari', 'R');
        $this->Ln();
        $this->Cell(110, 4, '            3. Cuti Pribadi', 'L');
        $this->Cell(5, 4, ': ');
        $this->Cell(10, 4, $model->person->leaveGenerated->person_leave - $model->person->leaveBalance->person_leave, '', 0, 'R');
        $this->Cell(0, 4, 'Hari', 'R');
        $this->Ln();
        $this->SetFont('Arial', '', 10);
        $this->Cell(140, 5, '      Total Cuti yang telah diambil', 'L');
        $this->Cell(5, 5, ': ', 'B');
        $this->Cell(10, 5, 12 - (int)$model->person->leaveBalance->balance, 'B', 0, 'R');
        $this->Cell(10, 5, 'Hari', 'B');
        $this->Cell(0, 5, '', 'R');
        $this->Ln();
        $this->Cell(5, 5, '', 'L');
        $this->Cell(135, 5, ' Sisa Cuti saat ini', 'B');
        $this->Cell(5, 5, ': ', 'B');
        $this->Cell(10, 5, $model->person->leaveBalance->balance, 'B', 0, 'R');
        $this->Cell(10, 5, 'Hari', 'B');
        $this->Cell(0, 5, '', 'R');
        $this->Ln();
        $this->Cell(140, 6, 'III.  Cuti yang dikembalikan', 'L');
        $this->Cell(5, 6, ': ');
        $this->Cell(10, 6, $model->number_of_day, '', 0, 'R');
        $this->Cell(0, 6, 'Hari', 'R');
        $this->Ln();
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(140, 6, 'IV.  Cuti yang baru', 'LB');
        $this->Cell(5, 6, ': ', 'B');
        $this->Cell(10, 6, $model->person->leaveBalance->balance + $model->number_of_day, 'B', 0, 'R');
        $this->Cell(0, 6, 'Hari', 'BR');
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

