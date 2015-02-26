<?php

class permissionForm extends fpdf
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
        $this->Cell(155, 3, 'FORMULIR PERMOHONAN IJIN KARYAWAN', 0, 0, 'C');
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
        $this->Cell(60, 6, 'Dengan ini mengajukan ijin:', 'L');
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(60, 6, 'Tanggal  ', 'L');
        $this->Cell(0, 6, ': ' . peterFunc::convertHari(date('N', strtotime($model->start_date))) . ", " . Yii::app()->dateFormatter->format("dd-MM-yyyy", strtotime($model->start_date))
            . ' s/d ' . Yii::app()->dateFormatter->format("dd-MM-yyyy", strtotime($model->end_date)));
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(60, 6, 'Pukul  ', 'L');
        $this->Cell(30, 6, ': ' . Yii::app()->dateFormatter->format("HH:mm", strtotime($model->start_date)) . ' s/d '
            . Yii::app()->dateFormatter->format("HH:mm", strtotime($model->end_date)));
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(60, 6, 'Jumlah Hari Kerja', 'L');
        $this->Cell(10, 6, ': ' . $model->number_of_day . '  Hari');
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 6, 'Jenis Ijin', 'L');
        $this->Cell(0, 6, ': ' . $model->permission_type->name, 'R');
        $this->Ln(6);
        $this->SetFont('Arial', '', 10);
        $this->Cell(15, 6, 'Alasan: ', 'L');
        $this->Cell(0, 6, '' . $model->permission_reason, 'R');
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
        //$this->Cell($w[1], 25, '', 'LR');
        $this->Cell($w[1], 25, ($model->superior_approved_id == 2) ? 'ONLINE APPROVED' : '', 'LR', 0, 'C');
        $this->Cell($w[2], 25, '', 'LR');
        $this->Ln();
        $this->SetFont('Arial', '', 8);
        $this->Cell($w[0], 6, 'Nama:  ' . $model->person->employee_name, 1);
        //$this->Cell($w[1], 6, 'Nama:', 1);
        if ($model->superior_approved_id == 1) {
            $this->Cell($w[1], 6, 'Nama: ', 1);
        } else
            $this->Cell($w[1], 6, (isset($model->updated)) ? $model->updated->sso() : '', 1, 0, 'C');
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
        $this->Ln(6);
        if ($model->superior_approved_id == 2) {
            $this->Cell(0, 4, (isset($model->updated)) ? "THIS PERMISSION HAS BEEN APPROVED BY: " . $model->updated->sso() : 'THIS PERMISSION HAS BEEN APPROVED', 'LTR', 0, 'C');
            $this->Ln();
            $this->Cell(0, 4, "Ref: " . substr($model->activation_code, 0, 20) . " at " . date("d-m-Y", $model->updated_date), 'LBR', 0, 'C');
        }
    }

}

