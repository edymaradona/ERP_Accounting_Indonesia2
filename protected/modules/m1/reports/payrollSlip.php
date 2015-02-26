<?php

class payrollSlip extends fpdf
{

    function report($model, $month)
    {
        $this->y0 = $this->GetY();
        $this->Cell(0, 1, '', 'T', 0, 'C');
        $this->Image('shareimages/company/logoAlt1.jpg', 15, 11, 22);
        $this->SetY($this->y0);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 3, '', 'LR');
        $this->Ln();
        $this->Cell(30, 3, '', 'L');
        $this->Cell(0, 3, 'SLIP GAJI - ' . peterFunc::bulantahun(date("Y") . $month), 'R', 0, 'C');
        $this->Ln();
        $this->Cell(0, 3, '', 'LBR');
        $this->Ln(5);

        $this->SetFillColor(230, 230, 230);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 8, $model->person->mCompany(), 0, 0, 'C', true);
        $this->Ln(4);

        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, '', 'B', 0, 'C');
        $this->Ln();
        $this->Cell(25, 8, 'Nama', 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 8, ':  ' . $model->person->employee_name);
        $this->SetFont('Arial', '', 10);
        $this->Cell(15, 8, 'NIK');
        $this->Cell(35, 8, ':  ' . $model->person->employeeShortID);
        $this->Cell(25, 8, 'Tgl Bergabung');
        $this->Cell(20, 8, ':  ' . $model->person->companyfirst->start_date);
        $this->Cell(0, 8, '', 'R');
        $this->Ln();
        $this->Cell(25, 6, 'Departemen', 'L');
        $this->Cell(60, 6, ':  ' . $model->person->mDepartment());
        $this->Cell(15, 6, 'Jabatan');
        $this->Cell(80, 6, ':  ' . $model->person->mJobTitle());
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(0, 6, '', 'T');
        $this->Ln(1);

        $this->SetFillColor(230, 230, 230);
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 2, '', 'LTR');
        $this->Ln();

        $this->y1 = $this->GetY();
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(50, 6, 'Penerimaan:', 'L');
        $this->Cell(0, 6, '', 'R');
        $this->SetFont('Arial', '', 10);
        $this->Ln();
        $this->Cell(60, 6, '  Gaji Pokok  ', 'L');
        $this->Cell(2, 6, ': ');
        $this->Cell(30, 6, peterFunc::indoFormat($model->basic_salary), 0, 0, 'R');
        $this->Cell(0, 6, '', 'R');
        $this->Ln();

        $t_benefit = 0;
        foreach (gPayrollTemplate::benefitList($model->parent_id, $month) as $list1) {
            $this->Cell(60, 6, "  " . $list1["benefit"], 'L');
            $this->Cell(2, 6, ': ');
            $this->Cell(30, 6, peterFunc::indoFormat($list1["amount"]), 0, 0, 'R');
            $this->Cell(0, 6, '', 'R');
            $this->Ln();
            $t_benefit = $t_benefit + $list1["amount"];
        }

        $this->y2 = $this->GetY();

        $this->SetY($this->y1);
        $this->Cell(100, 6, '');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(100, 6, 'Potongan:');
        $this->SetFont('Arial', '', 10);
        $this->Ln();

        $t_deduction = 0;
        foreach (gPayrollTemplate::deductionList($model->parent_id, $month) as $list2) {
            $this->Cell(100, 6, '');
            $this->Cell(55, 6, "  " . $list2["deduction"]);
            $this->Cell(2, 6, ': ');
            $this->Cell(30, 6, peterFunc::indoFormat($list2["amount"]), 0, 0, 'R');
            $this->Cell(0, 6, '', 'R');
            $this->Ln();
            $t_deduction = $t_deduction + $list2["amount"];
        }

        $this->SetY($this->y2);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 3, '', 'LR');
        $this->Ln();
        $this->Cell(2, 8, '', 'L');
        $this->Cell(58, 8, '', '');
        $this->Cell(2, 8, '', '');
        $this->Cell(30, 8, peterFunc::indoFormat($model->basic_salary + $t_benefit), 'T', 0, 'R');
        $this->Cell(18, 8, '', '');
        $this->Cell(45, 8, '', '');
        $this->Cell(2, 8, '', '');
        $this->Cell(30, 8, '', '', 0, 'R');
        $this->Cell(1, 8, '', '');
        $this->Cell(2, 8, '', 'R');
        $this->Ln();

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(50, 6, 'Insentif:', 'L');
        $this->Cell(0, 6, '', 'R');
        $this->SetFont('Arial', '', 10);
        $this->Ln();

        $t_insentif = 0;
        foreach (gPayrollTemplate::insentifList($model->parent_id, $month) as $list3) {
            $this->Cell(60, 6, "  " . $list3["insentif_name"], 'L');
            $this->Cell(2, 6, ': ');
            $this->Cell(30, 6, peterFunc::indoFormat($list3["amount"]), 0, 0, 'R');
            $this->Cell(0, 6, '', 'R');
            $this->Ln();
            $t_insentif = $t_insentif + $list3["amount"];
        }

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 3, '', 'LR');
        $this->Ln();
        $this->Cell(2, 8, '', 'L');
        $this->Cell(58, 8, '', '');
        $this->Cell(2, 8, '', '');
        $this->Cell(30, 8, peterFunc::indoFormat($t_insentif), 'T', 0, 'R');
        $this->Cell(18, 8, '', '');
        $this->Cell(45, 8, '', '');
        $this->Cell(2, 8, '', '');
        $this->Cell(30, 8, peterFunc::indoFormat($t_deduction), 'T', 0, 'R');
        $this->Cell(1, 8, '', '');
        $this->Cell(2, 8, '', 'R');
        $this->Ln();

        $net_salary = $model->basic_salary + $t_benefit + $t_insentif - $t_deduction;

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(2, 10, '', 'L');
        $this->Cell(64, 10, 'TOTAL Gaji (gapok + tunjangan + insentif - potongan)', 'B');
        $this->Cell(2, 10, '', 'B');
        $this->Cell(120, 10, peterFunc::indoFormat($net_salary), 'B', 0, 'R');
        $this->Cell(0, 10, '', 'R');
        $this->Ln();

        $this->Cell(0, 6, '', 'LR');
        $this->Ln(4);

        $this->Cell(12, 6, '', 'L');
        $this->Cell(48, 6, 'Jamsostek');
        $this->Cell(2, 6, '', '');
        $this->Cell(120, 6, '', 0, 0, 'R');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, '', 'R');
        $this->Ln();

        $this->Cell(12, 6, '', 'L');
        $this->Cell(78, 6, 'Jaminan Kecelakaan Kerja (JKK)');
        $this->Cell(10, 6, '0.24%');
        $this->Cell(2, 6, '', '');
        $this->Cell(50, 6, peterFunc::indoformat(gParamJamsostek::jkk() * $net_salary), 0, 0, 'R');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(12, 6, '', 'L');
        $this->Cell(78, 6, 'Jaminan Hari Tua (JHT)');
        $this->Cell(10, 6, '5.70%');
        $this->Cell(2, 6, '', '');
        $this->Cell(50, 6, peterFunc::indoformat(gParamJamsostek::jht() * $net_salary), 0, 0, 'R');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(12, 6, '', 'L');
        $this->Cell(78, 6, 'Jaminan Kematian (JKM)');
        $this->Cell(10, 6, '0.30%');
        $this->Cell(2, 6, '', '');
        $this->Cell(50, 6, peterFunc::indoformat(gParamJamsostek::jkm() * $net_salary), 0, 0, 'R');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(12, 6, '', 'L');
        $this->Cell(78, 6, 'Jaminan Pemeliharaan Kesehatan (JPK)', 'B');
        $this->Cell(10, 6, '3.00%', 'B');
        $this->Cell(2, 6, '', 'B');
        $this->Cell(50, 6, peterFunc::indoformat(gParamJamsostek::jpk() * $net_salary), 'B', 0, 'R');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, '', 'R');
        $this->Ln();

        $jamsostek = gParamJamsostek::jkk() * $net_salary + gParamJamsostek::jht() * $net_salary +
            gParamJamsostek::jkm() * $net_salary + gParamJamsostek::jpk() * $net_salary;
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(12, 6, '', 'L');
        $this->Cell(78, 6, 'TOTAL  Jamsostek');
        $this->Cell(10, 6, '');
        $this->Cell(2, 6, '', '');
        $this->Cell(50, 6, peterFunc::indoformat($jamsostek), 0, 0, 'R');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, '', 'R');
        $this->Ln();

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(2, 8, '', 'L');
        $this->Cell(78, 8, 'TOTAL Gaji Sebelum Pajak');
        $this->Cell(20, 8, '');
        $this->Cell(2, 8, '', '');
        $this->Cell(55, 8, '', '');
        $this->Cell(25, 8, peterFunc::indoformat($net_salary - $jamsostek), 'T', 0, 'R');
        $this->Cell(0, 8, '', 'R');
        $this->Ln();

        $beforetax = $net_salary - $jamsostek;
        $this->Cell(12, 6, '', 'L');
        $this->Cell(48, 6, 'Pengurang Pajak');
        $this->Cell(2, 6, '', '');
        $this->Cell(120, 6, '', 0, 0, 'R');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, '', 'R');
        $this->Ln();

        $this->SetFont('Arial', '', 10);
        $this->Cell(12, 6, '', 'L');
        $this->Cell(78, 6, 'Biaya Jabatan');
        $this->Cell(10, 6, '5%');
        $this->Cell(2, 6, '', '');
        $this->Cell(50, 6, peterFunc::indoformat($beforetax * 0.05), 0, 0, 'R');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, '', 'R');

        $pensiun = 0;

        $this->Ln();
        $this->Cell(12, 6, '', 'L');
        $this->Cell(78, 6, 'Iuran Pensiun');
        $this->Cell(10, 6, '_');
        $this->Cell(2, 6, '', '');
        $this->Cell(50, 6, peterFunc::indoformat($pensiun), 0, 0, 'R');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, '', 'R');
        $this->Ln();

        $totalpengurang = $beforetax * 0.05 + $pensiun;
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(12, 6, '', 'L');
        $this->Cell(78, 6, 'Pengurang', 'T');
        $this->Cell(10, 6, '', 'T');
        $this->Cell(2, 6, '', 'T');
        $this->Cell(50, 6, peterFunc::indoformat($totalpengurang), 'T', 0, 'R');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, '', 'R');
        $this->Ln();

        $beforepengurang = $totalpengurang; //belom ada Iuran Pensiun
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(2, 8, '', 'L');
        $this->Cell(78, 8, 'TOTAL Gaji Bersih');
        $this->Cell(20, 8, '');
        $this->Cell(2, 8, '', '');
        $this->Cell(55, 8, '', '');
        $this->Cell(25, 8, peterFunc::indoformat($beforetax - $beforepengurang), 'T', 0, 'R');
        $this->Cell(0, 8, '', 'R');
        $this->Ln();

        $this->Cell(0, 2, '', 'TB', 0, 'C');
        $this->Ln();
        $this->Cell(0, 6, 'Simulasi Penghitungan Pajak', 1, 0, 'C', true);
        $this->Ln();

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(2, 6, '', 'L');
        $this->Cell(78, 6, 'Penghasilan Net Disetahunkan + THR + Bonus ( x14 )');
        $this->Cell(20, 6, '');
        $this->Cell(2, 6, '', '');
        $this->Cell(55, 6, '', '');
        $this->Cell(25, 6, peterFunc::indoformat(($beforetax - $beforepengurang) * 14), '', 0, 'R');
        $this->Cell(0, 6, '', 'R');
        $this->Ln();

        $afterpengurang = ($beforetax - $beforepengurang) * 12;
        $this->Cell(12, 6, '', 'L');
        $this->Cell(48, 6, 'PTKP');
        $this->Cell(2, 6, '', '');
        $this->Cell(120, 6, '', 0, 0, 'R');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, '', 'R');
        $this->Ln();

        $this->SetFont('Arial', '', 10);
        $this->Cell(12, 6, '', 'L');
        $this->Cell(78, 6, 'WP Sendiri');
        $this->Cell(10, 6, '');
        $this->Cell(2, 6, '', '');
        $this->Cell(50, 6, peterFunc::indoformat(gParamJamsostek::ptkpwp()), 0, 0, 'R');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(12, 6, '', 'L');
        $this->Cell(78, 6, 'WP ' . " (" . $model->person->maritalStatus() . ") ");
        $this->Cell(10, 6, '');
        $this->Cell(2, 6, '', '');
        $this->Cell(50, 6, peterFunc::indoformat($model->person->maritalTaxValue() * gParamJamsostek::ptkpk()), 0, 0, 'R');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, '', 'R');
        $this->Ln();

        $ptkp = gParamJamsostek::ptkpwp() + ($model->person->maritalTaxValue() * gParamJamsostek::ptkpk());
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(12, 6, '', 'L');
        $this->Cell(78, 6, 'Total PTKP', 'T');
        $this->Cell(10, 6, '', 'T');
        $this->Cell(2, 6, '', 'T');
        $this->Cell(50, 6, peterFunc::indoformat($ptkp), 'T', 0, 'R');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, '', 'R');
        $this->Ln();

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(2, 8, '', 'L');
        $this->Cell(78, 8, 'PKP');
        $this->Cell(20, 8, '');
        $this->Cell(2, 8, '', '');
        $this->Cell(55, 8, '', '');
        $this->Cell(25, 8, peterFunc::indoformat($afterpengurang - $ptkp), 'T', 0, 'R');
        $this->Cell(0, 8, '', 'R');
        $this->Ln();

        $pkp = $afterpengurang - $ptkp;
        $pph = 0;
        $this->SetFont('Arial', '', 10);


        if ($pkp > gParamJamsostek::pph21(50)->range_start) {
            $this->Cell(12, 6, '', 'L');
            $this->Cell(66, 6, 'PPh 21');
            $this->Cell(20, 6, '');
            $this->Cell(2, 6, '', '');
            $this->Cell(10, 6, peterFunc::indoFormat(gParamJamsostek::pph21(50)->value) . '% x ', '', 0, 'R');
            $this->Cell(25, 6, peterFunc::indoFormat($pkp), '', 0, 'R');
            $this->Cell(45, 6, peterFunc::indoformat($pkp * gParamJamsostek::pph21(50)->value / 100), '', 0, 'R');
            $this->Cell(0, 6, '', 'R');
            $this->Ln();
            $pkp = $pkp - gParamJamsostek::pph21(250)->range_start;
            $pph = $pph + ($pkp * gParamJamsostek::pph21(50)->value / 100);
        }

        if ($pkp > gParamJamsostek::pph21(250)->range_start) {
            $this->Cell(12, 6, '', 'L');
            $this->Cell(66, 6, 'PPh 21');
            $this->Cell(20, 6, '');
            $this->Cell(2, 6, '', '');
            $this->Cell(10, 6, peterFunc::indoFormat(gParamJamsostek::pph21(250)->value) . '% x ', '', 0, 'R');
            $this->Cell(25, 6, peterFunc::indoFormat(gParamJamsostek::pph21(250)->range_start - 1), '', 0, 'R');
            $this->Cell(45, 6, peterFunc::indoformat(($pkp - gParamJamsostek::pph21(250)->range_start - 1) * gParamJamsostek::pph21(250)->value / 100), '', 0, 'R');
            $this->Cell(0, 6, '', 'R');
            $this->Ln();
            $pkp = $pkp - gParamJamsostek::pph21(250)->range_start;
            $pph = $pph + ($pkp * gParamJamsostek::pph21(250)->value / 100);
        }

        if ($pkp > gParamJamsostek::pph21(500)->range_start) {
            $this->Cell(12, 6, '', 'L');
            $this->Cell(66, 6, 'PPh 21');
            $this->Cell(20, 6, '');
            $this->Cell(2, 6, '', '');
            $this->Cell(10, 6, peterFunc::indoFormat(gParamJamsostek::pph21(500)->value) . '% x ', '', 0, 'R');
            $this->Cell(25, 6, peterFunc::indoFormat(gParamJamsostek::pph21(500)->range_start - 1), '', 0, 'R');
            $this->Cell(45, 6, peterFunc::indoformat(($pkp - gParamJamsostek::pph21(500)->range_start - 1) * gParamJamsostek::pph21(500)->value / 100), '', 0, 'R');
            $this->Cell(0, 6, '', 'R');
            $this->Ln();
            $pkp = $pkp - gParamJamsostek::pph21(500)->range_start;
            $pph = $pph + ($pkp * gParamJamsostek::pph21(500)->value / 100);
        }

        if ($pkp > gParamJamsostek::pph21(501)->range_start) {
            $this->Cell(12, 6, '', 'L');
            $this->Cell(66, 6, 'PPh 21');
            $this->Cell(20, 6, '');
            $this->Cell(2, 6, '', '');
            $this->Cell(10, 6, peterFunc::indoFormat(gParamJamsostek::pph21(501)->value) . '% x ', '', 0, 'R');
            $this->Cell(25, 6, peterFunc::indoFormat(gParamJamsostek::pph21(501)->range_start - 1), '', 0, 'R');
            $this->Cell(45, 6, peterFunc::indoformat(($pkp - gParamJamsostek::pph21(501)->range_start - 1) * gParamJamsostek::pph21(501)->value / 100), '', 0, 'R');
            $this->Cell(0, 6, '', 'R');
            $this->Ln();
            $pkp = $pkp - gParamJamsostek::pph21(501)->range_start;
            $pph = $pph + ($pkp * gParamJamsostek::pph21(501)->value / 100);
        }

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(2, 8, '', 'L');
        $this->Cell(78, 8, 'TOTAL PPh 21 Setahun');
        $this->Cell(20, 8, '');
        $this->Cell(2, 8, '', '');
        $this->Cell(55, 8, '', '');
        $this->Cell(25, 8, peterFunc::indoformat($pph), 'T', 0, 'R');
        $this->Cell(0, 8, '', 'R');
        $this->Ln();

        $this->SetFont('Arial', '', 10);
        $this->Cell(2, 8, '', 'L');
        $this->Cell(78, 8, 'PPH 21 Sebulan', 'T');
        $this->Cell(20, 8, '', 'T');
        $this->Cell(2, 8, '', 'T');
        $this->Cell(55, 8, '', 'T');
        $this->Cell(25, 8, peterFunc::indoformat($pph / 12), 'T', 0, 'R');
        $this->Cell(0, 8, '', 'R');
        $this->Ln();

        //$this->Cell(0, 8, '( '.peterFunc::terbilang($model->basic_salary + $t_benefit - $t_deduction).')', 'R');


        $this->Cell(0, 2, '', 'LBR');
        $this->Ln(10);
        /*
          $w = array(63, 63, 64);

          $this->Cell(0, 1, '', 'B');
          $this->Ln();
          $this->SetFont('Arial', '', 9);
          $this->Cell($w[0], 5, 'Dibuat oleh:', 'LTR', 0, 'C', true);
          $this->Cell($w[1], 5, 'Diterima oleh:', 'LTR', 0, 'C', true);
          $this->Cell($w[2], 5, '', 'LTR', 0, 'C', true);
          $this->Ln();
          $this->Cell($w[0], 25, '', 'LR');
          $this->Cell($w[1], 25, '', 'LR');
          $this->Cell($w[2], 25, '', 'LR');
          $this->Ln();
          $this->SetFont('Arial', '', 8);
          $this->Cell($w[0], 6, 'Nama:  ', 1);
          $this->Cell($w[1], 6, 'Nama:  ' . $model->person->employee_name, 1);
          $this->Cell($w[2], 6, '', 1);
          $this->Ln();
          $this->Cell($w[0], 5, 'Tanggal:  ' , 'LTR');
          $this->Cell($w[1], 5, 'Tanggal:', 'LTR');
          $this->Cell($w[2], 5, '', 'LTR');
          $this->Ln();
          $this->SetFont('Arial', 'B', 8);
          $this->Cell($w[0], 4, 'Finance', 'LBR', 0, 'C', true);
          $this->Cell($w[1], 4, 'Karyawan', 'LBR', 0, 'C', true);
          $this->Cell($w[2], 4, '', 'LBR', 0, 'C', true);
         */
    }

}

