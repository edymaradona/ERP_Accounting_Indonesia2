<?php

class attendanceDetail extends fpdf
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

    function report($models)
    {
        $this->y0 = $this->GetY();
        $this->Cell(0, 5, '', 'T', 0, 'C');
        $this->Image('shareimages/company/logoAlt1.jpg', 10, 11, 23);
        $this->SetY($this->y0);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 2, '', 'LR');
        $this->Ln();
        $this->Cell(30, 5, '', 'L');
        $this->Cell(0, 5, 'LAPORAN DETIL KEHADIRAN KARYAWAN', 'R', 0, 'C');
        $this->Ln();
        $this->Cell(0, 2, '', 'LBR');
        $this->Ln(1);

        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 2, '', 'B', 0, 'C');
        $this->Ln();
        $this->Cell(35, 8, 'Nama', 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(80, 8, ':  ' . $models[0]->person->employee_name);
        $this->SetFont('Arial', '', 10);
        $this->Cell(50, 8, 'NRK');
        $this->Cell(60, 8, '');
        $this->Cell(0, 8, '', 'R');
        $this->Ln();
        $this->Cell(35, 6, 'Departemen', 'L');
        $this->Cell(80, 6, ':  ' . $models[0]->person->mDepartment());
        $this->Cell(40, 6, 'Tanggal Bergabung');
        $this->Cell(40, 6, ':  ' . $models[0]->person->companyfirst->start_date);
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(35, 6, 'Jabatan', 'L');
        $this->Cell(80, 6, ':  ' . $models[0]->person->mJobTitle());
        $this->Cell(0, 6, '', 'R');
        $this->Ln(6);
        $this->Cell(0, 6, '', 'T');
        $this->Ln(1);

        $startmonth = '01-' . date("m", strtotime($models[0]->cdate)) . '-' . date("Y", strtotime($models[0]->cdate));
        $endmonth = date("d-m-Y", strtotime(($startmonth . "+1 month") . "-1 day"));

        $this->Cell(0, 6, 'PERIODE: ' . $startmonth . " s/d " . $endmonth, 0, 0, 'C');
        $this->Ln();

        $this->SetFillColor(230, 230, 230);

        $w = [20, 34, 9, 9, 9, 9, 9, 7, 7, 7, 10, 10, 8, 8, 34];

        $this->Cell(0, 1, '', 'B');
        $this->Ln();
        $this->SetFont('Arial', '', 8);
        $this->Cell($w[0], 5, 'Tanggal', 'LTR', 0, 'C', true);
        $this->Cell($w[1], 5, 'Jadwal', 'LTR', 0, 'C', true);
        $this->Cell($w[2] + $w[3], 5, 'Kehadiran', 1, 0, 'C', true);
        $this->Cell($w[4] + $w[5], 5, 'Lembur', 1, 0, 'C', true);
        $this->Cell($w[6], 5, 'CUTI', 'LTR', 0, 'C', true);
        $this->Cell($w[7], 5, 'A', 'LTR', 0, 'C', true);
        $this->Cell($w[8], 5, 'I', 'LTR', 0, 'C', true);
        $this->Cell($w[9], 5, 'S', 'LTR', 0, 'C', true);
        $this->Cell($w[10], 5, 'TL', 'LTR', 0, 'C', true);
        $this->Cell($w[11], 5, 'PC', 'LTR', 0, 'C', true);
        $this->Cell($w[12], 5, 'TAD', 'LTR', 0, 'C', true);
        $this->Cell($w[13], 5, 'TAP', 'LTR', 0, 'C', true);
        $this->Cell($w[14], 5, 'Ket', 'LTR', 0, 'C', true);
        $this->Ln();
        $this->Cell($w[0], 5, '', 'LBR', 0, 'C', true);
        $this->Cell($w[1], 5, '', 'LBR', 0, 'C', true);
        $this->Cell($w[2], 5, 'In', 'LBR', 0, 'C', true);
        $this->Cell($w[3], 5, 'Out', 'LBR', 0, 'C', true);
        $this->Cell($w[4], 5, 'In', 'LBR', 0, 'C', true);
        $this->Cell($w[5], 5, 'Out', 'LBR', 0, 'C', true);
        $this->Cell($w[6], 5, '', 'LBR', 0, 'C', true);
        $this->Cell($w[7], 5, '', 'LBR', 0, 'C', true);
        $this->Cell($w[8], 5, '', 'LBR', 0, 'C', true);
        $this->Cell($w[9], 5, '', 'LBR', 0, 'C', true);
        $this->Cell($w[10], 5, '', 'LBR', 0, 'C', true);
        $this->Cell($w[11], 5, '', 'LBR', 0, 'C', true);
        $this->Cell($w[12], 5, '', 'LBR', 0, 'C', true);
        $this->Cell($w[13], 5, '', 'LBR', 0, 'C', true);
        $this->Cell($w[14], 5, '', 'LBR', 0, 'C', true);
        $this->Ln();

        $_counter = $_countert = 1;

        $fill = false;

        $_cuti = $_alpha = $ijin = $sakit = $_latein = $_earlyout = $_actualin = $_actualout = $_lateinp = $_lateoutp = 0;

        $_overtimein = "00:00";
        $_overtimeout = "00:00";
        $_countlatein = "00:00";
        $_countlateout = "00:00";

        $totalworkhour = "00:00:00";

        foreach ($models as $model) {
            $currentworkhour = peterFunc::get_time_difference($model->actualIn, peterFunc::subTime($model->actualOut, "1:00"));
            $totalworkhour = peterFunc::sum_the_time($totalworkhour, $currentworkhour);

            $this->SetFont('Arial', '', 8);
            $this->Cell($w[0], 6, $model->cdate, 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, $model->realpattern->code, 'LR', 0, 'L', $fill);

            if ($model->lateInStatus == "Late In") {
                $this->SetFont('Arial', 'U', 8);
                $this->Cell($w[2], 6, $model->actualIn, 'LR', 0, 0, $fill);
                $this->SetFont('Arial', '', 8);
            } else {
                $this->Cell($w[2], 6, $model->actualIn, 'LR', 0, 0, $fill);
            }

            if ($model->earlyOutStatus == "Early Out") {
                $this->SetFont('Arial', 'U', 8);
                $this->Cell($w[3], 6, $model->actualOut, 'LR', 0, 0, $fill);
                $this->SetFont('Arial', '', 8);
            } else {
                $this->Cell($w[3], 6, $model->actualOut, 'LR', 0, 0, $fill);
            }

            $this->Cell($w[5], 6, $model->overtimeIn, 'LR', 0, 'L', $fill); //overtime In or inOut
            ($model->overtimeIn != null) ? $_overtimein = peterFunc::addTime($_overtimein, $model->overtimeIn) : $_overtimein;

            $this->Cell($w[5], 6, $model->overtimeOut, 'LR', 0, 'L', $fill); //overtime Out or inOut
            ($model->overtimeOut != null) ? $_overtimeout = peterFunc::addTime($_overtimeout, $model->overtimeOut) : $_overtimeout;


            //$this->Cell($w[6], 6, ($model->daystatus3_id == 200) ? "X" : "", 'LR', 0, 'C', $fill); //CUTI
            //$_cuti = ($model->daystatus3_id == 200) ? $_cuti + 1 : $_cuti;
            //$this->Cell($w[7], 6, ($model->daystatus3_id == 300) ? "X" : "", 'LR', 0, 'C', $fill); //ALPHA
            //$_alpha = ($model->daystatus3_id == 300) ? $_alpha + 1 : $_alpha;

            if ($model->getSyncLeave() != null) {
                $this->Cell($w[6], 6, "X", 'LR', 0, 'C', $fill); //CUTI
                $_cuti++;
            } else
                $this->Cell($w[6], 6, "", 'LR', 0, 'C', $fill); //CUTI

            if ($model->actualIn == "??:??" and $model->actualOut == "??:??" AND
                $model->getSyncLeave() == null AND $model->getSyncPermission() == null AND strtotime('yesterday') > strtotime($model->cdate)
            ) {
                $this->Cell($w[7], 6, "X", 'LR', 0, 'C', $fill); //ALPHA
                $_alpha++;
            } else
                $this->Cell($w[7], 6, "", 'LR', 0, 'C', $fill); //ALPHA


            if (isset($model->syncPermission) && $model->getSyncPermission()->permission_type_id != 10) {
                $this->Cell($w[8], 6, "X", 'LR', 0, 'C', $fill);
                $ijin++;
            } else
                $this->Cell($w[8], 6, "", 'LR', 0, 'C', $fill);

            if ($model->getSyncPermission() != null && $model->getSyncPermission()->permission_type_id == 10) {
                $this->Cell($w[9], 6, "X", 'LR', 0, 'C', $fill);
                $sakit++;
            } else
                $this->Cell($w[9], 6, "", 'LR', 0, 'C', $fill);

            if ($model->getSyncPermission() != null && $model->getSyncPermission()->permission_type_id == 11 && $model->getSyncPermission()->approved_id == 2) {
                $this->SetFont('Arial', 'BU', 8);
                $_lateinp++;
            }

            $this->Cell($w[10], 6, $model->diffIn, 'LR', 0, 'C', $fill);
            $_latein = ($model->diffIn != null) ? $_latein + 1 : $_latein;
            ($model->diffIn != null) ? $_countlatein = peterFunc::addTime($_countlatein, $model->diffIn) : $_countlatein;

            if ($model->getSyncPermission() != null && $model->getSyncPermission()->permission_type_id == 12 && $model->getSyncPermission()->approved_id == 2) {
                $this->SetFont('Arial', 'BU', 8);
                $_lateoutp++;
            }
            $this->Cell($w[11], 6, $model->diffOut, 'LR', 0, 'C', $fill);
            $_earlyout = ($model->diffOut != null) ? $_earlyout + 1 : $_earlyout;
            ($model->diffOut != null) ? $_countlateout = peterFunc::addTime($_countlateout, $model->diffOut) : $_countlateout;

            $this->Cell($w[12], 6, ($model->actualIn == "??:??" AND $model->actualOut != "??:??") ? "X" : "", 'LR', 0, 'C', $fill);
            $_actualin = ($model->actualIn == "??:??" AND $model->actualOut != "??:??") ? $_actualin + 1 : $_actualin;

            $this->SetFont('Arial', '', 8);

            $this->Cell($w[13], 6, ($model->actualOut == "??:??" AND $model->actualIn != "??:??") ? "X" : "", 'LR', 0, 'C', $fill);
            $_actualout = ($model->actualOut == "??:??" AND $model->actualIn != "??:??") ? $_actualout + 1 : $_actualout;
            if (isset($model->permission1)) {
                $this->Cell($w[14], 6, $model->permission1->name . ". " . $model->remark, 'LR', 0, 'L', $fill);
            } elseif (isset($model->syncPermission)) {
                $this->Cell($w[14], 6, "#P# " . $model->syncPermission->permission_reason, 'LR', 0, 'L', $fill);
            } elseif (isset($model->syncLeave)) {
                $this->Cell($w[14], 6, "#L# " . $model->syncLeave->leave_reason, 'LR', 0, 'L', $fill);
            } elseif (isset($model->syncLearning)) {
                $this->Cell($w[14], 6, "#T# " . $model->syncLearning->getparent->getparent->learning_title, 'LR', 0, 'L', $fill);
            } else
                $this->Cell($w[14], 6, $model->remark, 'LR', 0, 'L', $fill);

            $this->Ln();

            $fill = !$fill;
            $_counter++;
            $_countert++;

            if ($_counter == 34) {
                $this->Cell(array_sum($w), 0, '', 'T');
                $this->AddPage();

                $this->myheader();

                $_counter = 1;
            }
        }
        $this->Cell(array_sum($w), 2, '', 'T', 0, 0);
        $this->Ln();
        $this->Cell($w[0], 5, '', 1, 0, 'C', true);
        $this->Cell($w[1], 5, 'TOTAL', 1, 0, 'C', true);
        $this->Cell($w[2] + $w[3], 5, '', 1, 0, 'C', true);
        $this->Cell($w[4], 5, '', 1, 0, 'C', true);
        $this->Cell($w[5], 5, '', 1, 0, 'C', true);
        $this->Cell($w[6], 5, $_cuti, 1, 0, 'C', true);
        $this->Cell($w[7], 5, $_alpha, 1, 0, 'C', true);
        $this->Cell($w[8], 5, $ijin, 1, 0, 'C', true);
        $this->Cell($w[9], 5, $sakit, 1, 0, 'C', true);
        $this->Cell($w[10], 5, $_latein, 1, 0, 'C', true);
        $this->Cell($w[11], 5, $_earlyout, 1, 0, 'C', true);
        $this->Cell($w[12], 5, $_actualin, 1, 0, 'C', true);
        $this->Cell($w[13], 5, $_actualout, 1, 0, 'C', true);
        $this->Cell($w[14], 5, '', 1, 0, 'C', true);
        $this->Ln();
        $this->Cell($w[0], 5, '', 1, 0, 'C', true);
        $this->Cell($w[1], 5, 'TOTAL HOURS', 1, 0, 'C', true);
        $this->Cell($w[2] + $w[3], 5, $totalworkhour, 1, 0, 'C', true);
        $this->Cell($w[4], 5, $_overtimein, 1, 0, 'C', true);
        $this->Cell($w[5], 5, $_overtimeout, 1, 0, 'C', true);
        $this->Cell($w[6], 5, '', 1, 0, 'C', true);
        $this->Cell($w[7], 5, '', 1, 0, 'C', true);
        $this->Cell($w[8], 5, '', 1, 0, 'C', true);
        $this->Cell($w[9], 5, '', 1, 0, 'C', true);
        $this->Cell($w[10], 5, $_countlatein, 1, 0, 'C', true);
        $this->Cell($w[11], 5, $_countlateout, 1, 0, 'C', true);
        $this->Cell($w[12], 5, '', 1, 0, 'C', true);
        $this->Cell($w[13], 5, '', 1, 0, 'C', true);
        $this->Cell($w[14], 5, '', 1, 0, 'C', true);
        /*        $this->Ln(7);
          $this->SetFont('Arial', 'BU', 8);
          $this->Cell($w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7]+$w[8]+$w[9], 5, 'Terlambat/Pulang Cepat dengan form ijin', 1, 0, 'R', true);
          $this->Cell($w[10], 5, $_lateinp, 1, 0, 'C', true);
          $this->Cell($w[11], 5, $_lateoutp, 1, 0, 'C', true);
          $this->SetFont('Arial', '', 8);
          $this->Cell($w[12], 5, '', 1, 0, 'C', true);
          $this->Cell($w[13], 5, '', 1, 0, 'C', true);
          $this->Cell($w[14], 5, '', 1, 0, 'C', true);
         */
        $this->Ln(8);

        $this->Cell(40, 4, 'A = ALPHA');
        $this->Cell(50, 4, 'TL = TERLAMBAT');
        $this->Cell(50, 4, 'TAD = TIDAK ABSEN DATANG');
        $this->Cell(40, 4, 'S = SAKIT');
        $this->Ln();
        $this->Cell(40, 4, 'PC = PULANG CEPAT');
        $this->Cell(50, 4, 'TAP = TIDAK ABSEN PULANG');
        $this->Cell(50, 4, 'I = IJIN');
        $this->Ln();
    }

}

