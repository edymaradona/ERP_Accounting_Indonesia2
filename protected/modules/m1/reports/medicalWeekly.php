<?php

class medicalWeekly extends fpdf
{

    //Page footer
    function Footer()
    {
        //Position at 1.5 cm from bottom
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial', 'I', 6);
        //Page number
        $this->Cell(0, 10, 'Printed Date: ' . Yii::app()->dateFormatter->format("dd-MM-yyyy", time())
            . '                        '
            . 'Page: ' . $this->PageNo() . '/{nb}'
            . '                        '
            . 'Issued By: ' . Yii::app()->params["title"] . ' - ' . Yii::app()->params["custom2"]
            . '                        '
            . 'Random Code Report: ' . peterFunc::rand_string(15)
            , 0, 0, 'C');
    }

    function myheader($rows, $w)
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 5, 'DAFTAR KLAIM');
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 5, sUser::model()->myGroupName);
        $this->Ln();

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 6, 'Tanggal Pengiriman: ' . date('d-m-Y'));

        $this->Ln();

        $this->SetFillColor(230, 230, 230);

        $this->Cell(0, 1, '', 'B');
        $this->Ln();
        $this->SetFont('Arial', 'B', 7);
        $this->Cell($w[0], 4, 'No', 'LTR', 0, 'C');
        $this->Cell($w[1], 4, 'Tanggal', 'TR', 0, 'C');
        $this->Cell($w[2], 4, 'Nama Karyawan', 'TR', 0, 'C');
        //$this->Cell($w[2], 4, 'Departemen', 'TR', 0, 'C');
        $this->Cell($w[2], 4, 'Tertanggung', 'TR', 0, 'C');
        $this->Cell($w[2], 4, 'Gejala', 'TR', 0, 'C');
        $this->Cell($w[3], 4, 'Jumlah', 'TR', 0, 'C');
        $this->Cell($w[4], 4, 'Dokter', 'TR', 0, 'C');
        $this->Cell($w[4], 4, 'Dokter', 'TR', 0, 'C');
        $this->Cell($w[4], 4, 'Obat', 'TR', 0, 'C');
        $this->Cell($w[4], 4, 'Dokter', 'TR', 0, 'C');
        $this->Cell($w[4], 4, 'Adm', 'TR', 0, 'C');
        $this->Cell($w[4], 4, 'Fisioterapi', 'TR', 0, 'C');
        $this->Cell($w[4], 4, 'Diagnostik', 'TR', 0, 'C');
        //$this->Cell($w[5], 4, 'Keterangan', 'TR', 0, 'C');
        $this->Ln();
        $this->Cell($w[0], 4, '', 'LBR', 0, 'C');
        $this->Cell($w[1], 4, 'Klaim', 'BR', 0, 'C');
        $this->Cell($w[2], 4, '', 'BR', 0, 'C');
        //$this->Cell($w[2], 4, '', 'BR', 0, 'C');
        $this->Cell($w[2], 4, '', 'BR', 0, 'C');
        $this->Cell($w[2], 4, '', 'BR', 0, 'C');
        $this->Cell($w[3], 4, '', 'BR', 0, 'C');
        $this->Cell($w[4], 4, 'Umum', 'BR', 0, 'C');
        $this->Cell($w[4], 4, 'Spesialist', 'BR', 0, 'C');
        $this->Cell($w[4], 4, '', 'BR', 0, 'C');
        $this->Cell($w[4], 4, '+ Obat', 'BR', 0, 'C');
        $this->Cell($w[4], 4, '', 'BR', 0, 'C');
        $this->Cell($w[4], 4, '', 'BR', 0, 'C');
        $this->Cell($w[4], 4, '', 'BR', 0, 'C');
        //$this->Cell($w[5], 4, '', 'BR', 0, 'C');
        $this->Ln();
    }

    function report($rows)
    {
        $w = [7, 20, 35, 19, 18];
        $this->myheader($rows, $w);
        $type = null;
        $counter = 1;
        $total = 0;

        foreach ($rows as $row) {
            if ($row['medical_type_id'] != $type) {
                if ($type != null) {
                    $this->Cell(0, 5, '', 'T');
                    $this->Ln(1);
                    $counter = 1;
                }
                $this->SetFont('Arial', 'B', 9);
                $this->Cell(0, 7, $row['name'], 1, 0, 'C');
                $this->Ln();
                $type = $row['medical_type_id'];
            }
            $this->SetFont('Arial', '', 9);
            $this->Cell($w[0], 7, $counter, 'L', 0, 'R');
            $this->Cell($w[1], 7, date('d-m-Y', strtotime($row['receipt_date'])), 'L');
            $this->Cell($w[2], 7, $row['employee_name'], 'L');
            //$this->Cell($w[2], 7, substr($row['department'], 0, 30), 'LR');
            $this->Cell($w[2], 7, $row['Medical_for'], 'L');
            $this->Cell($w[2], 7, $row['sympthom'], 'L');
            $this->Cell($w[3], 7, peterFunc::indoFormat($row['original_amount']), 'L', 0, 'R');
            $this->Cell($w[4], 7, peterFunc::indoFormat($row['general_doctor']), 'L', 0, 'R');
            $this->Cell($w[4], 7, peterFunc::indoFormat($row['specialist_doctor']), 'L', 0, 'R');
            $this->Cell($w[4], 7, peterFunc::indoFormat($row['medicine']), 'L', 0, 'R');
            $this->Cell($w[4], 7, peterFunc::indoFormat($row['doctor_medicine']), 'L', 0, 'R');
            $this->Cell($w[4], 7, peterFunc::indoFormat($row['administration']), 'L', 0, 'R');
            $this->Cell($w[4], 7, peterFunc::indoFormat($row['physiotherapy']), 'LR', 0, 'R');
            $this->Cell($w[4], 7, peterFunc::indoFormat($row['diagnostics']), 'LR', 0, 'R');
            //$this->Cell($w[5], 7, $row['remark'], 'LR');
            $this->Ln();
            $total = $total + $row['original_amount'];
            $counter++;

            if ($this->GetY() > 170) {
                $this->Cell(0, 5, '', 'T');
                $this->AddPage();
                $dept = null;
                $this->myheader($rows, $w);
                $this->SetFont('Arial', 'B', 9);
                $this->Cell(0, 7, $row['name'], 1, 0, 'C');
                $this->Ln();
                $type = $row['medical_type_id'];
            }
        }
        $this->Cell(0, 5, '', 'T');
        $this->Ln();

        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[0], 7, '', 'LBT');
        $this->Cell($w[1], 7, '', 'TB');
        $this->Cell($w[2], 7, '', 'TB');
        //$this->Cell($w[2], 7, '', 'TB');
        $this->Cell($w[2], 7, '', 'TB');
        $this->Cell($w[2], 7, 'T O T A L', 'TB', 0, 'R');
        $this->Cell($w[3], 7, peterFunc::indoFormat($total), 1, 0, 'R');
        $this->Cell($w[4], 7, '', 'TB');
        $this->Cell($w[4] * 6, 7, '', 'TBR');
        //$this->Cell($w[5], 7, '', 1);
        $this->Ln(15);

        if ($this->GetY() > 170) {
            $this->AddPage();
            $dept = null;
            $this->myheader($rows, $w);
            $this->SetFont('Arial', 'B', 9);
            $this->Ln();
            $type = $row['medical_type_id'];
        }

        $w2 = [210, 53];

        $this->Cell($w2[0], 4, '');
        $this->Cell($w2[1], 4, 'Mengetahui');
        $this->Ln();
        $this->Cell($w2[0], 22, '');
        $this->Cell($w2[1], 22, '');
        $this->Ln();
        $this->SetFont('Arial', '', 8);
        $this->Cell($w2[0], 5, '');
        $this->Cell($w2[1], 5, 'H R D');
    }

}

