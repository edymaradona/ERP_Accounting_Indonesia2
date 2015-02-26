<?php

class talentFinalRating extends fpdf
{

    function report($rows)
    {
        $this->SetFillColor(230, 230, 230);
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(0, 8, 'TOTAL PENILAIAN KINERJA', 0, 0, 'C');
        $this->Ln();
        $this->SetFont('Arial', '', 14);
        $this->Cell(0, 8, $rows[0]["company"], 'B', 0, 'C');
        $this->Ln(10);
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 8, $rows[0]["employee_name"] , 0, 0, 'C');
        $this->Ln();
        $this->SetFont('Arial', '', 14);
        $this->Cell(0, 8, $rows[0]["job_title"].' | ' . $rows[0]["department"].' | ' . $rows[0]["level"], 0, 0, 'C');
        $this->Ln(10);
        $this->Cell(0, 8, 'PERIODE PENILAIAN: ' . $rows[0]["year"], 0, 0, 'C');
        $this->Ln(15);

        $this->SetFillColor(230, 230, 230);

        $this->SetFont('Arial', 'B', 14);
        $this->Cell(30, 7, '');
        $this->Cell(120, 7, 'ASPEK',1,0,"C",true);
        $this->Cell(50, 7, 'BOBOT',1,0,"C",true);
        $this->Cell(50, 7, 'NILAI',1,0,"C",true);
        $this->Ln();

        $this->Cell(0, 10, '');
        $this->Ln(2);

        if ($rows[0]["golongan"] > 10) {

            $this->SetFont('Arial', '', 16);
            $this->Cell(30, 12, '');
            $this->Cell(220, 12, 'SEMESTER I',1,0,"C");
            $this->Ln();

            $this->Cell(30, 10, '');
            $this->Cell(120, 10, 'KPI',1);
            $this->Cell(50, 10, ($rows[0]["golongan"] > 7) ? '70' : '50',1,0,"C");
            $this->Cell(50, 10, $rows[0]["kpi1"],1,0,"C");
            $this->Ln();

            $this->Cell(30, 10, '');
            $this->Cell(120, 10, 'Kompetensi Inti',1);
            $this->Cell(50, 10, ($rows[0]["golongan"] > 7) ? '15' : '50',1,0,"C");
            $this->Cell(50, 10, $rows[0]["core1"],1,0,"C");
            $this->Ln();

            $this->Cell(30, 10, '');
            $this->Cell(120, 10, 'Kompetensi Kepemimpinan',1);
            $this->Cell(50, 10, ($rows[0]["golongan"] > 7) ? '15' : '0',1,0,"C");
            $this->Cell(50, 10, $rows[0]["leadership1"],1,0,"C");
            $this->Ln();

            $this->SetFont('Arial', 'B', 16);
            $this->Cell(30, 16, '');
            $this->Cell(120, 16, 'FINAL RATING',1,0,'C');
            $this->Cell(100, 16, $rows[0]["final1"],1,0,"C");
            $this->Ln();
        }

        $this->Cell(0, 10, '');
        $this->Ln(2);

        $this->SetFont('Arial', '', 16);
        $this->Cell(30, 12, '');
        $this->Cell(220, 12, ($rows[0]["golongan"] > 10) ? 'SEMESTER II' : 'FULL YEAR',1,0,"C");
        $this->Ln();

        $this->Cell(30, 10, '');
        $this->Cell(120, 10, ($rows[0]["golongan"] > 10) ? 'KPI' : 'Hasil Kerja',1);
        $this->Cell(50, 10, ($rows[0]["golongan"] > 7) ? '70' : '50',1,0,"C");
        $this->Cell(50, 10, ($rows[0]["golongan"] > 10) ? $rows[0]["kpi2"] : $rows[0]["work_result"] ,1,0,"C");
        $this->Ln();

        $this->Cell(30, 10, '');
        $this->Cell(120, 10, 'Kompetensi Inti',1);
        $this->Cell(50, 10, ($rows[0]["golongan"] > 7) ? '15' : '50',1,0,"C");
        $this->Cell(50, 10, $rows[0]["core2"],1,0,"C");
        $this->Ln();

        $this->Cell(30, 10, '');
        $this->Cell(120, 10, 'Kompetensi Kepemimpinan',1);
        $this->Cell(50, 10, ($rows[0]["golongan"] > 7) ? '15' : '',1,0,"C");
        $this->Cell(50, 10, ($rows[0]["golongan"] > 7) ? $rows[0]["leadership2"] : '',1,0,"C");
        $this->Ln();

        $this->SetFont('Arial', 'B', 16);
        $this->Cell(30, 16, '');
        $this->Cell(120, 16, 'FINAL RATING',1,0,'C');
        $this->Cell(100, 16, $rows[0]["final2"],1,0,"C");
        $this->Ln();

    }

}

