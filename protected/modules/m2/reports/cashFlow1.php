<?php

class cashFlow1 extends fpdf
{

    //Page footer
    function Footer()
    {
        //Position at 1.5 cm from bottom
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        //Page number
        $this->Cell(0, 10, 'Print Date: ' . Yii::app()->dateFormatter->format("dd-MM-yyyy", time()) . '                        ' .
            'Page: ' . $this->PageNo() . '/{nb}' . '                        ' .
            'Report Code: cashFlow1', 0, 0, 'C');
    }

    function myheader($periode_date, $report_id)
    {
        //Header

        $this->y0 = $this->GetY();
        $this->Cell(0, 5, '', 'T', 0, 'C');
        $this->Image('shareimages/company/logoAlt1.jpg', 15, 12, 30);
        $this->SetY($this->y0);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 5, '', 'LR');
        $this->Ln();
        $this->Cell(30, 5, '', 'L');
        $this->Cell(0, 5, 'CASH FLOW (STANDARD)', 'R', 0, 'C');
        $this->Ln();
        $this->Cell(0, 5, '', 'LBR');
        $this->Ln(7);

        $this->SetFillColor(230, 230, 230);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, sUser::getMyGroupName(), 0, 0, 'C', true);
        $this->Ln(12);


        $w = [130, 20];
        $this->SetFont('Arial', 'B', 8);
        $this->Cell($w[0], 5, 'DESCRIPTION', 'B');
        $this->Cell($w[1], 5, 'BALANCE', 'B', 0, 'R');
        $this->Ln(6);
    }

    function report($periode_date, $report_id)
    {
        $this->myheader($periode_date, $report_id);

        $w = [120, 20];
        $_s = 5;


        //#1. BEGINNING BALANCE
        $_subtotal1 = 0;
        $criteria1 = new CDbCriteria;
        $criteria1->with = ['cashbank'];

        $criteria1->order = 'account_no';

        $models1 = tAccount::model()->findAll($criteria1);

        $this->SetFont('Arial', 'B', 8);
        $this->Cell($w[0], 4, 'BEGINNING BALANCE');
        $this->Ln();

        foreach ($models1 as $model1) {
            $this->SetFont('Arial', '', 8);
            $this->Cell($_s, 4, '');
            $this->Cell($w[0], 4, $model1->account_concat);

            $_model1 = $model1->balancesheet(['condition' => 'yearmonth_periode =' . $periode_date]);
            if (isset($_model1->end_balance)) {
                $_balance1 = peterFunc::indoFormat($_model1->beginning_balance);
                $_subtotal1 = $_subtotal1 + $_model1->beginning_balance;
            } else
                $_balance1 = 0;

            $this->Cell($w[1] + 5, 4, $_balance1, 0, 0, 'R');
            $this->Ln();
        }

        $this->SetFont('Arial', 'B', 8);
        $this->Cell($_s, 4, '');
        $this->Cell($w[0], 4, 'TOTAL Beginning Balance CASH and BANK');
        $this->Cell($w[1] + 5, 4, peterFunc::indoFormat($_subtotal1), 'T', 0, 'R');
        $this->Ln(8);
        //#1. END BEGINNING BALANCE
        //#2. END BALANCE
        $_subtotal2 = 0;
        $criteria2 = new CDbCriteria;
        $criteria2->with = ['cashbank', 'entity'];

        $criteria2->order = 'account_no';

        $models2 = tAccount::model()->findAll($criteria2);

        $this->SetFont('Arial', 'B', 8);
        $this->Cell($w[0], 4, 'END BALANCE');
        $this->Ln();

        foreach ($models2 as $model2) {
            $this->SetFont('Arial', '', 8);
            $this->Cell($_s, 4, '');
            $this->Cell($w[0], 4, $model2->account_concat);

            $_model2 = $model2->balancesheet(['condition' => 'yearmonth_periode =' . $periode_date]);
            if (isset($_model2->end_balance)) {
                $_balance2 = peterFunc::indoFormat($_model2->end_balance);
                $_subtotal2 = $_subtotal2 + $_model2->end_balance;
            } else
                $_balance2 = 0;

            $this->Cell($w[1] + 5, 4, $_balance2, 0, 0, 'R');
            $this->Ln();
        }

        $this->SetFont('Arial', 'B', 8);
        $this->Cell($_s, 4, '');
        $this->Cell($w[0], 4, 'TOTAL End Balance CASH and BANK');
        $this->Cell($w[1] + 5, 4, peterFunc::indoFormat($_subtotal2), 'T', 0, 'R');
        $this->Ln(8);
        //#2. END END-BALANCE

        $this->Cell($_s + 5 + array_sum($w), 4, '', 'T', 'B');
        $this->Ln();

        //#3. PENERIMAAN KAS
        $_subtotal3 = 0;
        $rawData3 = Yii::app()->db->createCommand('
			select dd.account_no_id, aa.account_name, aaa.account_name as acc_parent, sum(dd.credit) as xdebit, sum(dd.debit) as xcredit  
			from t_journal_detail dd
			inner join t_journal tt on tt.id = dd.parent_id
			inner join t_account aa on aa.id = dd.account_no_id 
			inner join t_account aaa on aaa.id = aa.parent_id 
			where tt.yearmonth_periode = ' . $periode_date . ' 
			and dd.account_no_id NOT IN (' . tAccount::getCashbankListComp() . ') 
			and tt.id IN 
				(select t.id from t_journal t
				inner join t_journal_detail d on t.id = d.parent_id
				where t.yearmonth_periode = ' . $periode_date . ' and d.account_no_id IN (' . tAccount::getCashbankListComp() . ')
				group by t.id)

			group by aa.account_name
			having sum(dd.credit) <> 0
			order by aaa.account_no, aa.account_no

		  ')->queryAll();

        $dataProvider3 = new CArrayDataProvider($rawData3, [
            'id' => 'user',
            'pagination' => false,
        ]);

        $this->SetFont('Arial', 'B', 8);
        $this->Cell($w[0], 4, 'PENERIMAAN KAS');
        $this->Ln();

        $accparent3 = null;

        foreach ($dataProvider3->getData() as $mod3) {

            if ($mod3['acc_parent'] != $accparent3) {
                $this->SetFont('Arial', 'B', 8);
                $this->Cell($_s, 4, '');
                $this->Cell($w[0], 4, '  ' . $mod3['acc_parent'], 0, 0, 'L');
                $this->Ln();
            }

            $this->SetFont('Arial', '', 8);
            $this->Cell($_s + 5, 4, '');
            $this->Cell($w[0], 4, $mod3['account_name']);

            $_balance3 = peterFunc::indoFormat((int)$mod3['xdebit']);
            $_subtotal3 = $_subtotal3 + (int)$mod3['xdebit'];

            $this->Cell($w[1], 4, $_balance3, 0, 0, 'R');
            $this->Ln();

            $accparent3 = $mod3['acc_parent'];
        }

        $this->SetFont('Arial', 'B', 8);
        $this->Cell($_s, 4, '');
        $this->Cell($w[0] + 5, 4, 'TOTAL PENERIMAAN KAS');
        $this->Cell($w[1], 4, peterFunc::indoFormat($_subtotal3), 'T', 0, 'R');
        $this->Ln(8);
        //#3. END PENERIMAAN KAS
        //#4. PENGELUARAN KAS
        $_subtotal4 = 0;
        $rawData4 = Yii::app()->db->createCommand('
			select dd.account_no_id, aa.account_name, aaa.account_name as acc_parent, sum(dd.credit) as xdebit, sum(dd.debit) as xcredit  
			from t_journal_detail dd
			inner join t_journal tt on tt.id = dd.parent_id
			inner join t_account aa on aa.id = dd.account_no_id 
			inner join t_account aaa on aaa.id = aa.parent_id 
			where tt.yearmonth_periode = ' . $periode_date . ' 
			and dd.account_no_id NOT IN (' . tAccount::getCashbankListComp() . ') 
			and tt.id IN 
				(select t.id from t_journal t
				inner join t_journal_detail d on t.id = d.parent_id
				where t.yearmonth_periode = ' . $periode_date . ' and d.account_no_id IN (' . tAccount::getCashbankListComp() . ')
				group by t.id)

			group by aa.account_name
			having sum(dd.debit) <> 0
			order by aaa.account_no, aa.account_no

		  ')->queryAll();

        $dataProvider4 = new CArrayDataProvider($rawData4, [
            'id' => 'user',
            'pagination' => false,
        ]);

        $this->SetFont('Arial', 'B', 8);
        $this->Cell($w[0], 4, 'PENGELUARAN KAS');
        $this->Ln();

        $accparent4 = null;

        foreach ($dataProvider4->getData() as $mod4) {
            if ($mod4['acc_parent'] != $accparent4) {
                $this->SetFont('Arial', 'B', 8);
                $this->Cell($_s, 4, '');
                $this->Cell($w[0], 4, '  ' . $mod4['acc_parent'], 0, 0, 'L');
                $this->Ln();
            }

            $this->SetFont('Arial', '', 8);
            $this->Cell($_s + 5, 4, '');
            $this->Cell($w[0], 4, $mod4['account_name']);

            $_balance4 = peterFunc::indoFormat((int)$mod4['xcredit']);
            $_subtotal4 = $_subtotal4 + (int)$mod4['xcredit'];

            $this->Cell($w[1], 4, $_balance4, 0, 0, 'R');
            $this->Ln();

            $accparent4 = $mod4['acc_parent'];
        }

        $this->SetFont('Arial', 'B', 8);
        $this->Cell($_s, 4, '');
        $this->Cell($w[0] + 5, 4, 'TOTAL PENGELUARAN KAS');
        $this->Cell($w[1], 4, peterFunc::indoFormat($_subtotal4), 'T', 0, 'R');
        $this->Ln(8);


        $this->Cell($_s + 5 + array_sum($w), 4, '', 'T', 'B');
        $this->Ln();

        $this->SetFont('Arial', 'B', 8);
        $this->Cell($w[0], 4, 'Calculation');
        $this->Ln();

        $this->Cell($_s, 4, '');
        $this->Cell($w[0] + 5, 4, 'Beginning + In - Out');
        $this->Cell($w[1], 4, peterFunc::indoFormat($_subtotal1 + $_subtotal3 - $_subtotal4), 'T', 0, 'R');
        $this->Ln();

        $this->Cell($_s + 5 + array_sum($w), 4, '', 'B', 'B');
        $this->Ln(8);
        //#4. PENGELUARAN KAS
    }

}

?>