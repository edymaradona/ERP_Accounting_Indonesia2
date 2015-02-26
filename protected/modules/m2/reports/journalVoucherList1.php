<?php

class journalVoucherList1 extends fpdf
{

    //Page footer
    function Footer()
    {
        //Position at 1.5 cm from bottom
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        //Page number
        $this->Cell(0, 10, 'Print Date: ' . Yii::app()->dateFormatter->format('dd-MM-yyyy', time()) . '                        ' .
            'Page: ' . $this->PageNo() . '/{nb}' . '                        ' .
            'Report Code: journalVoucherList1', 0, 0, 'C');
    }

    //Page header
    function myHeader($models, $begindate, $acc_id)
    {
        $this->y0 = $this->GetY();
        $this->Cell(0, 5, '', 'T', 0, 'C');
        $this->Image('shareimages/company/logoAlt1.jpg', 15, 12, 30);
        $this->SetY($this->y0);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 5, '', 'LR');
        $this->Ln();
        $this->Cell(30, 5, '', 'L');
        $this->Cell(0, 5, 'JOURNAL VOUCHER LIST', 'R', 0, 'C');
        $this->Ln();
        $this->Cell(0, 5, '', 'LBR');
        $this->Ln(7);

        $this->SetFillColor(230, 230, 230);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, sUser::getMyGroupName(), 0, 0, 'C', true);
        $this->Ln(12);

        $this->Cell(190, 0, '', 'B');
        $this->Ln();
        $this->SetFont('Arial', '', 10);
        $this->Cell(25, 6, 'Account No', 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 6, ': ' . tAccount::model()->findByPk((int)$acc_id)->account_concat, 'R');
        $this->Ln();
        $this->SetFont('Arial', '', 10);
        $this->Cell(25, 6, 'Periode: ', 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 6, ': ' . $begindate, 'R');
        $this->Ln();
        $this->Cell(190, 0, '', 'B');

        $this->Ln(8);
    }

    function report($models, $begindate, $acc_id)
    {
        $this->myHeader($models, $begindate, $acc_id);

        //if ($post_id != 0)
        //    $criteria->compare('state_id', $post_id);


        foreach ($models as $model) {
            //Header
            $this->SetFont('Arial', '', 10);
            $this->Cell(25, 4, 'Voucher No.');
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(50, 4, ': ' . $model->journal->system_ref);
            $this->Ln();
            $this->SetFont('Arial', '', 10);
            $this->Cell(25, 4, 'Date');
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(60, 4, ': ' . $model->journal->input_date);
            //$this->Ln();
            //$this->SetFont('Arial', '', 10);
            //$this->Cell(25, 4, 'Periode');
            //$this->SetFont('Arial', 'B', 10);
            //$this->Cell(60, 4, ': ' . $model->journal->yearmonth_periode);
            $this->Ln(4);
            $this->SetFont('Arial', '', 10);
            $this->Cell(25, 4, 'Description');
            $this->Cell(60, 4, ': ' . $model->journal->remark);
            $this->Ln(6);

            $w = [70, 25, 25, 70];
            //Header
            $this->SetFont('Arial', 'B', 10);
            $this->Cell($w[0], 9, 'Account Name', 'LTBR', 0, 'C');
            $this->Cell($w[1], 9, 'Debit', 'TBR', 0, 'C');
            $this->Cell($w[2], 9, 'Credit', 'TBR', 0, 'C');
            $this->Cell($w[3], 9, 'Remark', 'TBR', 0, 'C');
            $this->Ln();

            $modeld = tJournalDetail::model()->findAll('parent_id = ' . $model->parent_id);
            foreach ($modeld as $mod) {
                $this->SetFont('Arial', '', 8);
                $this->Cell($w[0], 4, peterFunc::shorten_string($mod->account->account_concat, 5), 'LR');
                $this->Cell($w[1], 4, peterFunc::indoFormat($mod->debit), 'LR', 0, 'R');
                $this->Cell($w[2], 4, peterFunc::indoFormat($mod->credit), 'R', 0, 'R');
                $this->Cell($w[3], 4, peterFunc::shorten_string($mod->user_remark, 6), 'R');
                $this->Ln();
            }

            $this->SetFont('Arial', 'B', 10);
            $this->Cell($w[0], 6, 'TOTAL', 'TLR', 0, 'R');
            $this->Cell($w[1], 6, peterFunc::indoFormat($model->journal->journalSum), 'TLR', 0, 'R');
            $this->Cell($w[2], 6, peterFunc::indoFormat($model->journal->journalSum), 'TR', 0, 'R');
            $this->Cell($w[3], 6, '', 'TR');
            $this->Ln();
            $this->Cell(array_sum($w), 6, '', 'T');
            $this->Ln(8);

            if ($this->GetY() >= 215) {
                $this->AddPage();
                $this->myHeader($models, $begindate, $acc_id);
            }
        }
    }

}

?>