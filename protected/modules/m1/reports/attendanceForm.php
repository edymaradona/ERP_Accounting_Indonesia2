<?php

class attendanceForm extends fpdf
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
        $this->Cell(15, 3, '', 'L');
        $this->Cell(155, 3, 'FORMULIR PERMOHONAN TUKAR JADWAL KERJA', 0, 0, 'C');
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
        $this->Cell(60, 10, 'Dengan ini mengajukan pertukaran jadwal kerja:', 'L');
        $this->Cell(0, 10, '', 'R');
        $this->Ln();
        $this->Cell(30, 6, 'Tanggal  ', 'L');
        $this->Cell(40, 6, ': ' . peterFunc::convertHari(date('N', strtotime($model->cdate))) . ", " . Yii::app()->dateFormatter->format("dd-MM-yyyy", strtotime($model->cdate)));
        $this->Cell(30, 6, '   =======>  ');
        $this->Cell(40, 6, peterFunc::convertHari(date('N', strtotime($model->cdate))) . ", " . Yii::app()->dateFormatter->format("dd-MM-yyyy", strtotime($model->cdate)));
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(30, 6, 'Nama Jadwal  ', 'L');
        $this->Cell(40, 6, ': ' . $model->realpattern->code);
        $this->Cell(30, 6, '   =======>  ');
        $this->Cell(40, 6, $model->changepattern->code);
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(30, 6, 'Pukul  ', 'L');
        $this->Cell(40, 6, ($model->realpattern_id != 90) ? ': ' . Yii::app()->dateFormatter->format("HH:mm", strtotime($model->realpattern->in))
            . ' s/d ' . Yii::app()->dateFormatter->format("HH:mm", strtotime($model->realpattern->out)) : '');
        $this->Cell(30, 6, '   =======>  ');
        $this->Cell(40, 6, ($model->changepattern_id != 90) ? Yii::app()->dateFormatter->format("HH:mm", strtotime($model->changepattern->in))
            . ' s/d ' . Yii::app()->dateFormatter->format("HH:mm", strtotime($model->changepattern->out)) : '');
        $this->Cell(0, 6, '', 'R');
        $this->Ln(6);
        $this->SetFont('Arial', '', 10);
        $this->Cell(15, 6, 'Alasan: ', 'L');
        $this->Cell(0, 6, '' . $model->remark, 'R');
        $this->Ln();
        $this->Cell(0, 2, '', 'LBR');
        $this->Ln();

        $w = [48, 42, 47, 53];

        $this->Cell(0, 1, '', 'B');
        $this->Ln();
        $this->SetFont('Arial', '', 10);
        $this->Cell($w[0], 5, 'Diajukan oleh:', 'LTR', 0, 'C', true);
        $this->Cell($w[1], 5, 'Pengganti oleh:', 'LTR', 0, 'C', true);
        $this->Cell($w[2], 5, 'Disetujui oleh:', 'LTR', 0, 'C', true);
        $this->Cell($w[3], 5, 'Diketahui oleh:', 'LTR', 0, 'C', true);
        $this->Ln();
        $this->Cell($w[0], 25, '', 'LR');
        $this->Cell($w[1], 25, '', 'LR');
        $this->Cell($w[2], 25, '', 'LR');
        $this->Cell($w[3], 25, '', 'LR');
        $this->Ln();
        $this->SetFont('Arial', '', 8);
        $this->Cell($w[0], 6, $model->person->employee_name, 1, 0, 'C');
        $this->Cell($w[1], 6, '', 1, 0, 'C');
        $this->Cell($w[2], 6, 'Nama:', 1);
        $this->Cell($w[3], 6, 'Nama:', 1);
        $this->Ln();
        $this->Cell($w[0], 5, $model->cdate, 'LTR', 0, 'C');
        $this->Cell($w[1], 5, $model->cdate, 'LTR', 0, 'C');
        $this->Cell($w[2], 5, 'Tanggal:', 'LTR');
        $this->Cell($w[3], 5, 'Tanggal:', 'LTR');
        $this->Ln();
        $this->SetFont('Arial', 'B', 8);
        $this->Cell($w[0], 4, 'Karyawan', 'LBR', 0, 'C', true);
        $this->Cell($w[1], 4, 'Pengganti', 'LBR', 0, 'C', true);
        $this->Cell($w[2], 4, 'Atasan Terkait', 'LBR', 0, 'C', true);
        $this->Cell($w[3], 4, 'Pihak HR', 'LBR', 0, 'C', true);
    }

}

