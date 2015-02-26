<?php

class leaveForm extends fpdf
{

    function report($model)
    {
        $this->y0 = $this->GetY();
        $this->Cell(0, 1, '', 0, 0, 'C');
        $this->Image('shareimages/company/logoAlt1.jpg', 5, 11, 35);
        if ($model->person->mCompanyLogo() != null)
            $this->Image('shareimages/company/' . $model->person->mCompanyLogo(), 170, 11, 22);
        $this->SetY($this->y0);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 2, '');
        $this->Ln();
        $this->Cell(25, 5, '');
        $this->Cell(130, 5, 'FORMULIR PERMOHONAN CUTI KARYAWAN', 'B', 0, 'C');
        $this->Ln(5);

        $this->SetFillColor(230, 230, 230);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(25, 2, '');
        $this->Cell(130, 5, $model->person->mCompany(), 0, 0, 'C');
        $this->Ln(4);

        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 2, '', 'B', 0, 'C');
        $this->Ln();
        $this->Cell(25, 5, 'Nama', 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 5, ':  ' . $model->person->employee_name);
        $this->SetFont('Arial', '', 10);
        $this->Cell(15, 5, 'NIK');
        $this->Cell(35, 5, ':  ' . $model->person->employeeShortID);
        $this->Cell(25, 5, 'Tgl Bergabung');
        $this->Cell(20, 5, ':  ' . $model->person->companyfirst->start_date);
        $this->Cell(0, 5, '', 'R');
        $this->Ln();
        $this->Cell(25, 5, 'Departemen', 'L');
        $this->Cell(60, 5, ':  ' . $model->person->mDepartment());
        $this->Cell(15, 5, 'Jabatan');
        $this->Cell(80, 5, ':  ' . $model->person->mJobTitle());
        $this->Cell(0, 5, '', 'R');
        $this->Ln();
        $this->Cell(0, 5, '', 'T');
        $this->Ln(1);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 5, 'CUTI TAHUNAN', 'LTR', 0, 'C', true);
        $this->Ln();
        $this->SetFont('Arial', '', 10);
        //$this->Cell(0,6,'CUTI TAHUNAN','LR');
        //$this->Ln();
        $this->Cell(50, 5, 'Akan Mengambil Cuti dari', 'L');
        $this->Cell(10, 5, ': Tgl ');
        $this->Cell(22, 5, $model->start_date);
        $this->Cell(10, 5, 's/d');
        $this->Cell(20, 5, $model->end_date);
        $this->Cell(0, 5, '', 'R');
        $this->Ln();
        $this->Cell(50, 5, 'Jumlah Hari Kerja', 'L');
        $this->Cell(10, 5, ': ' . $model->number_of_day . '  Hari');
        $this->Cell(0, 5, '', 'R');
        $this->Ln();
        $this->Cell(50, 5, 'Masuk Bekerja Kembali', 'L');
        //$this->Cell(40,6,': Hari  '.Yii::app()->dateFormatter->format("EEEE",strtotime($model->work_date)));
        $this->Cell(23, 5, ': Hari  ' . peterFunc::convertHari((int)date("w", strtotime($model->work_date))));
        $this->Cell(8, 5, ' Tgl');
        $this->Cell(25, 5, $model->work_date);
        $this->Cell(37, 5, 'Pengganti selama cuti');
        $this->Cell(0, 5, ': ' . $model->replacement, 'R');
        $this->Ln();
        $this->Cell(50, 5, 'Alasan Cuti', 'L');
        $this->Cell(0, 5, ': ' . $model->leave_reason, 'R');
        $this->Ln();

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 5, 'Hak Cuti', 'LRT', 0, 'C', true);
        $this->Ln();
        $this->SetFont('Arial', '', 10);


        $this->Cell(140, 5, 'I.   Total Hak Cuti Tahunan ( + perpanjangan cuti , jika ada) periode tahun:  ' . date("Y", strtotime(date("d-m-Y") . "-1 year")) . ' / ' . date("Y"), 'L');
        $this->Cell(5, 5, ': ');

        if (strtotime($model->start_date) >= strtotime($model->person->companyfirst->start_date . "+1 year")) {
            if ((int)$model->person->leaveGenerated->balance > 12) {
                $cJoinDate = (int)$model->person->leaveGenerated->balance;
            } else
                $cJoinDate = 12;
        } else
            $cJoinDate = 0;


        $this->Cell(10, 5, $cJoinDate, '', 0, 'R');
        $this->Cell(0, 5, 'Hari', 'R');
        $this->Ln();
        $this->Cell(140, 5, 'II.  Cuti yang telah diambil', 'L');
        $this->Cell(5, 5, '');
        $this->Cell(10, 5, '', '', 0, 'R');
        $this->Cell(0, 5, '', 'R');
        $this->Ln();
        $this->SetFont('Arial', 'I', 9);
        $this->Cell(110, 4, '            1. Hutang Cuti Periode sebelumnya', 'L');
        $this->Cell(5, 4, ': ');
        $this->Cell(10, 4, (int)$cJoinDate - $model->person->leaveGenerated->balance, '', 0, 'R');
        //$this->Cell(10, 4, '', '', 0, 'R');
        $this->Cell(0, 4, 'Hari', 'R');
        $this->Ln();
        $this->Cell(110, 4, '            2. Cuti Masal + Cuti Pribadi ', 'L');
        $this->Cell(5, 4, ': ');
        $this->Cell(10, 4, $model->person->leaveGenerated->balance - $model->person->leaveBalance->balance, '', 0, 'R');
        //$this->Cell(10, 4, '', '', 0, 'R');
        $this->Cell(0, 4, 'Hari', 'R');
        $this->Ln();
        //$this->Cell(110, 4, '            3. Cuti Pribadi', 'L');
        //$this->Cell(5, 4, ': ');
        //$this->Cell(10, 4, $model->person->leaveGenerated->person_leave - $model->person->leaveBalance->person_leave, '', 0, 'R');
        //$this->Cell(10, 4, '', '', 0, 'R');
        //$this->Cell(0, 4, 'Hari', 'R');
        //$this->Ln();
        $this->SetFont('Arial', '', 10);
        $this->Cell(140, 5, '      Total Cuti yang telah diambil', 'L');
        $this->Cell(5, 5, ': ', 'B');
        $this->Cell(10, 5, (int)$cJoinDate - (int)$model->person->leaveBalance->balance, 'B', 0, 'R');
        $this->Cell(10, 5, 'Hari', 'B');
        $this->Cell(0, 5, '', 'R');
        $this->Ln();
        $this->Cell(5, 5, '', 'L');
        $this->Cell(135, 5, ' Sisa Cuti yang bisa diambil', 'B');
        $this->Cell(5, 5, ': ', 'B');
        $this->Cell(10, 5, $model->person->leaveBalance->balance, 'B', 0, 'R');
        $this->Cell(10, 5, 'Hari', 'B');
        $this->Cell(0, 5, '', 'R');
        $this->Ln();
        $this->Cell(140, 5, 'III.  Pengajuan Cuti yang akan diambil', 'L');
        $this->Cell(5, 5, ': ');
        $this->Cell(10, 5, $model->number_of_day, '', 0, 'R');
        $this->Cell(0, 5, 'Hari', 'R');
        $this->Ln();
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(140, 5, 'IV.  Sisa Cuti', 'LB');
        $this->Cell(5, 5, ': ', 'B');
        $this->Cell(10, 5, $model->person->leaveBalance->balance - $model->number_of_day, 'B', 0, 'R');
        $this->Cell(0, 5, 'Hari', 'BR');
        $this->Ln();

        $this->SetFont('Arial', '', 8);
        $this->Cell(15, 4, 'Catatan: ', 'LB');
        $this->Cell(0, 4, '  1. Menyerahkan kewajiban pekerjaan kepada pengganti sementara', 'RB');
        $this->Ln(4);
        //$this->Cell(0, 4, '  2. Cuti diluar tanggungan atau cuti yang melebihi hak cuti akan diperhitungkan dalam upah bulan berikutnya', 'LR');
        //$this->Ln();

        $w = [48, 42, 47, 53];

        $this->Cell(0, 1, '', 'B');
        $this->Ln();
        $this->SetFont('Arial', '', 8);
        $this->Cell($w[0], 4, 'Diajukan oleh:', 'LTR', 0, 'C', true);
        $this->Cell($w[1], 4, 'Pengganti oleh:', 'LTR', 0, 'C', true);
        $this->Cell($w[2], 4, 'Disetujui oleh:', 'LTR', 0, 'C', true);
        $this->Cell($w[3], 4, 'Diketahui oleh:', 'LTR', 0, 'C', true);
        $this->Ln();
        $this->Cell($w[0], 17, '', 'LR');
        $this->Cell($w[1], 17, '', 'LR');
        $this->Cell($w[2], 17, ($model->superior_approved_id == 2) ? 'ONLINE APPROVED' : '', 'LR', 0, 'C');
        $this->Cell($w[3], 17, '', 'LR');
        $this->Ln();
        $this->SetFont('Arial', '', 8);
        $this->Cell($w[0], 5, $model->person->employee_name, 1, 0, 'C');
        $this->Cell($w[1], 5, $model->replacement, 1, 0, 'C');
        if ($model->superior_approved_id == 1) {
            $this->Cell($w[2], 5, 'Nama: ', 1);
        } else
            $this->Cell($w[2], 5, (isset($model->updated)) ? $model->updated->sso() : '', 1, 0, 'C');
        $this->Cell($w[3], 5, 'Nama:', 1);
        $this->Ln();
        $this->Cell($w[0], 4, $model->input_date, 'LTR', 0, 'C');
        $this->Cell($w[1], 4, $model->input_date, 'LTR', 0, 'C');
        $this->Cell($w[2], 4, 'Tanggal:', 'LTR');
        $this->Cell($w[3], 4, 'Tanggal:', 'LTR');
        $this->Ln();
        $this->SetFont('Arial', 'B', 8);
        $this->Cell($w[0], 4, 'Karyawan', 'LBR', 0, 'C', true);
        $this->Cell($w[1], 4, 'Pengganti', 'LBR', 0, 'C', true);
        $this->Cell($w[2], 4, 'Atasan Terkait', 'LBR', 0, 'C', true);
        $this->Cell($w[3], 4, 'Pihak HR', 'LBR', 0, 'C', true);
        $this->Ln(6);
        if ($model->superior_approved_id == 2) {
            $this->Cell(0, 4, (isset($model->updated)) ? "THIS LEAVE HAS BEEN APPROVED BY: " . $model->updated->sso() : 'THIS LEAVE HAS BEEN APPROVED', 'LTR', 0, 'C');
            $this->Ln();
            $this->Cell(0, 4, "Ref: " . substr($model->activation_code, 0, 20) . " at " . date("d-m-Y", $model->updated_date), 'LBR', 0, 'C');
        }
    }

}

