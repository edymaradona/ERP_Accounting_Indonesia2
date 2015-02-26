<?php

class profile extends fpdf
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
        if (is_file(Yii::app()->basePath . '/../shareimages/hr/employee/thumb/' . $model->c_pathfoto))
            $this->Image('shareimages/hr/employee/' . $model->c_pathfoto, 12, 10, 15);
        $this->SetY($this->y0);
        $this->SetFont('Arial', 'B', 13);
        $this->Ln();
        $this->Cell(20);
        $this->Cell(100, 5, strtoupper($model->employee_name));
        $this->Ln();
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(20);
        $_hp2 = peterFunc::issetC($model->handphone2);
        $_email = ($model->email != null) ? " | " . $model->email : "";
        $this->Cell(100, 4, $model->employeeShortID . $_hp2 . $_email);
        $this->Ln(14);
    }

    function report($model)
    {


        $this->y0 = $this->GetY();
        if (is_file(Yii::app()->basePath . '/../shareimages/hr/employee/' . $model->c_pathfoto))
            $this->Image('shareimages/hr/employee/' . $model->c_pathfoto, 10, 10, 28);
        $this->SetY($this->y0);
        $this->SetFont('Arial', 'B', 13);
        $this->Cell(30);
        $this->Cell(100, 5, strtoupper($model->employee_name));
        $this->Ln();
        $this->Cell(30);
        $this->SetFont('Arial', '', 10);
        $this->MultiCell(0, 5, $model->address1 . ' ' . $model->address2 . ' ' . $model->address3);
        $this->Ln();
        $this->Cell(30);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(35, 5, 'ID Employee');
        $this->SetFont('Arial', '', 10);
        $this->Cell(65, 5, $model->employeeShortID);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(35, 5, 'Religion');
        $this->SetFont('Arial', '', 10);
        $this->Cell(50, 5, $model->religion->name);
        $this->Ln();
        $this->Cell(30);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(35, 5, 'Email');
        $this->SetFont('Arial', '', 10);
        $_email = ($model->email2 != null) ? " ; " . $model->email2 : "";
        $this->Cell(65, 5, $model->email . $_email);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(35, 5, 'Gender');
        $this->SetFont('Arial', '', 10);
        $this->Cell(50, 5, ($model->sex_id == 1) ? 'Male' : 'Female');
        $this->Ln();
        $this->Cell(30);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(35, 5, 'Birth of Date');
        $this->SetFont('Arial', '', 10);
        $this->Cell(65, 5, trim($model->birth_place) . ', ' . $model->birth_date);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(35, 5, 'Marital Status');
        $this->SetFont('Arial', '', 10);
        $this->Cell(50, 5, $model->maritalStatus());
        $this->Ln();
        $this->Cell(30);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(35, 5, 'Contact Number');
        $this->SetFont('Arial', '', 10);
        $_hp1 = ($model->handphone != null) ? $model->handphone : "";
        $_hp2 = ($model->handphone2 != null) ? " / " . $model->handphone2 : "";
        $_home = ($model->home_phone != null) ? " / " . $model->home_phone : "";
        $this->Cell(100, 5, $_hp1 . $_hp2 . $_home);
        $this->Ln();
        $this->Cell(30);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(35, 5, 'Length of Service');
        $this->SetFont('Arial', '', 10);
        $this->Cell(100, 5, $model->countJoinDate());
        $this->Ln(6);

        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(206, 206, 206);
        //$this->Cell(0,3,'',0,0,'C',true);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 5, 'CAREER', 'B', 0, 'R');
        $this->Ln(6);

        $_counter = 1;
        $_countert = 1;
        $w = [5, 21, 25, 70, 33, 36];

        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[0], 6, 'No', 0, 0, 'L', true);
        $this->Cell($w[1], 6, 'Date', 0, 0, 'L', true);
        $this->Cell($w[2], 6, 'Status', 0, 0, 'L', true);
        $this->Cell($w[3], 6, 'Company/Dept', 0, 0, 'L', true);
        $this->Cell($w[4], 6, 'Level', 0, 0, 'L', true);
        $this->Cell($w[5], 6, 'Job Title', 0, 0, 'L', true);
        $this->Ln(8);

        foreach ($model->many_career as $mod_career) {
            $this->SetFont('Arial', '', 9);
            $this->Cell($w[0], 5, peterFunc::indoFormat($_countert), 0, 0, 'R');
            $this->Cell($w[1], 5, $mod_career->start_date);
            $this->Cell($w[2], 5, $mod_career->status->name);
            $this->Cell($w[3], 5, $mod_career->company->name);
            $this->Cell($w[4], 5, $mod_career->level->name);
            $y1 = $this->GetY();
            $this->MultiCell($w[5], 5, $mod_career->job_title);
            $y2 = $this->GetY();
            $yH = $y2 - $y1;
            $yC = $this->GetY();
            $this->SetXY($w[0] + $w[1] + $w[2] + $w[3] + $w[4], $yC - $yH);

            $this->Ln();
            $this->Cell($w[0], 5, '');
            $this->Cell($w[1], 5, '');
            $this->Cell($w[2], 5, '');
            $this->Cell($w[3], 5, $mod_career->department->name);
            $this->Cell($w[4], 5, '');
            $this->Cell($w[5], 5, '');
            $this->Ln();

            if ($this->GetY() >= 230) {
                $this->AddPage();
                $this->myheader($model);
            }

            $_counter++;
            $_countert++;
        }
        $this->Ln(8);

        if ($model->many_career2 != null) {
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(0, 5, 'ASSIGNMENT', 'B', 0, 'R');
            $this->Ln(6);

            $_counter = 1;
            $_countert = 1;
            $w = [7, 22, 22, 70, 33, 36];

            $this->SetFont('Arial', 'B', 9);
            $this->Cell($w[0], 6, 'No', 0, 0, 'L', true);
            $this->Cell($w[1], 6, 'Start Date', 0, 0, 'L', true);
            $this->Cell($w[2], 6, 'End Date', 0, 0, 'L', true);
            $this->Cell($w[3], 6, 'Tempat Penugasan', 0, 0, 'L', true);
            $this->Cell($w[4], 6, 'Level', 0, 0, 'L', true);
            $this->Cell($w[5], 6, 'Job Title', 0, 0, 'L', true);
            $this->Ln(8);

            foreach ($model->many_career2 as $mod_career2) {
                $this->SetFont('Arial', '', 9);
                $this->Cell($w[0], 5, peterFunc::indoFormat($_countert), 0, 0, 'R');
                $this->Cell($w[1], 5, $mod_career2->start_date);
                $this->Cell($w[2], 5, $mod_career2->start_date);
                $this->Cell($w[3], 5, $mod_career2->company->name);
                $this->Cell($w[4], 5, $mod_career2->level->name);
                $y1 = $this->GetY();
                $this->MultiCell($w[5], 5, $mod_career2->job_title);
                $y2 = $this->GetY();
                $yH = $y2 - $y1;
                $yC = $this->GetY();
                $this->SetXY($w[0] + $w[1] + $w[2] + $w[3] + $w[4], $yC - $yH);

                $this->Ln();
                $this->Cell($w[0], 5, '');
                $this->Cell($w[1], 5, '');
                $this->Cell($w[2], 5, '');
                $this->Cell($w[3], 5, $mod_career2->department->name);
                $this->Cell($w[4], 5, '');
                $this->Cell($w[5], 5, '');
                $this->Ln();

                if ($this->GetY() >= 230) {
                    $this->AddPage();
                    $this->myheader($model);
                }

                $_counter++;
                $_countert++;
            }
            $this->Ln(8);
        }

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 5, 'EMPLOYMENT STATUS', 'B', 0, 'R');
        $this->Ln(6);

        $_counter = 1;
        $_countert = 1;
        $w = [5, 25, 25, 135];

        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[0], 6, 'No', 0, 0, 'L', true);
        $this->Cell($w[1], 6, 'Start Date', 0, 0, 'L', true);
        $this->Cell($w[2], 6, 'End Date', 0, 0, 'L', true);
        $this->Cell($w[3], 6, 'Status', 0, 0, 'L', true);
        $this->Ln(8);

        foreach ($model->many_status as $mod_status) {
            $this->SetFont('Arial', '', 9);
            $this->Cell($w[0], 5, peterFunc::indoFormat($_countert), 0, 0, 'R');
            $this->Cell($w[1], 5, $mod_status->start_date);
            $this->Cell($w[2], 5, $mod_status->end_date);
            $this->Cell($w[3], 5, $mod_status->status->name);
            $this->Ln();

            if ($this->GetY() >= 230) {
                $this->AddPage();
                $this->myheader($model);
            }

            $_counter++;
            $_countert++;
        }
        $this->Ln(8);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 5, 'EXPERIENCE', 'B', 0, 'R');
        $this->Ln(6);

        $_counter = 1;
        $_countert = 1;
        $w = [5, 60, 35, 20, 20, 50];

        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[0], 6, 'No', 0, 0, 'L', true);
        $this->Cell($w[1] + $w[2], 6, 'Company/Industries', 0, 0, 'L', true);
        $this->Cell($w[3] + $w[4], 6, 'Period', 0, 0, 'L', true);
        $this->Cell($w[5], 6, 'Job Title', 0, 0, 'L', true);
        $this->Ln(8);

        foreach ($model->many_experience as $mod_experience) {
            $this->SetFont('Arial', '', 9);
            $this->Cell($w[0], 5, peterFunc::indoFormat($_countert), 0, 0, 'R');
            $this->Cell($w[1] + $w[2], 5, $mod_experience->company_name);
            $this->Cell($w[3] + $w[4], 5, $mod_experience->start_date . ' - ' . $mod_experience->end_date);
            $y1 = $this->GetY();
            $this->MultiCell($w[5], 5, $mod_experience->job_title);
            $y2 = $this->GetY();
            $yH = $y2 - $y1;
            $yC = $this->GetY();
            $this->SetXY($w[0] + $w[1] + $w[2] + $w[3] + $w[4], $yC - $yH);

            $this->Ln();
            $this->Cell($w[0], 5, '');
            $_industries = ($mod_experience->industries != null) ? "(" . $mod_experience->industries . ")" : "";
            $this->Cell($w[1] + $w[2], 5, $_industries);
            $this->Cell($w[3] + $w[4], 5, '(' . $mod_experience->year_length . ' years ' . $mod_experience->month_length . ' months)');
            $this->Cell($w[5], 5, '');
            $this->Ln(6);

            if ($this->GetY() >= 230) {
                $this->AddPage();
                $this->myheader($model);
            }

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
        $w = [5, 20, 40, 22, 34, 20, 37, 12];

        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[0], 6, 'No', 0, 0, 'L', true);
        $this->Cell($w[1], 6, 'Level', 0, 0, 'L', true);
        $this->Cell($w[2] + $w[3], 6, 'Institution Name/Major', 0, 0, 'L', true);
        $this->Cell($w[4], 6, 'City', 0, 0, 'L', true);
        $this->Cell($w[5], 6, 'Grad. Year', 0, 0, 'L', true);
        $this->Cell($w[6], 6, 'Country', 0, 0, 'L', true);
        $this->Cell($w[7], 6, 'GPA', 0, 0, 'L', true);
        $this->Ln(8);

        foreach ($model->many_education as $mod_education) {
            $this->SetFont('Arial', '', 9);
            $this->Cell($w[0], 5, peterFunc::indoFormat($_countert), 0, 0, 'R');
            $this->Cell($w[1], 5, $mod_education->edulevel->name);
            $this->Cell($w[2] + $w[3], 5, $mod_education->school_name);
            $this->Cell($w[4], 5, $mod_education->city);
            $this->Cell($w[5], 5, $mod_education->graduate);
            $this->Cell($w[6], 5, $mod_education->country);
            $this->Cell($w[7], 5, $mod_education->ipk);
            $this->Ln();
            $this->Cell($w[0], 5, '');
            $this->Cell($w[1], 5, '');
            $this->Cell($w[2] + $w[3], 5, ' (' . $mod_education->interest . ')');
            $this->Cell($w[4], 5, '');
            $this->Cell($w[5], 5, '');
            $this->Cell($w[6], 5, '');
            $this->Cell($w[7], 5, '');
            $this->Ln(6);

            if ($this->GetY() >= 230) {
                $this->AddPage();
                $this->myheader($model);
            }

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
        $w = [5, 30, 70, 20, 20, 20, 25];

        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[0], 6, 'No', 0, 0, 'L', true);
        $this->Cell($w[1], 6, 'Name', 0, 0, 'L', true);
        $this->Cell($w[2], 6, 'Category', 0, 0, 'L', true);
        $this->Cell($w[3], 6, 'Start Date', 0, 0, 'L', true);
        $this->Cell($w[4], 6, 'End Date', 0, 0, 'L', true);
        $this->Cell($w[5], 6, 'Certificate', 0, 0, 'L', true);
        $this->Cell($w[6], 6, 'Country', 0, 0, 'L', true);
        $this->Ln(8);

        foreach ($model->many_educationnf as $mod_educationnf) {
            $this->SetFont('Arial', '', 9);
            $this->Cell($w[0], 5, peterFunc::indoFormat($_countert), 0, 0, 'R');
            $this->Cell($w[1], 5, peterFunc::shorten_string($mod_educationnf->education_name, 2));
            $this->Cell($w[2], 5, peterFunc::shorten_string($mod_educationnf->category, 5));
            $this->Cell($w[3], 5, $mod_educationnf->start);
            $this->Cell($w[4], 5, $mod_educationnf->end);
            $this->Cell($w[5], 5, ($mod_educationnf->sertificate == 0) ? "Tidak" : "Ya");
            $this->Cell($w[6], 5, $mod_educationnf->country);
            $this->Ln();

            if ($this->GetY() >= 230) {
                $this->AddPage();
                $this->myheader($model);
            }

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
          $this->SetFont('Arial','',10);
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

