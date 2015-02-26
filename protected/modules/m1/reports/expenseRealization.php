<?php

class expenseRealization extends fpdf
{

    function report($model)
    {
        $this->y0 = $this->GetY();
        $this->Cell(0, 1, '', 'T', 0, 'C');
        $this->Image('shareimages/company/logoAlt1.jpg', 15, 11, 22);
        $this->SetY($this->y0);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 3, '', 'LR');
        $this->Ln();
        $this->Cell(20, 3, '', 'L');
        $this->Cell(0, 3, 'PERTANGGUNGJAWABAN BIAYA PERJALANAN DINAS', 'R', 0, 'C');
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
        $this->Cell(25, 8, '');
        $this->Cell(20, 8, '');
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
        $this->SetFont('Arial', '', 10);
        $this->Cell(60, 6, 'Tempat Tujuan', 'L');
        $this->Cell(2, 6, ': ');
        $this->Cell(30, 6, $model->destination);
        $this->Cell(0, 6, '', 'R');
        $this->Ln();

        $this->Cell(60, 6, 'Tanggal/Jam Berangkat', 'L');
        $this->Cell(2, 6, ': ');
        $this->Cell(40, 6, $model->start_date);
        $this->Cell(40, 6, 'Tanggal/Jam Kembali');
        $this->Cell(2, 6, ': ');
        $this->Cell(0, 6, $model->end_date, 'R');

        $this->Ln();

        $this->Cell(60, 6, 'Keperluan/Tujuan', 'L');
        $this->Cell(2, 6, ': ');
        $this->Cell(30, 6, substr($model->purpose,0,75));
        $this->Cell(0, 6, '', 'R');
        $this->Ln();

        if (strlen($model->purpose) >75) {
            $this->Cell(60, 6, '', 'L');
            $this->Cell(2, 6, ' ');
            $this->Cell(30, 6, substr($model->purpose,75,75));
            $this->Cell(0, 6, '', 'R');
            $this->Ln();
        }

        if (strlen($model->purpose) >150) {
            $this->Cell(60, 6, '', 'L');
            $this->Cell(2, 6, ' ');
            $this->Cell(30, 6, substr($model->purpose,150,75));
            $this->Cell(0, 6, '', 'R');
            $this->Ln();
        }

        if (strlen($model->purpose) >225) {
            $this->Cell(60, 6, '', 'L');
            $this->Cell(2, 6, ' ');
            $this->Cell(30, 6, substr($model->purpose,225,75));
            $this->Cell(0, 6, '', 'R');
            $this->Ln();
        }

        if (strlen($model->purpose) >300) {
            $this->Cell(60, 6, '', 'L');
            $this->Cell(2, 6, ' ');
            $this->Cell(30, 6, substr($model->purpose,300,75));
            $this->Cell(0, 6, '', 'R');
            $this->Ln();
        }

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 6, 'Uang Muka', 'L');
        $this->Cell(2, 6, ': ');
        $this->Cell(20, 6, peterFunc::indoFormat($model->advanced_amount) . " (" . peterFunc::terbilang($model->advanced_amount) . "Rupiah" . ")");
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(60, 6, 'Reimburstment', 'L');
        $this->Cell(2, 6, ': ');
        $this->Cell(20, 6, peterFunc::indoFormat($model->detailCR) . " (" . peterFunc::terbilang($model->detailCR) . "Rupiah" . ")");
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(60, 6, 'Total Biaya Perjalanan Dinas', 'L');
        $this->Cell(2, 6, ': ');
        $this->Cell(20, 6, peterFunc::indoFormat($model->detailC) . " (" . peterFunc::terbilang($model->detailC) . "Rupiah" . ")");
        $this->Cell(0, 6, '', 'R');
        $this->Ln();

        $this->Cell(0, 2, '', 'LR');
        $this->Ln();

        $this->Cell(0, 8, 'Detil Realisasi', 'LRB', 0, 'C', true);
        $this->Ln();

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(2, 7, '', 'L', 0, 'C', true);
        $this->Cell(50, 7, 'Item', 0, 0, 'L', true);
        $this->Cell(65, 7, 'Keterangan', 0, 0, 'L', true);
        $this->Cell(40, 7, 'Jumlah', 0, 0, 'R', true);
        $this->Cell(30, 7, 'Pembayaran', 0, 0, 'C', true);
        $this->Cell(0, 7, '', 'R', 0, 'C', true);
        $this->Ln();

        $this->SetFont('Arial', '', 9);

        $connection = Yii::app()->db;
        $sql = "
            SELECT *, 
            (SELECT d.company_name FROM g_expense_detail d WHERE d.parent_id = " . $model->id . " AND d.expense_id = ed.id) as company_name,
            (SELECT d.amount FROM g_expense_detail d WHERE d.parent_id = " . $model->id . " AND d.expense_id = ed.id) as amount,
            (SELECT d.remark FROM g_expense_detail d WHERE d.parent_id = " . $model->id . " AND d.expense_id = ed.id) as remark,
            (SELECT s.name FROM g_expense_detail d INNER JOIN s_parameter s ON s.code = d.payment_source_id AND s.type = 'cExpensePaymentSource'
                WHERE d.parent_id = " . $model->id . " AND d.expense_id = ed.id) as payment_source
            FROM g_param_expense_detail ed 
            ORDER BY ed.sort
        ";

        $command = $connection->createCommand($sql);
        //$command = $connection->createCommand($sql);
        $rows = $command->queryAll();

        foreach ($rows as $row) {

            if ($row['level_id'] == 0 || ($row['level_id'] != 0  && $row['level_id'] == $model->person->mLevelParentId() )  ) {
                $this->Cell(2, 4, '', 'L', 0, 'C');
                if ($row['parent_id'] == 0) {
                    $this->SetFont('Arial', 'B', 9);
                    $this->Cell(50, 4, $row['name']);
                } else {
                    $this->SetFont('Arial', '', 9);
                    $this->Cell(50, 4, '     ' . $row['name']);
                }

                $this->Cell(65, 4, $row['company_name']);
                $this->Cell(40, 4, peterFunc::indoFormat($row['amount']), 0, 0, 'R');
                $this->Cell(30, 4, $row['payment_source'],0,0,'C');
                $this->Cell(0, 4, '', 'R');
                if ($row['remark'] != null ) {
                    $this->Ln(4);
                    $this->SetFont('Arial', '', 8);
                    $this->Cell(0, 4, '             '.peterFunc::shorten_string($row['remark'],20),'LR');
                    $this->Ln(2);
                    $this->Cell(0, 4, '','LR');
                }

                $this->Ln();
            }
        }
        $this->Cell(0, 2, '', 'T');

        $this->SetFont('Arial', '', 9);
        $text = "Catatan :
        - Pengeluaran harus sudah dilaporkan selambat-lambatnya dalam 5 hari kerja setelah kembali dari perjalanan dinas.
          (Sesuai Pedoman Perjalanan Dinas  PHR-APL-066) Tiap pengeluaran dilampiri dengan bukti pengeluaran yang sah.";

        $this->Ln();
        $this->MultiCell(0, 5, $text, 1);


        $this->SetFont('Arial', '', 10);
        $this->Ln();
        $w = [48, 42, 47, 53];
        

        if ($this->GetY() > 250) {
            $this->AddPage();
        }

        $this->Cell(0, 1, '', 'B');
        $this->Ln();
        $this->SetFont('Arial', '', 10);
        $this->Cell($w[0], 6, 'Pelaksana Tugas:', 'LTR', 0, 'C', true);
        $this->Cell($w[1], 6, 'Atasan:', 'LTR', 0, 'C', true);
        $this->Cell($w[2], 6, 'HR Manager:', 'LTR', 0, 'C', true);
        $this->Cell($w[3], 6, 'Finance/Accounting:', 'LTR', 0, 'C', true);
        $this->Ln();
        $this->Cell($w[0], 20, '', 'LR');
        $this->Cell($w[1], 20, '', 'LR');
        $this->Cell($w[2], 20, '', 'LR');
        $this->Cell($w[3], 20, '', 'LR');
        $this->Ln();
        $this->SetFont('Arial', '', 10);
        $this->Cell($w[0], 6, $model->person->employee_name, 1, 0, 'C');
        $this->Cell($w[1], 6, 'Nama:', 1);
        $this->Cell($w[2], 6, 'Nama:', 1);
        $this->Cell($w[3], 6, 'Nama:', 1);
        $this->Ln();
        $this->Cell($w[0], 6, date('d-m-Y'), 1, 0, 'C');
        $this->Cell($w[1], 6, 'Tanggal:', 1);
        $this->Cell($w[2], 6, 'Tanggal:', 1);
        $this->Cell($w[3], 6, 'Tanggal:', 1);
        $this->Ln();
    }

}

