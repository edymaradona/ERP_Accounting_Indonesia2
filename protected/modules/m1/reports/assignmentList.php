<?php

class assignmentList extends fpdf
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

    function myheader()
    {
        $this->y0 = $this->GetY();
        $this->Cell(0, 5, '', 'T', 0, 'C');
        $this->Image('shareimages/company/logoAlt1.jpg', 15, 12, 30);
        $this->SetY($this->y0);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 5, '', 'LR');
        $this->Ln();
        $this->Cell(30, 5, '', 'L');
        $this->Cell(0, 5, 'MULTI POSITION EMPLOYEES', 'R', 0, 'C');
        $this->Ln();
        $this->Cell(0, 5, '', 'LBR');
        $this->Ln();


        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, '', 0, 0, 'C');
        $this->Ln();

        $this->SetFillColor(230, 230, 230);

        $w = [30, 20, 20, 70, 37, 40, 64];

        $this->Cell(0, 1, '', 'B');
        $this->Ln();

        $this->SetFont('Arial', 'B', 8);
        $this->Cell($w[0], 8, 'NIK', 'LTRB', 0, 'C', true);
        $this->Cell($w[1], 8, 'Start Date', 'LTRB', 0, 'C', true);
        $this->Cell($w[2], 8, 'End Date', 'LTRB', 0, 'C', true);
        $this->Cell($w[3], 8, 'Company', 'LTRB', 0, 'C', true);
        $this->Cell($w[4], 8, 'Department', 'LTRB', 0, 'C', true);
        $this->Cell($w[5], 8, 'Level', 'LTRB', 0, 'C', true);
        $this->Cell($w[6], 8, 'Job Title', 'LTRB', 0, 'C', true);
        $this->Ln();
    }

    function report()
    {
        $criteria = new CDbCriteria;

        $criteria->with = ['company', 'many_career2'];
        $criteria->order = 't.employee_code_global';
        $criteria->condition = ' t.id IN (select parent_id from g_person_career2)';

        $criteria1 = new CDbCriteria; //JOIN, JOIN CONTINUED, ROTATION
        $criteria1->condition = '(select status_id from g_person_career s where s.parent_id = t.id AND s.status_id IN (' . implode(',', Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ') ORDER BY start_date DESC LIMIT 1) IN (' . implode(',', Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ')';

        $criteria3 = new CDbCriteria; //8=RESIGN, 9=TERMINATION, 10=End Of Contract
        $criteria3->condition = '(select status_id from g_person_status s where s.parent_id = t.id ORDER BY start_date DESC LIMIT 1) NOT IN (' . implode(',', Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY) . ')';

        $criteria->mergeWith($criteria1);
        $criteria->mergeWith($criteria3);


        $models = gPerson::model()->findAll($criteria);

        //$models=gPerson::model()->assignmentList;

        $this->myheader();

        $this->SetFillColor(230, 230, 230);

        $w = [30, 20, 20, 70, 37, 40, 64];

        $fill = false;
        foreach ($models as $model) {
            $fill = true;
            $this->SetFont('Arial', 'B', 10);
            $this->Cell($w[0] + $w[1] + $w[2] + $w[3], 8, " " . $model->employeeShortId . "  " . $model->employee_name, 'LT', 0, 'L', $fill);
            $this->Cell($w[4], 8, "", 'T', 0, 'L', $fill);
            $this->Cell($w[5], 8, "", 'T', 0, 'L', $fill);
            $this->Cell($w[6], 8, "", 'TR', 0, 'L', $fill);
            $this->Ln();

            $fill = false;
            $this->SetFont('Arial', '', 8);
            $this->Cell($w[0], 5, $model->employeeFinanceId, 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 5, $model->company->start_date, 'LR', 0, 'C', $fill);
            $this->Cell($w[2], 5, "", 'LR', 0, 'C', $fill);
            $this->Cell($w[3], 5, $model->company->company->name, 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 5, $model->company->department->name, 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 5, $model->mLevel(), 'LR', 0, 'L', $fill);
            $this->Cell($w[6], 5, $model->mJobTitle(), 'LR', 0, 'L', $fill);
            $this->Ln();

            foreach ($model->many_career2 as $mod) {
                $fill = false;
                $this->SetFont('Arial', '', 8);
                $this->Cell($w[0], 5, $mod->employeeFinanceId, 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 5, $mod->start_date, 'LR', 0, 'C', $fill);
                $this->Cell($w[2], 5, $mod->end_date, 'LR', 0, 'C', $fill);
                $this->Cell($w[3], 5, $mod->company->name, 'LR', 0, 'L', $fill);
                $this->Cell($w[4], 5, $mod->department->name, 'LR', 0, 'L', $fill);
                $this->Cell($w[5], 5, $mod->level->name, 'LR', 0, 'L', $fill);
                $this->Cell($w[6], 5, $mod->job_title, 'LR', 0, 'L', $fill);
                $this->Ln();
            }

            if ($this->GetY() >= 165) {
                $this->Cell(array_sum($w), 4, '', 'T');
                $this->AddPage();
                $this->myheader($models);
            }
        }
        $this->Cell(array_sum($w), 4, '', 'T');
    }

}

