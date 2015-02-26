<?php

class learning3 extends fpdf
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
        $this->Cell(0, 5, 'TRAINING BY MONTH', 'R', 0, 'C');
        $this->Ln();
        $this->Cell(0, 5, '', 'LBR');
        $this->Ln();


        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, '', 0, 0, 'C');
        $this->Ln();

        $this->SetFillColor(230, 230, 230);

        $w = [20, 40, 75, 40, 15];

        $this->Cell(0, 1, '', 'B');
        $this->Ln();

        $this->SetFont('Arial', 'B', 8);
        $this->Cell($w[0], 8, 'Start Date', 'LTRB', 0, 'C', true);
        $this->Cell($w[1], 8, 'Employee Name', 'LTRB', 0, 'C', true);
        $this->Cell($w[2], 8, 'Topics', 'LTRB', 0, 'C', true);
        $this->Cell($w[3], 8, 'Instructor', 'LTRB', 0, 'C', true);
        $this->Cell($w[4], 8, 'Mandays', 'LTRB', 0, 'C', true);
        $this->Ln();
    }

    function report()
    {
        $criteria = new CDbCriteria;

        $criteria->condition = '(select c.company_id from g_person_career c WHERE t.employee_id=c.parent_id AND c.status_id IN (' .
            implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
            ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
            implode(",", sUser::model()->myGroupArray) . ') OR ' .
            '(select c2.company_id from g_person_career2 c2 WHERE t.employee_id=c2.parent_id AND c2.company_id IN (' .
            implode(",", sUser::model()->myGroupArray) . ') ORDER BY c2.start_date DESC LIMIT 1) IN (' .
            implode(",", sUser::model()->myGroupArray) . ')';

        $criteria->order = 'getparent.schedule_date,getparent.parent_id, employee.employee_name';
        $criteria->with = ['getparent', 'employee'];

        $criteria1 = new CDbCriteria;
        $criteria1->condition = 'YEAR(getparent.schedule_date) = ' . date("Y");
        $criteria->mergeWith($criteria1);

        $models = iLearningSchPart::model()->findAll($criteria);

        $this->myheader();

        $this->SetFillColor(230, 230, 230);

        $w = [20, 40, 75, 40, 15];

        $fill = false;
        $_mandays = 0;
        $_total = 0;
        $_totalMonth = 0;
        $check = "";

        foreach ($models as $mod) {

            if (date("Ym", strtotime($mod->getparent->schedule_date)) != $check) {

                if ($check != "") {
                    $this->SetFont('Arial', 'B', 8);
                    $this->Cell($w[0] + $w[1] + $w[2], 5, '', 'LT', 0, 'L');
                    $this->Cell($w[3], 5, "T O T A L  ", 'TR', 0, 'R');
                    $this->Cell($w[4], 5, peterFunc::indoFormat($_totalMonth, 1), 'TR', 0, 'C');
                    $this->Ln();

                    $_totalMonth = 0;
                }

                $fill = true;
                $this->Cell($w[0] + $w[1] + $w[2], 8, peterFunc::bulan($mod->getparent->schedule_date) . " " . date("Y", strtotime($mod->getparent->schedule_date)), 'LT', 0, 'L', $fill);
                $this->Cell($w[3], 8, "", 'T', 0, 'L', $fill);
                $this->Cell($w[4], 8, "", 'TR', 0, 'L', $fill);
                $this->Ln();
            }

            $fill = false;

            $_mandays = (int)$mod->getparent->actual_mandays / (int)$mod->getparent->partCount();

            $this->SetFont('Arial', '', 8);
            $this->Cell($w[0], 5, $mod->getparent->schedule_date, 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 5, $mod->employee->employee_name, 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 5, peterFunc::shorten_string($mod->getparent->getparent->learning_title, 6), 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 5, $mod->getparent->trainer_name, 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 5, peterFunc::indoFormat($_mandays, 1), 'LR', 0, 'C', $fill);
            $this->Ln();

            $_total = $_total + $_mandays;
            $_totalMonth = $_totalMonth + $_mandays;

            $check = date("Ym", strtotime($mod->getparent->schedule_date));


            if ($this->GetY() >= 250) {
                $this->Cell(array_sum($w), 4, '', 'T');
                $this->AddPage();
                $this->myheader($models);
            }
        }

        $this->SetFont('Arial', 'B', 8);
        $this->Cell($w[0] + $w[1] + $w[2], 5, '', 'LT', 0, 'L');
        $this->Cell($w[3], 5, "T O T A L  ", 'TR', 0, 'R');
        $this->Cell($w[4], 5, peterFunc::indoFormat($_totalMonth, 1), 'TR', 0, 'C');
        $this->Ln();

        $this->Cell(array_sum($w), 4, '', 'TB');
        $this->Ln();

        $this->SetFont('Arial', 'B', 8);
        $this->Cell($w[0], 5, '', 'LR', 0, 'C', $fill);
        $this->Cell($w[1], 5, '', 'LR', 0, 'L', $fill);
        $this->Cell($w[2], 5, '', 'LR', 0, 'L', $fill);
        $this->Cell($w[3], 5, 'T O T A L', 'LR', 0, 'C', $fill);
        $this->Cell($w[4], 5, peterFunc::indoFormat($_total, 1), 'LR', 0, 'C', $fill);
        $this->Ln();
        $this->Cell(array_sum($w), 4, '', 'T');
    }

}

