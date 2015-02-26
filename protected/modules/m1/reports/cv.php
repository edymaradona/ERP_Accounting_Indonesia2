<?php

class cv extends fpdf
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
        if (is_file(Yii::app()->basePath . '/../shareimages/hr/employee/' . $model->c_pathfoto))
            $this->Image('shareimages/hr/employee/' . $model->c_pathfoto, 10, 10, 10);
        $this->SetY($this->y0);
        $this->SetFont('Arial', 'B', 13);
        $this->Ln();
        $this->Cell(15);
        $this->Cell(100, 5, strtoupper($model->applicant_name));
        $this->Ln(14);
    }

    function report($id)
    {

        $model = hApplicant::model()->with(
            'many_experience', 'many_education', 'many_educationnf', 'many_family')->findByPk((int)$id);

        $this->y0 = $this->GetY();
        if (is_file(Yii::app()->basePath . '/../shareimages/hr/applicant/' . $model->c_pathfoto))
            $this->Image('shareimages/hr/applicant/' . $model->c_pathfoto, 10, 10, 28);
        $this->SetY($this->y0);
        $this->SetFont('Arial', 'B', 13);
        $this->Cell(30);
        $this->Cell(100, 5, strtoupper($model->applicant_name));
        $this->Ln();
        $this->Cell(30);
        $this->SetFont('Arial', '', 10);
        $this->Cell(100, 5, $model->address1 . ' ' . $model->address2 . ' ' . $model->address3);
        $this->Ln(6);
        $this->Cell(30);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(35, 5, 'Code');
        $this->SetFont('Arial', '', 10);
        $this->Cell(100, 5, "");
        $this->Ln();
        $this->Cell(30);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(35, 5, 'Gender');
        $this->SetFont('Arial', '', 10);
        $this->Cell(100, 5, ($model->sex_id == 1) ? 'Male' : 'Female');
        $this->Ln();
        $this->Cell(30);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(35, 5, 'Birth of Date');
        $this->SetFont('Arial', '', 10);
        $this->Cell(100, 5, $model->birth_place . ', ' . $model->birth_date);
        $this->Ln();
        $this->Cell(30);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(35, 5, 'Contact Number');
        $this->SetFont('Arial', '', 10);
        $this->Cell(100, 5, $model->home_phone . ' / ' . $model->handphone);
        $this->Ln();
        $this->Cell(30);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(35, 5, 'Email');
        $this->SetFont('Arial', '', 10);
        $this->Cell(100, 5, $model->email);
        $this->Ln();
        $this->Cell(30);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(35, 5, 'Marital Status');
        $this->SetFont('Arial', '', 10);
        $this->Cell(100, 5, $model->maritalStatus());
        $this->Ln(6);

        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(206, 206, 206);
        //$this->Cell(0,3,'',0,0,'C',true);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 5, 'EXPERIENCE', 'B', 0, 'R');
        $this->Ln(6);

        $_counter = 1;
        $_countert = 1;
        $w = [8, 60, 35, 20, 20, 47];

        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[0], 6, 'No', 0, 0, 'L', true);
        $this->Cell($w[1] + $w[2], 6, 'Company/Industries', 0, 0, 'L', true);
        $this->Cell($w[3] + $w[4], 6, 'Period', 0, 0, 'L', true);
        $this->Cell($w[5], 6, 'Job Title', 0, 0, 'L', true);
        $this->Ln(8);

        foreach ($model->many_experience as $mod_experience) {
            $this->SetFont('Arial', '', 9);
            $this->Cell($w[0], 5, peterFunc::indoFormat($_countert), 0, 0, 'R');
            $this->Cell($w[1] + $w[2], 5, peterFunc::shorten_string($mod_experience->company_name, 10));
            $this->Cell($w[3] + $w[4], 5, $mod_experience->start_date . ' - ' . $mod_experience->end_date);
            $y1 = $this->GetY();
            $this->MultiCell($w[5], 5, peterFunc::shorten_string($mod_experience->job_title, 9));
            $y2 = $this->GetY();
            $yH = $y2 - $y1;
            $yC = $this->GetY();
            $this->SetXY($w[0] + $w[1] + $w[2] + $w[3] + $w[4], $yC - $yH);

            $this->Ln();
            $this->Cell($w[0], 5, '');
            $this->Cell($w[1] + $w[2], 5, ' (' . peterFunc::shorten_string($mod_experience->industries, 10) . ')');
            $_year = (isset($mod_experience->year_length)) ? $mod_experience->year_length . ' years' : '';
            $_month = (isset($mod_experience->month_length)) ? $mod_experience->month_length . ' months' : '';
            $this->Cell($w[3] + $w[4], 5, $_year . ' ' . $_month);
            $this->Cell($w[5], 5, '');
            $this->Ln(6);


            $_counter++;
            $_countert++;
        }
        //$this->Ln(5);
        //$this->Cell(50,5,'   TOTAL EXPERIENCE');
        //$this->Cell(0,5,$model->many_experience_staty);

        $this->Ln(8);

        if ($this->GetY() >= 230) {
            $this->AddPage();
            $this->myheader($model);
        }

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 5, 'FORMAL EDUCATION', 'B', 0, 'R');
        $this->Ln(6);

        $_counter = 1;
        $_countert = 1;
        $w = [8, 20, 67, 25, 30, 25, 15];

        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[0], 6, 'No', 0, 0, 'L', true);
        $this->Cell($w[1], 6, 'Level', 0, 0, 'L', true);
        $this->Cell($w[2] + $w[3], 6, 'Institution Name/Major', 0, 0, 'L', true);
        $this->Cell($w[4], 6, 'City/Country', 0, 0, 'L', true);
        $this->Cell($w[5], 6, 'Grad. Year', 0, 0, 'L', true);
        $this->Cell($w[6], 6, 'GPA', 0, 0, 'L', true);
        $this->Ln();

        foreach ($model->many_education as $mod_education) {
            $this->SetFont('Arial', '', 9);
            $this->Cell($w[0], 5, peterFunc::indoFormat($_countert), 0, 0, 'R');
            $this->Cell($w[1], 5, substr($mod_education->edulevel->name, 0, 7));
            $this->Cell($w[2] + $w[3], 5, peterFunc::shorten_string($mod_education->school_name, 7));
            $this->Cell($w[4], 5, $mod_education->city);
            $this->Cell($w[5], 5, $mod_education->graduate);
            $this->Cell($w[6], 5, $mod_education->ipk);
            $this->Ln();
            $this->Cell($w[0], 5, '');
            $this->Cell($w[1], 5, '');
            $this->Cell($w[2] + $w[3], 5, ' (' . $mod_education->interest . ')');
            $this->Cell($w[4], 5, $mod_education->country);
            $this->Cell($w[5], 5, '');
            $this->Cell($w[6], 5, '');
            $this->Ln(6);


            $_counter++;
            $_countert++;
        }
        $this->Ln(8);

        if ($this->GetY() >= 230) {
            $this->AddPage();
            $this->myheader($model);
        }

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 5, 'NON FORMAL EDUCATION', 'B', 0, 'R');
        $this->Ln(6);

        $_counter = 1;
        $_countert = 1;
        $w = [8, 60, 40, 25, 25, 10, 22];

        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[0], 6, 'No', 0, 0, 'L', true);
        $this->Cell($w[1], 6, 'Name', 0, 0, 'L', true);
        $this->Cell($w[2], 6, 'Category', 0, 0, 'L', true);
        $this->Cell($w[3], 6, 'Start Date', 0, 0, 'L', true);
        $this->Cell($w[4], 6, 'End Date', 0, 0, 'L', true);
        $this->Cell($w[5], 6, 'Certf.', 0, 0, 'L', true);
        $this->Cell($w[6], 6, 'Country', 0, 0, 'L', true);
        $this->Ln(8);

        foreach ($model->many_educationnf as $mod_educationnf) {
            $this->SetFont('Arial', '', 9);
            $this->Cell($w[0], 5, peterFunc::indoFormat($_countert), 0, 0, 'R');
            $this->Cell($w[1], 5, peterFunc::shorten_string($mod_educationnf->education_name, 4));
            $this->Cell($w[2], 5, peterFunc::shorten_string($mod_educationnf->category, 3));
            $this->Cell($w[3], 5, $mod_educationnf->start);
            $this->Cell($w[4], 5, $mod_educationnf->end);
            $this->Cell($w[5], 5, ($mod_educationnf->sertificate == 0) ? "Tidak" : "Ya");
            $this->Cell($w[6], 5, $mod_educationnf->country);
            $this->Ln();


            $_counter++;
            $_countert++;
        }
        $this->Ln(8);

        //if ($this->GetY() >=230) {
        //$this->AddPage();
        //	$this->myheader($model);
        //}

        /*
          $this->SetFont('Arial','B',10);
          $this->Cell(0,5,'FAMILY','B',0,'R');
          $this->Ln(6);

          $_counter = 1;
          $_countert = 1;
          $w=array(8,40,20,30,30,30,10);

          $this->SetFont('Arial','B',9);
          $this->Cell($w[0],5,'No');
          $this->Cell($w[1],5,'Name');
          $this->Cell($w[2],5,'Relation');
          $this->Cell($w[3],5,'Birth Place');
          $this->Cell($w[4],5,'Birth Date');
          $this->Cell($w[5],5,'Gender');
          $this->Cell($w[6],5,'Payroll Covered');
          $this->Ln(8);

          foreach($model->many_family as $mod_family)
          {
          $this->SetFont('Arial','',9);
          $this->Cell($w[0],5,peterFunc::indoFormat($_countert),0,0,'R');
          $this->Cell($w[1],5,$mod_family->f_name);
          $this->Cell($w[2],5,$mod_family->relation->name);
          $this->Cell($w[3],5,$mod_family->birth_place);
          $this->Cell($w[4],5,$mod_family->birth_date);
          $this->Cell($w[5],5,($mod_family->sex_id == 1) ? "Laki-Laki" : "Perempuan");
          $this->Cell($w[6],5,($mod_family->payroll_cover_id == 1) ? "Ya" : "Tidak");
          $this->Ln();


          $_counter++;
          $_countert++;

          }
          $this->Ln(8);
         */
    }

}

