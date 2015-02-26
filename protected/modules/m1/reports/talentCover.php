<?php

class talentCover extends fpdf
{

    function report($model, $year)
    {
        $this->SetFillColor(230, 230, 230);
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(0, 8, 'FORMULIR PENILAIAN KINERJA', 0, 0, 'C');
        $this->Ln();
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 8, $model->mCompany(), 0, 0, 'C');
        $this->Ln();
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 8, 'PERIODE PENILAIAN: ' . $year, 0, 0, 'C');
        $this->Ln(4);

        $this->SetFont('Arial', 'B', 12);
        $this->Ln();
        $this->Cell(15, 7, '');
        $this->Cell(170, 7, 'KARYAWAN', 'B');
        $this->Ln();
        $this->SetFont('Arial', '', 12);
        $this->Cell(15, 7, '');
        $this->Cell(70, 7, 'Nama');
        $this->Cell(100, 7, ':  ' . $model->employee_name);
        $this->Cell(5, 7, '');
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(75, 7, 'Tanda Tangan', 'LTR', 0, 'C', true);
        $this->SetFont('Arial', '', 12);
        $this->Ln();

        $this->Cell(15, 7, '');
        $this->Cell(70, 7, 'Jabatan');
        $this->Cell(100, 7, ':  ' . peterFunc::shorten_string($model->mJobTitle(),5,0,false));
        $this->Cell(5, 7, '');
        $this->Cell(75, 7, '', 'LR');
        $this->Ln();

        $this->Cell(15, 7, '');
        $this->Cell(70, 7, '');
        $this->Cell(100, 7, '   ' . peterFunc::shorten_string($model->mJobTitle(),5,5,false));
        $this->Cell(5, 7, '');
        $this->Cell(75, 7, '', 'LR');
        $this->Ln();

        $this->Cell(15, 7, '');
        $this->Cell(70, 7, 'Golongan');
        $this->Cell(100, 7, ':  ' . $model->mGolonganId() . " - " . $model->mLevel());
        $this->Cell(5, 7, '');
        $this->Cell(75, 7, '', 'LR');
        $this->Ln();
        $this->Cell(15, 7, '');
        $this->Cell(70, 7, 'Dept/Div/Dir/Perusahaan');
        $this->Cell(100, 7, ':  ' . $model->mDepartment());
        $this->Cell(5, 7, '');
        $this->Cell(75, 7, '', 'LR');
        $this->Ln();
        $this->Cell(15, 7, '');
        $this->Cell(70, 7, 'Tanggal Masuk Kerja');
        $this->Cell(100, 7, ':  ' . $model->companyfirst->start_date . " (" . $model->countJoinDate() . ")");
        $this->Cell(5, 7, '');
        $this->Cell(75, 7, '', 'LR');
        $this->Ln();
        $this->Cell(15, 7, '');
        $this->Cell(70, 7, 'Tanggal Evaluasi');
        $this->Cell(100, 7, ': ' . date('d-m-Y'));
        $this->Cell(5, 7, '');
        $this->Cell(75, 7, '', 'LBR');
        $this->Ln();

        $this->SetFont('Arial', 'B', 12);
        $this->Ln();
        $this->Cell(15, 7, '');
        $this->Cell(170, 7, 'PENILAI', 'B');
        $this->Ln();
        $this->SetFont('Arial', '', 12);
        $this->Cell(15, 7, '');
        $this->Cell(70, 7, 'Nama Atasan Langsung');
        $this->Cell(100, 7, ':  ' . $model->mSuperior());
        $this->Cell(5, 7, '');
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(75, 7, 'Tanda Tangan', 'LTR', 0, 'C', true);
        $this->SetFont('Arial', '', 12);
        $this->Ln();

        $this->Cell(15, 7, '');
        $this->Cell(70, 7, 'Jabatan');
        $this->Cell(100, 7, ':  ' . peterFunc::shorten_string($model->mSuperiorJobTitle(),5,0,false));
        $this->Cell(5, 7, '');
        $this->Cell(75, 7, '', 'LR');
        $this->Ln();
        $this->Cell(15, 7, '');
        $this->Cell(70, 7, '');
        $this->Cell(100, 7, '   ' . peterFunc::shorten_string($model->mSuperiorJobTitle(),5,5,false));
        $this->Cell(5, 7, '');
        $this->Cell(75, 7, '', 'LR');
        $this->Ln();

        $this->Cell(15, 7, '');
        $this->Cell(70, 7, 'Dept/Div/Dir/Perusahaan');
        $this->Cell(100, 7, ':  ' . $model->mDepartment());
        $this->Cell(5, 7, '');
        $this->Cell(75, 7, '', 'LR');
        $this->Ln();
        $this->Cell(15, 7, '');
        $this->Cell(70, 7, '');
        $this->Cell(100, 7, '');
        $this->Cell(5, 7, '');
        $this->Cell(75, 7, '', 'LRB');
        $this->Ln(1);
        $this->Ln();
        $this->Cell(15, 7, '');
        $this->Cell(70, 7, 'Nama Atasan dari Atasan Langsung');
        $this->Cell(105, 7, ': ' . $model->mDoubleSuperior());
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(75, 7, 'Tanda Tangan', 'LTR', 0, 'C', true);
        $this->SetFont('Arial', '', 12);
        $this->Ln();

        $this->Cell(15, 7, '');
        $this->Cell(70, 7, 'Jabatan');
        $this->Cell(100, 7, ':  ' . peterFunc::shorten_string($model->mDoubleSuperiorJobTitle(),5,0,false));
        $this->Cell(5, 7, '');
        $this->Cell(75, 7, '', 'LR');
        $this->Ln();
        $this->Cell(15, 7, '');
        $this->Cell(70, 7, '');
        $this->Cell(100, 7, '   ' . peterFunc::shorten_string($model->mDoubleSuperiorJobTitle(),5,5,false));
        $this->Cell(5, 7, '');
        $this->Cell(75, 7, '', 'LR');
        $this->Ln();

        $this->Cell(15, 7, '');
        $this->Cell(70, 7, 'Dept/Div/Dir/Perusahaan');
        $this->Cell(100, 7, ':  ' . $model->mDepartment());
        $this->Cell(5, 7, '');
        $this->Cell(75, 7, '', 'LR');
        $this->Ln();
        $this->Cell(15, 7, '');
        $this->Cell(70, 7, '');
        $this->Cell(100, 7, '');
        $this->Cell(5, 7, '');
        $this->Cell(75, 7, '', 'LRB');
        $this->Ln(1);
        $this->SetFillColor(230, 230, 230);

    }

}

