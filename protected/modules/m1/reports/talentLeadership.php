<?php

class talentLeadership extends fpdf
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

    function myheader($models, $w)
    {
        $this->y0 = $this->GetY();
        $this->Cell(0, 1, '', 0, 0, 'C');
        $this->Image('shareimages/company/logoAlt1.jpg', 265, 9, 35);
        $this->SetY($this->y0);

        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 5, 'ASPEK 3. KOMPETENSI KEPEMIMPINAN');
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 5, $models[0]->parent->employee_name . " | " . sUser::model()->myGroupName);
        $this->Ln(8);

        $this->SetFillColor(230, 230, 230);

        $this->Cell(0, 1, '', 'B');
        $this->Ln();
        $this->SetFont('Arial', 'B', 8);
        $this->Cell($w[0], 4, 'No', 'LTR', 0, 'C', true);
        $this->Cell($w[1], 4, 'Aspek Kompetensi Inti', 'TR', 0, 'C', true);
        $this->Cell($w[2], 4, 'Indikator Perilaku', 'TR', 0, 'C', true);
        $this->Cell($w[3], 4, 'Bobot', 'TR', 0, 'C', true);
        $this->Cell($w[3], 4, 'Target', 'TR', 0, 'C', true);
        $this->Cell($w[3], 4, 'Nilai', 'TR', 0, 'C', true);
        $this->Cell($w[3], 4, 'Nilai', 'TR', 0, 'C', true);
        $this->Cell($w[3], 4, 'Bobot x', 'TR', 0, 'C', true);
        $this->Ln();

        $this->Cell($w[0], 4, '', 'LBR', 0, 'C', true);
        $this->Cell($w[1], 4, '', 'BR', 0, 'C', true);
        $this->Cell($w[2], 4, '', 'BR', 0, 'C', true);
        $this->Cell($w[3], 4, '', 'BR', 0, 'C', true);
        $this->Cell($w[3], 4, '', 'BR', 0, 'C', true);
        $this->Cell($w[3], 4, 'Individu', 'BR', 0, 'C', true);
        $this->Cell($w[3], 4, 'Atasan', 'BR', 0, 'C', true);
        $this->Cell($w[3], 4, 'Nilai Atasan', 'BR', 0, 'C', true);
        $this->Ln();

    }

    function report($models)
    {
        $w = [7, 40, 140, 18];
        $this->myheader($models, $w);
        $type = null;
        $counter = 1;
        $total = 0;
        $fill = false;

        foreach ($models as $model) {

            $this->SetFont('Arial', '', 7);

            $x0 = $this->GetX();
            $y0 = $this->GetY();
            $this->Cell($w[0], 3, $counter, 'LT', 0, 'R');
            $y1 = $this->GetY();
            $this->Cell($w[1], 3, $model->talent_template->aspect, 'LT', 0, 'L');
            $this->MultiCell($w[2], 3, $model->talent_template->description, 'LT');
            $y2 = $this->GetY();
            $yH = $y2 - $y1;

            $yC = $this->GetY();

            $this->SetXY($x0, $y0);
            $this->Cell($w[0], $yH, '', 'LB'); //Garis samping
            $this->Cell($w[1], $yH, '', 'LB'); //Garis samping

            $this->SetXY($x0 + $w[0] + $w[1] + $w[2], $yC - $yH);

            $this->Cell($w[3], $yH, $model->talent_template->weight, 'LT', 0, 'C');
            $this->Cell($w[3], $yH, $model->talent_template->target, 'LT', 0, 'C');
            $this->Cell($w[3], $yH, $model->personal_score, 'LT', 0, 'C');
            $this->Cell($w[3], $yH, $model->superior_score, 'LT', 0, 'C');
            $this->Cell($w[3], $yH, $model->calcFinalResult, 'LTR', 0, 'C');
            $this->Ln();
            $total = $total + $model->superior2_score;
            $counter++;

            if ($this->GetY() > 180) {
                $this->Cell(0, 5, '', 'T');
                $this->AddPage();
                $dept = null;
                $this->myheader($models, $w);
                $this->SetFont('Arial', 'B', 9);
                $this->Cell(0, 7, $model->parent_id, 1, 0, 'C');
                $this->Ln();
            }
            $fill = !$fill;
        }

        $this->Cell(0, 5, '', 'T');
        $this->Ln();
        /*
                $this->SetFont('Arial', 'B', 9);
                $this->Cell($w[0], 7, '', 'LBT');
                $this->Cell($w[1], 7, '', 'TB');
                $this->Cell($w[2], 7, '', 'TB');
                $this->Cell($w[2], 7, 'T O T A L', 'TB', 0, 'R');
                $this->Cell($w[2], 7, peterFunc::indoFormat($total), 1, 0, 'R');
                $this->Cell($w[2], 7, '', 'TB');
                $this->Cell($w[2] * 4, 7, '', 'TBR');
                //$this->Cell($w[5], 7, '', 1);
                $this->Ln(15);

                if ($this->GetY() > 180) {
                    $this->AddPage();
                    $dept = null;
                    $this->myheader($models,$w);
                    $this->SetFont('Arial', 'B', 9);
                    $this->Ln();
                    $type = $model->strategic_objective;
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
        */
    }

}

