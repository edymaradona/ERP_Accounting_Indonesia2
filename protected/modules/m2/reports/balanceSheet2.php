<?php

class balanceSheet2 extends fpdf
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
            'Report Code: balanceSheet2', 0, 0, 'C');
    }

    function myheader($periode_date, $report_id)
    {
        $this->y0 = $this->GetY();
        $this->Cell(0, 5, '', 'T', 0, 'C');
        $this->Image('shareimages/company/logoAlt1.jpg', 15, 12, 30);
        $this->SetY($this->y0);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 5, '', 'LR');
        $this->Ln();
        $this->Cell(30, 5, '', 'L');
        $this->Cell(0, 5, 'BALANCE SHEET (STANDARD)', 'R', 0, 'C');
        $this->Ln();
        $this->Cell(0, 5, '', 'LBR');
        $this->Ln(7);


        $w = [110, 20];
        $this->SetFont('Arial', 'B', 8);
        $this->Cell($w[0], 5, 'DESCRIPTION', 'B');
        $this->x0 = $this->GetX();
        $this->Cell($w[1], 5, 'CURRENT', 'B', 0, 'R');
        $this->Cell($w[1] + 20, 5, 'LAST', 'B', 0, 'R');
        $this->Ln(6);
    }

    function report($periode_date, $report_id)
    {
        $this->myheader($periode_date, $report_id);

        $w = [130, 20];

        $model1 = tAccountMain::model()->with('account_list')->findAll('type_id= 1');

        $_s = 3;
        //Reset
        $_total = 0;
        $_subtotal = 0;
        $_grandtotal = 0;
        $_grandtotalA = 0;
        $_grandtotalP = 0;

        $_totalLast = 0;
        $_subtotalLast = 0;
        $_grandtotalLast = 0;
        $_grandtotalALast = 0;
        $_grandtotalPLast = 0;


        //Print/Preview Report

        foreach ($model1 as $mmm) {

            if ($mmm->id == 2) { //pasiva
                $_s = $_s + 3;
                $this->SetFont('Arial', 'B', 8);
                $this->Cell($w[0], 4, $mmm->name);
                $this->Cell($w[1], 4, '');
                $this->Ln();
            }

            foreach ($mmm->account_list as $mm) {
                $model2 = tAccount::model()->findByPk((int)$mm->parent_id);

                $this->SetFont('Arial', 'B', 8);
                if ($mmm->id == 2)
                    $this->Cell(5, 4, '');
                $this->Cell($w[0], 4, $model2->account_concat);
                $this->SetX($this->x0);
                $this->Cell($w[1], 4, '');
                $this->Ln();

                foreach ($model2->childs as $model) {
                    $this->SetFont('Arial', 'B', 8);
                    $this->Cell($_s, 4, '');
                    $this->Cell($w[0], 4, $model->account_concat);
                    $this->SetX($this->x0);
                    $this->Cell($w[1], 4, '');
                    $this->Ln();

                    if ($model->childs) {
                        foreach ($model->childs as $mod) {
                            if ($mod->childs) {
                                $this->SetFont('Arial', 'B', 8);
                            } else
                                $this->SetFont('Arial', '', 8);

                            $this->Cell($_s + 3, 4, '');
                            $this->Cell($w[0], 4, $mod->account_concat);
                            $this->SetX($this->x0);
                            $_mod = $mod->balancesheet(['condition' => 'yearmonth_periode =' . $periode_date]);
                            $_periode_date_last = peterFunc::cBeginDateBefore($periode_date);
                            $_modLast = $mod->balancesheet(['condition' => 'yearmonth_periode =' . $_periode_date_last]);
                            if (isset($_mod->end_balance)) {
                                $_balance = peterFunc::indoFormat($_mod->end_balance);
                                $_mmodLast = isset($_modLast->end_balance) ? $_modLast->end_balance : 0;
                                $_balanceLast = peterFunc::indoFormat($_mmodLast);
                                $_subtotal = $_subtotal + $_mod->end_balance;
                                $_grandtotal = $_grandtotal + $_mod->end_balance;

                                $_subtotalLast = $_subtotalLast + $_mmodLast;
                                $_grandtotalLast = $_grandtotalLast + $_mmodLast;
                            } else {
                                $_balance = 0;
                                $_balanceLast = 0;
                            }

                            if ($mod->childs) {
                                $this->Cell($w[1], 4, '', 0, 0, 'R');
                            } else {
                                $this->Cell($w[1], 4, $_balance, 0, 0, 'R');
                                $this->Cell($w[1] + 20, 4, $_balanceLast, 0, 0, 'R');
                            }

                            $this->Ln();


                            if ($mod->childs) {
                                foreach ($mod->childs as $m) {
                                    if ($m->childs) {
                                        $this->SetFont('Arial', 'B', 8);
                                    } else
                                        $this->SetFont('Arial', '', 8);

                                    $this->Cell($_s + 10, 4, '');
                                    $this->Cell($w[0], 4, $m->account_concat);
                                    $this->SetX($this->x0);
                                    $_m = $m->balancesheet(['condition' => 'yearmonth_periode =' . $periode_date]);
                                    $_mLast = $m->balancesheet(['condition' => 'yearmonth_periode =' . $_periode_date_last]);
                                    if (isset($_m->end_balance)) {
                                        $_balance = peterFunc::indoFormat($_m->end_balance);
                                        $_mmLast = isset($_mLast->end_balance) ? $_mLast->end_balance : 0;
                                        $_balanceLast = peterFunc::indoFormat($_mmLast);
                                        $_total = $_total + $_m->end_balance;
                                        $_subtotal = $_subtotal + $_m->end_balance;
                                        $_grandtotal = $_grandtotal + $_m->end_balance;

                                        $_totalLast = $_totalLast + $_mmLast;
                                        $_subtotalLast = $_subtotalLast + $_mmLast;
                                        $_grandtotalLast = $_grandtotalLast + $_mmLast;
                                    } else {
                                        $_balance = 0;
                                        $_balanceLast = 0;
                                    }

                                    if ($m->childs) {
                                        $this->Cell($w[1], 4, '', 0, 0, 'R');
                                    } else {
                                        $this->Cell($w[1], 4, $_balance, 0, 0, 'R');
                                        $this->Cell($w[1] + 20, 4, $_balanceLast, 0, 0, 'R');
                                    }

                                    $this->Ln();

                                    if ($m->childs) {

                                        ////////////////LAST
                                        foreach ($m->childs as $n) {
                                            if ($n->childs) {
                                                $this->SetFont('Arial', 'B', 8);
                                            } else
                                                $this->SetFont('Arial', '', 8);

                                            $this->Cell($_s + 15, 4, '');
                                            $this->Cell($w[0], 4, $n->account_concat);
                                            $this->SetX($this->x0);
                                            $_n = $n->balancesheet(['condition' => 'yearmonth_periode =' . $periode_date]);
                                            $_nLast = $n->balancesheet(['condition' => 'yearmonth_periode =' . $_periode_date_last]);
                                            if (isset($_n->end_balance)) {
                                                $_balance = peterFunc::indoFormat($_n->end_balance);
                                                $_nnLast = isset($_nLast->end_balance) ? $_nLast->end_balance : 0;
                                                $_balanceLast = peterFunc::indoFormat($_nnLast);
                                                $_total = $_total + $_n->end_balance;
                                                $_subtotal = $_subtotal + $_n->end_balance;
                                                $_grandtotal = $_grandtotal + $_n->end_balance;

                                                $_totalLast = $_totalLast + $_nnLast;
                                                $_subtotalLast = $_subtotalLast + $_nnLast;
                                                $_grandtotalLast = $_grandtotalLast + $_nnLast;
                                            } else {
                                                $_balance = 0;
                                                $_balanceLast = 0;
                                            }

                                            if ($n->childs) {
                                                $this->Cell($w[1], 4, '', 0, 0, 'R');
                                            } else {
                                                $this->Cell($w[1], 4, $_balance, 0, 0, 'R');
                                                $this->Cell($w[1] + 20, 4, $_balanceLast, 0, 0, 'R');
                                            }

                                            $this->Ln();
                                        }
                                        ///LAST
                                    }
                                }
                            }

                            if ($mod->childs && $mod->childsCount >= 2) {
                                $this->SetFont('Arial', 'B', 8);
                                $this->Cell($_s + 3, 4, '');
                                $this->Cell($w[0], 4, 'TOTAL ' . $mod->account_name);
                                $this->SetX($this->x0);
                                $this->Cell($w[1], 4, peterFunc::indoFormat($_total), 'T', 0, 'R');
                                $this->Cell($w[1], 4, '', 0);
                                $this->Cell($w[1], 4, peterFunc::indoFormat($_totalLast), 'T', 0, 'R');
                                $this->Ln(5);
                            }

                            if ($mod->childs) {
                                $_total = 0;
                                $_totalLast = 0;
                            }

                            if ($this->GetY() >= 250) {
                                $this->AddPage();
                                $this->myheader($periode_date, $report_id);
                            }
                        }
                    }
                    $this->SetFont('Arial', 'B', 8);
                    $this->Cell($_s, 4, '');
                    $this->Cell($w[0], 4, 'TOTAL ' . $model->account_name);
                    $this->SetX($this->x0 + 20);
                    $this->Cell($w[1], 4, peterFunc::indoFormat($_subtotal), 'T', 0, 'R');
                    $this->Cell($w[1], 4, '', 0);
                    $this->Cell($w[1], 4, peterFunc::indoFormat($_subtotalLast), 'T', 0, 'R');
                    $this->Ln(5);

                    $_subtotal = 0;
                    $_subtotalLast = 0;

                    if ($this->GetY() >= 250) {
                        $this->AddPage();
                        $this->myheader($periode_date, $report_id);
                    }
                }

                $this->SetFillColor(224, 224, 224);
                $this->SetFont('Arial', 'B', 10);
                if ($mmm->id == 2)
                    $this->Cell(5, 6, '');
                $this->Cell($w[0], 6, 'TOTAL ' . $model2->account_name, 0, 0, 'L', true);
                $this->SetX($this->x0 + 20);
                $this->Cell($w[1], 6, peterFunc::indoFormat($_grandtotal), 0, 0, 'R', true);
                $this->Cell($w[1] + 20, 6, peterFunc::indoFormat($_grandtotalLast), 0, 0, 'R', true);
                $this->Cell($w[1], 6, '');
                $this->Ln(10);

                if ($mmm->id == 1) { //Aktiva
                    $_grandtotalA = $_grandtotal;
                    $_grandtotalALast = $_grandtotalLast;
                } else {
                    $_grandtotalP = $_grandtotalP + $_grandtotal;
                    $_grandtotalPLast = $_grandtotalPLast + $_grandtotalLast;
                }

                $_grandtotal = 0;
                $_grandtotalLast = 0;
            }

            if ($mmm->id == 2) { //Pasiva
                $_s = $_s + 3;
                $this->SetFont('Arial', 'B', 10);
                $this->Cell($w[0], 6, $mmm->name, 0, 0, 'L', true);
                $this->SetX($this->x0 + 20);
                $this->Cell($w[1], 6, peterFunc::indoFormat($_grandtotalP), 0, 0, 'R', true);
                $this->Cell($w[1] + 20, 6, peterFunc::indoFormat($_grandtotalPLast), 0, 0, 'R', true);
                $this->Ln(10);
            }
        }
    }

}

?>