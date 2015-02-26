<?php

class weeklyReportSample extends FpdfExtended
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


    function myheader($rows, $w)
    {
        $this->y0 = $this->GetY();
        $this->Cell(0, 5, '', 'T', 0, 'C');
        $this->Image('shareimages/company/logoAlt1.jpg', 15, 12, 30);
        $this->SetY($this->y0);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 5, '', 'LR');
        $this->Ln();
        $this->Cell(30, 5, '', 'L');
        $this->Cell(0, 5, 'LAPORAN MINGGUAN', 'R', 0, 'C');
        $this->Ln();
        $this->Cell(0, 5, '', 'LBR');
        $this->Ln(1);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 6, '', 'B', 0, 'C');
        $this->Ln();
        $this->Cell(0, 6, 'PERIODE:  ', 1, 0, 'C');

        $this->Ln(6);
        $this->Cell(0, 6, '', 'T');
        $this->Ln(1);

        $this->SetFillColor(230, 230, 230);

        $this->Cell(0, 1, '', 'B');
        $this->Ln();
        $this->SetFont('Arial', 'B', 7);
        $this->CellHeader(['w' => $w[0], 'txt' => 'No', 'border' => 'LTR']);
        $this->CellHeader(['w' => $w[1], 'txt' => 'Pekerjaan', 'border' => 'LTR']);
        $this->CellHeader(['w' => $w[2], 'txt' => 'Testing', 'border' => 'LTR']);
        $this->Ln();
        $this->CellHeader(['w' => $w[0], 'border' => 'LBR']);
        $this->CellHeader(['w' => $w[1], 'border' => 'LBR']);
        $this->CellHeader(['w' => $w[2], 'txt' => 'Pekerjaan', 'border' => 'LBR']);
        $this->Ln();
    }

    function report($rows, $w = [])
    {
        $w = [5, 75, 20];
        $this->myheader($rows, $w);
        $type = null;
        $counter = 1;

        foreach ($rows as $row) {
            $this->SetFont('Arial', '', 7);
            $this->CellStandard(['w' => $w[0], 'txt' => $counter]);
            $this->CellStandard(['w' => $w[1], 'txt' => $row["employee_name"]]);
            $this->CellStandard(['w' => $w[2], 'txt' => $row["handphone"]]);
            $this->Ln();
            $counter++;

            if ($this->GetY() > 178) {
                $this->Cell(0, 5, '', 'T');
                $this->AddPage();
                $dept = null;
                $this->myheader($row, $w);
                $this->Ln();
            }
        }
        $this->Cell(0, 5, '', 'T');
    }

}

?>