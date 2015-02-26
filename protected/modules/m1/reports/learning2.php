<?php

class learning2 extends fpdf
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
        $this->Cell(0, 5, 'EMPLOYEE TRAINING LIST', 'R', 0, 'C');
        $this->Ln();
        $this->Cell(0, 5, '', 'LBR');
        $this->Ln();


        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, '', 0, 0, 'C');
        $this->Ln();

        $this->SetFillColor(230, 230, 230);

        $w = [20, 75, 30, 20, 45];

        $this->Cell(0, 1, '', 'B');
        $this->Ln();

        $this->SetFont('Arial', 'B', 8);
        $this->Cell($w[0], 8, 'Start Date', 'LTRB', 0, 'C', true);
        $this->Cell($w[1], 8, 'Topic', 'LTRB', 0, 'C', true);
        $this->Cell($w[2], 8, 'Instructor', 'LTRB', 0, 'C', true);
        $this->Cell($w[3], 8, 'Mandays', 'LTRB', 0, 'C', true);
        $this->Cell($w[4], 8, 'Organizer', 'LTRB', 0, 'C', true);
        $this->Ln();
    }

    function report()
    {
        $criteria = new CDbCriteria;

        $criteria->with = ['company', 'many_training_holding_empty'];

        $criteria->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' .
            implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
            ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
            implode(",", sUser::model()->myGroupArray) . ') OR ' .
            '(select c2.company_id from g_person_career2 c2 WHERE t.id=c2.parent_id AND c2.company_id IN (' .
            implode(",", sUser::model()->myGroupArray) . ') ORDER BY c2.start_date DESC LIMIT 1) IN (' .
            implode(",", sUser::model()->myGroupArray) . ')';

        $criteria->order = '(select count(tr.id) from i_learning_sch_part tr where t.id = tr.employee_id), employee_name';

        $models = gPerson::model()->findAll($criteria);

        //$models=gPerson::model()->assignmentList;

        $this->myheader();

        $this->SetFillColor(230, 230, 230);

        $w = [20, 75, 30, 20, 45];

        $_mandays = 0;
        $_total = 0;
        $fill = false;
        foreach ($models as $model) {
            $fill = true;
            $this->SetFont('Arial', 'B', 10);
            $this->Cell($w[0] + $w[1] + $w[2], 8, " " . $model->employeeShortId . "  " . $model->employee_name, 'LT', 0, 'L', $fill);
            $this->Cell($w[3], 8, "", 'T', 0, 'L', $fill);
            $this->Cell($w[4], 8, "", 'TR', 0, 'L', $fill);
            $this->Ln();

            if (isset($model->many_training_holding)) {
                foreach ($model->many_training_holding as $mod) {
                    $fill = false;
                    $_mandays = (int)$mod->getparent->actual_mandays / (int)$mod->getparent->partCount();

                    $this->SetFont('Arial', '', 8);
                    $this->Cell($w[0], 5, $mod->getparent->schedule_date, 'LR', 0, 'C', $fill);
                    $this->Cell($w[1], 5, $mod->getparent->getparent->learning_title, 'LR', 0, 'L', $fill);
                    $this->Cell($w[2], 5, $mod->getparent->trainer_name, 'LR', 0, 'L', $fill);
                    $this->Cell($w[3], 5, peterFunc::indoFormat($_mandays, 1), 'LR', 0, 'C', $fill);
                    $this->Cell($w[4], 5, $mod->getparent->location, 'LR', 0, 'L', $fill);
                    $this->Ln();
                    $_total = $_total + $_mandays;
                }
            } else {
                $this->SetFont('Arial', '', 8);
                $this->Cell($w[0], 5, '', 'LR', 0, 'C', $fill);
                $this->Cell($w[1], 5, '', 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 5, '', 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 5, '', 'LR', 0, 'C', $fill);
                $this->Cell($w[4], 5, '', 'LR', 0, 'L', $fill);
                $this->Ln();
            }

            if ($this->GetY() >= 250) {
                $this->Cell(array_sum($w), 4, '', 'T');
                $this->AddPage();
                $this->myheader($models);
            }
        }
        $this->Cell(array_sum($w), 4, '', 'TB');
        $this->Ln();

        $this->SetFont('Arial', 'B', 8);
        $this->Cell($w[0], 5, '', 'LR', 0, 'C', $fill);
        $this->Cell($w[1], 5, '', 'LR', 0, 'L', $fill);
        $this->Cell($w[2], 5, 'T O T A L', 'LR', 0, 'L', $fill);
        $this->Cell($w[3], 5, peterFunc::indoFormat($_total, 1), 'LR', 0, 'C', $fill);
        $this->Cell($w[4], 5, '', 'LR', 0, 'L', $fill);
        $this->Ln();
        $this->Cell(array_sum($w), 4, '', 'T');
    }

}

