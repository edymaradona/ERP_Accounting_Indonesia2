<?php

class learning1 extends fpdf
{

    //Page footer
    function Footer()
    {
        //Position at 1.5 cm from bottom
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial', 'I', 6);
        //Page number
        $this->Cell(0, 10, 'Printed Date: ' . Yii::app()->dateFormatter->format("dd-MM-yyyy", time()) . '                        ' .
            'Page: ' . $this->PageNo() . '/{nb}' . '                        ' .
            'Issued By: ' . Yii::app()->params["title"] . ' - ' . Yii::app()->params["custom2"], 0, 0, 'C');
    }

    function myheader($model)
    {
        $this->y0 = $this->GetY();
        $this->Cell(0, 5, '', 'T', 0, 'C');
        $this->Image('shareimages/company/logoAlt1.jpg', 15, 12, 30);
        $this->SetY($this->y0);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 5, '', 'LR');
        $this->Ln();
        $this->Cell(30, 5, '', 'L');
        $this->Cell(0, 5, 'DAFTAR HADIR LEARNING', 'R', 0, 'C');
        $this->Ln();
        $this->Cell(0, 5, '', 'LBR');
        $this->Ln(1);

        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, '', 'B', 0, 'C');
        $this->Ln();
        $this->Cell(35, 8, 'Materi Training', 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 8, ':  ' . $model->getparent->learning_title, 'R');
        $this->Ln();
        $this->SetFont('Arial', '', 10);
        $this->Cell(35, 6, 'Hari / Tanggal', 'L');
        $this->Cell(80, 6, ':  ' . date("d-m-Y", strtotime($model->schedule_date)));
        $this->Cell(30, 6, 'Kelas');
        $this->Cell(40, 6, ':  ');
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(35, 6, 'Fasilitator', 'L');
        $this->Cell(80, 6, ':  ' . $model->trainer_name);
        $this->Cell(0, 6, '', 'R');
        $this->Ln(6);
        $this->Cell(0, 6, '', 'T');
        $this->Ln(3);

        $w = [5, 45, 65, 45, 30];

        $this->Cell(0, 1, '', 'B');
        $this->Ln();
        $this->SetFont('Arial', 'B', 8);
        $this->Cell($w[0], 8, 'No.', 1, 0, 'C', true);
        $this->Cell($w[1], 8, 'Nama', 1, 0, 'C', true);
        $this->Cell($w[2], 8, 'Business Unit', 1, 0, 'C', true);
        $this->Cell($w[3], 8, 'Jabatan', 1, 0, 'C', true);
        $this->Cell($w[4], 8, 'TT', 1, 0, 'C', true);
        $this->Ln();
    }

    function report($model)
    {
        $this->SetFillColor(230, 230, 230);

        $w = [5, 45, 65, 45, 30];

        $this->myheader($model);

        $_counter = 1;
        $_countert = 1;
        $fill = false;

        foreach ($model->participant as $mod) {
            $this->SetFont('Arial', '', 8);
            $this->Cell($w[0], 12, $_countert, 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 12, $mod->employee->employee_name, 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 12, substr($mod->employee->mCompany(), 0, 50), 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 12, substr($mod->employee->mJobTitle(), 0, 30), 'LR', 0, 'L', $fill);
            $this->SetFont('Arial', '', 6);
            $this->Cell($w[4], 12, $_countert . ")", 'LR', 0, 'L', $fill);
            $this->Ln();

            $fill = !$fill;
            $_counter++;
            $_countert++;

            if ($_counter == 17) {
                $this->Cell(array_sum($w), 0, '', 'T');
                $this->AddPage();

                $this->myheader($model);

                $_counter = 1;
            }
        }
        $this->Cell(array_sum($w), 2, '', 'T', 0, 0);
        $this->Ln(8);
    }

}

