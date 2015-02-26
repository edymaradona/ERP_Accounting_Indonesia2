<?php

class aBudgetPosition2 extends fpdf
{

    //Page footer
    function Footer()
    {
        //Position at 1.5 cm from bottom
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial', 'I', 6);
        //Page number
        $this->Cell(0, 10, 'Print Date: ' . Yii::app()->dateFormatter->format("dd-MM-yyyy", time()) . '                        ' .
            'Page: ' . $this->PageNo() . '/{nb}' . '                        ' .
            'Report Code: budgetPosition2/R1', 0, 0, 'C');
    }

    function myheader($id, $pro_id)
    {
        $this->SetFont('Arial', 'B', 6);
        $this->Cell(50, 4, Yii::app()->params["title"]);
        $this->Ln(3);
        $this->Cell(50, 4, 'Budget Position');
        $this->Cell(100);
        $this->Ln(3);
        $this->Cell(50, 4, ($pro_id == 1) ? 'Project: CP' : 'Project: RMG/MGR');
        $this->Ln(5);

        $w = [47, 23, 23, 10, 23, 10, 23, 10, 23];


        $this->SetFont('Arial', 'B', 7);
        $this->Cell($w[0], 6, 'Name', 'TLR');
        $this->Cell($w[1], 6, 'Amount', 1, 0, 'C');
        $this->Cell($w[2], 6, 'Realization', 1, 0, 'C');
        $this->Cell($w[3], 6, '%', 1, 0, 'C');
        $this->Cell($w[4], 6, 'Paid', 1, 0, 'C');
        $this->Cell($w[5], 6, '%', 1, 0, 'C');
        $this->Cell($w[6], 6, 'UnPaid', 1, 0, 'C');
        $this->Cell($w[7], 6, '%', 1, 0, 'C');
        $this->Cell($w[8], 6, 'Balance', 1, 0, 'C');
        $this->Ln();


        $this->Cell($w[0], 1, '', 'LTR');
        $this->Cell($w[1], 1, '', 'TR');
        $this->Cell($w[2], 1, '', 'TR');
        $this->Cell($w[3], 1, '', 'TR');
        $this->Cell($w[4], 1, '', 'TR');
        $this->Cell($w[5], 1, '', 'TR');
        $this->Cell($w[6], 1, '', 'TR');
        $this->Cell($w[7], 1, '', 'TR');
        $this->Cell($w[8], 1, '', 'TR');
        $this->Ln();
    }

    function report($id, $pro_id)
    {
        $criteria = new CDbCriteria;
        $criteria->order = 'code';
        $criteria->compare('department_id', $pro_id);
        $criteria->compare('parent_id', $id);
        //$criteria->compare('amount!',0);
        $criteria->addNotInCondition('id', [193, 119, 164, 198]);
        $models = aBudget::model()->findAll($criteria);

        $this->myheader($id, $pro_id);

        $w = [47, 23, 23, 10, 23, 10, 23, 10, 23];

        $this->SetFont('Arial', '', 7);

        $_total = 0;
        $_realization = 0;
        $_payment = 0;
        $_unpayment = 0;
        $_balance = 0;

        foreach ($models as $model) {
            $_amount = $model->amount;
            $_real = aBudget::model()->allComponent($model->id, 2012, 1);
            $_realP = ($_amount != 0) ? ($_real / $_amount) * 100 : 0;
            $_paid = aBudget::model()->allComponentPaid($model->id, 2012, 1);
            $_paidP = ($_real != 0) ? ($_paid / $_real) * 100 : 0;
            $_unpaid = $_real - $_paid;
            $_unpaidP = ($_real != 0) ? ($_unpaid / $_real) * 100 : 0;
            $_endBalance = isset($model->end_balance) ? $model->end_balance->balance : $_amount;


            $this->SetFont('Arial', '', 7);
            $this->Cell($w[0], 6, $model->code . ". " . $model->name, 'L');
            $this->Cell($w[1], 6, peterFunc::indoFormat($_amount, 2), 'LR', 0, 'R');
            $this->Cell($w[2], 6, peterFunc::indoFormat($_real, 2), '', 0, 'R');
            $this->Cell($w[3], 6, round($_realP, 2), 'LR', 0, 'R');
            $this->Cell($w[4], 6, peterFunc::indoFormat($_paid, 2), '', 0, 'R');
            $this->Cell($w[5], 6, round($_paidP, 2), 'LR', 0, 'R');
            $this->Cell($w[6], 6, peterFunc::indoFormat($_unpaid, 2), '', 0, 'R');
            $this->Cell($w[7], 6, round($_unpaidP, 2), 'LR', 0, 'R');
            $this->Cell($w[8], 6, peterFunc::indoFormat($_endBalance), 'LR', 0, 'R');
            $this->Ln();

            $_total = $_total + $_amount;
            $_realization = $_realization + $_real;
            $_payment = $_payment + $_paid;
            $_unpayment = $_unpayment + $_unpaid;

            $_balance = $_balance + $_endBalance;
        }

        $this->Cell(array_sum($w), 4, '', 'T');
        $this->Ln(6);

        $_realizationP = ($_total != 0) ? ($_realization / $_total) * 100 : 0;
        $_paymentP = ($_realization != 0) ? ($_payment / $_realization) * 100 : 0;
        $_unpaymentP = ($_realization != 0) ? ($_unpayment / $_realization) * 100 : 0;

        $this->SetFont('Arial', 'B', 8);
        $this->Cell($w[0], 8, 'T O T A L', 1);
        $this->Cell($w[1], 8, peterFunc::indoFormat($_total), 1, 0, 'R');
        $this->Cell($w[2], 8, peterFunc::indoFormat($_realization), 1, 0, 'R');
        $this->Cell($w[3], 8, round($_realizationP, 2), 1, 0, 'R');
        $this->Cell($w[4], 8, peterFunc::indoFormat($_payment), 1, 0, 'R');
        $this->Cell($w[5], 8, round($_paymentP, 2), 1, 0, 'R');
        $this->Cell($w[6], 8, peterFunc::indoFormat($_unpayment), 1, 0, 'R');
        $this->Cell($w[7], 8, round($_unpaymentP, 2), 1, 0, 'R');
        $this->Cell($w[8], 8, peterFunc::indoFormat($_balance), 1, 0, 'R');
        $this->Ln();
    }

}

?>