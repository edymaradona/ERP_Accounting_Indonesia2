<?php

class expenseForm extends fpdf
{

    function report($model)
    {
        $this->y0 = $this->GetY();
        $this->Cell(0, 1, '', 'T', 0, 'C');
        $this->Image('shareimages/company/logoAlt1.jpg', 15, 11, 22);
        $this->SetY($this->y0);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 3, '', 'LR');
        $this->Ln();
        $this->Cell(10, 3, '', 'L');
        $this->Cell(0, 3, "FORM PERJALANAN DINAS", 'R', 0, 'C');
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
        $this->Cell(25, 8, '');
        $this->Cell(20, 8, '');
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

        $this->y1 = $this->GetY();
        $this->SetFont('Arial', '', 10);
        $this->Cell(60, 6, 'Tempat Tujuan', 'L');
        $this->Cell(2, 6, ': ');
        $this->Cell(30, 6, $model->destination);
        $this->Cell(0, 6, '', 'R');
        $this->Ln();

        $this->Cell(60, 6, 'Tanggal/Jam Berangkat', 'L');
        $this->Cell(2, 6, ': ');
        $this->Cell(40, 6, $model->start_date);
        $this->Cell(40, 6, 'Tanggal/Jam Kembali');
        $this->Cell(2, 6, ': ');
        $this->Cell(0, 6, $model->end_date, 'R');
        $this->Ln();

        $transdetail = [];
        if (isset($model->detail)) {
            foreach ($model->detail as $mod) {
                $transdetail[] = $mod->expense->name;
            }
        }

        $this->Cell(60, 6, 'Jenis Transportasi', 'L');
        $this->Cell(2, 6, ': ');
        $this->Cell(30, 6, peterFunc::shorten_string(implode(', ', $transdetail),11));
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(60, 6, 'Uang Muka', 'L');
        $this->Cell(2, 6, ': ');
        //$this->Cell(20, 6, peterFunc::indoFormat($model->advanced_amount) .
        //peterFunc::nolC($model->advanced_amount,peterFunc::terbilang($model->advanced_amount) . "Rupiah");
        $this->Cell(20, 6, peterFunc::indoFormat($model->advanced_amount));
        $this->Cell(0, 6, '', 'R');
        $this->Ln();

        $this->Cell(60, 6, 'Keperluan/Tujuan', 'L');
        $this->Cell(2, 6, ': ');
        $this->Cell(30, 6, substr($model->purpose,0,75));
        $this->Cell(0, 6, '', 'R');
        $this->Ln();

        $this->Cell(60, 6, '', 'L');
        $this->Cell(2, 6, ' ');
        $this->Cell(30, 6, substr($model->purpose,75,75));
        $this->Cell(0, 6, '', 'R');
        $this->Ln();

        $this->Cell(60, 6, '', 'L');
        $this->Cell(2, 6, ' ');
        $this->Cell(30, 6, substr($model->purpose,150,75));
        $this->Cell(0, 6, '', 'R');
        $this->Ln();

        $this->Cell(60, 6, '', 'L');
        $this->Cell(2, 6, ' ');
        $this->Cell(30, 6, substr($model->purpose,225,75));
        $this->Cell(0, 6, '', 'R');
        $this->Ln();

        $this->Cell(60, 6, '', 'L');
        $this->Cell(2, 6, ' ');
        $this->Cell(30, 6, substr($model->purpose,300,75));
        $this->Cell(0, 6, '', 'R');
        $this->Ln();


        $this->Cell(60, 6, 'Keterangan', 'L');
        $this->Cell(2, 6, ': ');
        $this->Cell(30, 6, substr($model->remark,0,75));
        $this->Cell(0, 6, '', 'R');
        $this->Ln();

        $this->Cell(60, 6, '', 'L');
        $this->Cell(2, 6, ' ');
        $this->Cell(30, 6, substr($model->remark,75,75));
        $this->Cell(0, 6, '', 'R');
        $this->Ln();

        $this->Cell(60, 6, '', 'L');
        $this->Cell(2, 6, ' ');
        $this->Cell(30, 6, substr($model->remark,225,75));
        $this->Cell(0, 6, '', 'R');
        $this->Ln();


        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 6, 'Beban', 'L');
        $this->Cell(2, 6, ': ');
        $this->Cell(30, 6, $model->cost_center->name);
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(0, 2, '', 'T');


        $this->Ln(8);
        $w = [48, 42, 47, 53];

        $this->Cell(0, 1, '', 'B');
        $this->Ln();
        $this->SetFont('Arial', '', 10);
        $this->Cell($w[0], 6, 'Pelaksana Tugas:', 'LTR', 0, 'C', true);
        $this->Cell($w[1], 6, 'Atasan:', 'LTR', 0, 'C', true);
        $this->Cell($w[2], 6, 'HR Manager:', 'LTR', 0, 'C', true);
        $this->Cell($w[3], 6, 'Finance/Accounting:', 'LTR', 0, 'C', true);
        $this->Ln();
        $this->Cell($w[0], 22, '', 'LR');
        $this->Cell($w[1], 22, '', 'LR');
        $this->Cell($w[2], 22, '', 'LR');
        $this->Cell($w[3], 22, '', 'LR');
        $this->Ln();
        $this->SetFont('Arial', '', 10);
        $this->Cell($w[0], 6, $model->person->employee_name, 1, 0, 'C');
        $this->Cell($w[1], 6, 'Nama:', 1);
        $this->Cell($w[2], 6, 'Nama:', 1);
        $this->Cell($w[3], 6, 'Nama:', 1);
        $this->Ln();
        $this->Cell($w[0], 6, $model->input_date, 1, 0, 'C');
        $this->Cell($w[1], 6, 'Tanggal:', 1, 0, 'C');
        $this->Cell($w[2], 6, 'Tanggal:', 1);
        $this->Cell($w[3], 6, 'Tanggal:', 1);
        $this->Ln();
    }

}

