<?php

class medicalInfo extends fpdf
{

    function report($model)
    {
        $this->SetFillColor(230, 230, 230);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 8, 'REKENING PROSES CLAIM', 0, 0, 'C', true);
        $this->Ln(4);

        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 8, '', 'B', 0, 'C');
        $this->Ln();
        $this->Cell(35, 8, 'Nama PT', 'L');
        $this->Cell(60, 8, ':  ' . $model->person->mCompany());
        $this->Cell(0, 8, '', 'R');
        $this->Ln();
        $this->Cell(35, 8, 'Nama', 'L');
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(60, 8, ':  ' . $model->person->employee_name);
        $this->SetFont('Arial', '', 12);
        $this->Cell(15, 8, 'NIK');
        $this->Cell(35, 8, ':  ' . $model->person->employeeShortID);
        $this->Cell(0, 8, '', 'R');
        $this->Ln();
        $this->Cell(35, 8, 'Departemen', 'L');
        $this->Cell(60, 8, ':  ' . $model->person->mDepartment());
        $this->Cell(0, 8, '', 'R');
        $this->Ln();
        $this->Cell(35, 8, 'Jabatan', 'L');
        $this->Cell(80, 8, ':  ' . $model->person->mJobTitle());
        $this->Cell(0, 8, '', 'R');
        $this->Ln();
        $this->Cell(35, 10, 'Nama Pasien  ', 'L');
        $this->Cell(0, 10, ': ' . $model->medicalForPlus . " (" . $model->medicalForPlusR . ")");
        $this->Cell(0, 10, '', 'R');
        $this->Ln();
        $this->Cell(0, 10, '', 'T');
        $this->Ln(1);

        $this->SetFillColor(230, 230, 230);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 2, '', 'LTR');
        $this->Ln();
        $this->Cell(70, 8, 'Nama Bank ', 'L');
        $this->Cell(0, 8, ': ' . $model->person->bank_name);
        $this->Cell(0, 8, '', 'R');
        $this->Ln();
        $this->Cell(70, 8, 'Nama Pemilik Rekening  ', 'L');
        $this->Cell(30, 8, ': ' . $model->person->account_name);
        $this->Cell(0, 8, '', 'R');
        $this->Ln();
        $this->Cell(70, 8, 'Nomor Rekening', 'L');
        $this->Cell(10, 8, ': ' . $model->person->account_number);
        $this->Cell(0, 8, '', 'R');
        $this->Ln();
        $this->Cell(0, 2, '', 'LBR');
        $this->Ln();
    }

}

