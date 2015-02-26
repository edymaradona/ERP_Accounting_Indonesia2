<?php

class journalVoucherList2 extends fpdf
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
            'Report Code: journalVoucherList2', 0, 0, 'C');
    }

    //Page header
    function myHeader($models, $begindate)
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

        $this->Cell(0, 0, '', 'B');
        $this->Ln();
        $this->SetFont('Arial', '', 10);
        $this->Cell(25, 6, 'Account No', 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 6, ': ' . $models[0]->account->account_concat, 'R');
        $this->Ln();
        $this->SetFont('Arial', '', 10);
        $this->Cell(25, 6, 'Periode: ', 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 6, ': ' . $begindate, 'R');
        //$this->Cell(0, 6, ': ', 'R');
        $this->Ln();
        $this->Cell(0, 0, '', 'B');

        $this->Ln(5);

        $w = [7, 18, 40, 23, 23, 64, 15];
        //Header
        $this->SetFont('Arial', '', 8);
        $this->Cell($w[0], 8, 'No.', 1, 0, 'R');
        $this->Cell($w[1], 8, 'Date', 1);
        $this->Cell($w[2], 8, 'No. Ref', 1);
        $this->Cell($w[3], 8, 'Debit', 1, 0, 'C');
        $this->Cell($w[4], 8, 'Credit', 1, 0, 'C');
        $this->Cell($w[5], 8, 'User Remark', 1);
        $this->Cell($w[6], 8, 'Status', 1);
        $this->Ln();

        $this->Cell(array_sum($w), 1, '', 'TB');
        $this->Ln(1);
    }

    function report($models, $begindate, $acc_id = null)
    {
        $this->myHeader($models, $begindate);

        $_count = 0;
        $_total = 0;
        $_counter = 1;
        $_countert = 1;


        $_mdate = "";
        $_tdebet = 0;
        $_tcredit = 0;

        //Color and font restoration
        $this->SetFillColor(224, 224, 224);
        $this->SetTextColor(0);
        $this->SetFont('');
        //Data
        $fill = false;

        $w = [7, 18, 40, 23, 23, 64, 15];

        $_mod = $models[0]->account->balancesheet(['condition' => 'yearmonth_periode =' . $begindate]);

        $this->SetFont('Arial', 'B', 8);
        $this->Cell($w[0], 8, '', 'LB', 0, 'R', $fill);
        $this->Cell($w[1], 8, 'BEGINNING BALANCE', 'LB');
        $this->Cell($w[2], 8, '', 'B', 0, 'L', $fill);
        $this->Cell($w[3], 8, ($models[0]->account->sideValue == 1) ? $_mod->beginning_balancee : 0, 'LB', 0, 'R', $fill);
        $this->Cell($w[4], 8, ($models[0]->account->sideValue == 2) ? $_mod->beginning_balancee : 0, 'LB', 0, 'R', $fill);
        $this->Cell($w[5], 8, '', 'LB', 0, 'L', $fill);
        $this->Cell($w[6], 8, '', 'LBR', 0, 'L', $fill);
        $this->Ln();

        foreach ($models as $mod) {
            $this->SetFont('Arial', '', 8);
            $this->Cell($w[0], 6, peterFunc::indoFormat($_countert), 'L', 0, 'R', $fill);
            if ($_mdate != $mod->journal->input_date) {
                $this->Cell($w[1], 6, $mod->journal->input_date, 'LT', 0, 'L', $fill);
            } else
                $this->Cell($w[1], 6, '', 'L');

            $_mdate = $mod->journal->input_date;

            $this->Cell($w[2], 6, $mod->journal->system_ref, 'L', 0, 'L', $fill);
            $this->Cell($w[3], 6, $mod->debitt, 'L', 0, 'R', $fill);
            $this->Cell($w[4], 6, $mod->creditt, 'L', 0, 'R', $fill);
            $this->Cell($w[5], 6, (strlen($mod->journal->remark) >= 42) ? substr($mod->journal->remark, 0, 40) . " ... " : $mod->journal->remark, 'L', 0, 'L', $fill);
            $this->Cell($w[6], 6, $mod->journal->status->name, 'LR', 0, 'L', $fill);

            $this->Ln();

            $_tdebet = $_tdebet + $mod->debit;
            $_tcredit = $_tcredit + $mod->credit;

            $_counter++;
            $_countert++;

            if ($_counter == 34) {
                $this->Cell(array_sum($w), 0, '', 'T');
                $this->AddPage();

                $this->myHeader($models, $begindate);

                $_counter = 1;
            }
            $fill = !$fill;
        }

        $_tdebetF = peterFunc::indoFormat($_tdebet);
        $_tcreditF = peterFunc::indoFormat($_tcredit);

        //Closure line
        $this->Cell(array_sum($w), 0, '', 'T');
        $this->Ln(1);

        $this->SetFont('Arial', 'B', 8);
        $this->Cell($w[0], 8, '', 'TLB');
        $this->Cell($w[1], 8, 'T O T A L', 'TLB', 0, 'L');
        $this->Cell($w[2], 8, '', 'TB');
        $this->Cell($w[3], 8, $_tdebetF, 'TLB', 0, 'R');
        $this->Cell($w[4], 8, $_tcreditF, 'TLB', 0, 'R');
        $this->Cell($w[5], 8, '', 'TLB');
        $this->Cell($w[6], 8, '', 'TLBR', 0, 'R');
        $this->Ln();

        $calc = $_mod->beginning_balance + $_tdebet - $_tcredit;
        $calcF = peterFunc::indoFormat($calc);

        //$this->Cell($w[6], 8, ($test == $_mod->end_balance) ? "":"MANUAL CALCULATION <> END BALANCE. CONTACT PETER", 0, 0, 'L');

        $fill = false;
        $this->SetFont('Arial', 'B', 8);
        $this->Cell($w[0], 8, '', 'LB', 0, 'R', $fill);
        $this->Cell($w[1], 8, 'END BALANCE', 'LB');
        $this->Cell($w[2], 8, '', 'B', 0, 'L', $fill);
        $this->Cell($w[3], 8, ($models[0]->account->sideValue == 1) ? $calcF : 0, 'LB', 0, 'R');
        $this->Cell($w[4], 8, ($models[0]->account->sideValue == 2) ? $calcF : 0, 'LB', 0, 'R');
        $this->Cell($w[5], 8, '', 'LB', 0, 'L', $fill);
        $this->Cell($w[6], 8, '', 'LBR', 0, 'L', $fill);
        $this->Ln();
    }

}

?>