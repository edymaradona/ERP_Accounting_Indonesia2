<?php

Yii::import('zii.widgets.grid.CGridView');

/**
 * Created by JetBrains PhpStorm.
 * User: mariano
 * Date: 1/7/14
 * Time: 12:03 PM
 * To change this template use File | Settings | File Templates.
 */
class EExcelWriter extends CGridView
{

    public $fileName = null;
    public $stream = false; //stream to browser
    public $title = '';
    public $summary = '';
    private $workBook;
    private $activeWorksheet;
    private $currentRow = 0;
    private $currentCol = 0;
    private $headerFormat;
    private $rowFormat;
    private $columnLenghts = [];

    public function init()
    {
        error_reporting(E_ALL ^ E_NOTICE);
        ini_set('display_errors', 0);
        Yii::import('application.vendors.*');

        require_once('excelwriter/class.writeexcel_workbookbig.inc.php');
        require_once('excelwriter/class.writeexcel_worksheet.inc.php');

        $this->initColumns();
        $this->workBook = new writeexcel_workbookbig($this->fileName);
        $this->activeWorksheet = $this->workBook->addworksheet();

        // add some default formatting
        $this->headerFormat = $this->workBook->addformat();
        $this->headerFormat->set_bold();

        $this->rowFormat = $this->workBook->addformat();
    }

    public function renderSummary()
    {
        # Create a border format
        //$border1 = $this->workBook->addformat();
        //$border1->set_color('black');
        //$border1->set_bold();
        //$border1->set_size(40);
        //$border1->set_pattern(0x1);
        //$border1->set_fg_color('green');
        //$border1->set_border_color('yellow');
        ///$border1->set_top(6);
        //$border1->set_bottom(6);
        //$border1->set_left(6);
        //$border1->set_align('center');
        //$border1->set_align('left');
        //$border1->set_merge(); # This is the key feature
        # Create another border format. Note you could use copy() here.
        /*
          $border2 = $this->workBook->addformat();
          $border2->set_color('black');
          //$border2->set_bold();
          //$border2->set_size(15);
          //$border2->set_pattern(0x1);
          //$border2->set_fg_color('green');
          //$border2->set_border_color('yellow');
          //$border2->set_top(6);
          //$border2->set_bottom(6);
          //$border2->set_right(6);
          $border2->set_align('left');
          $border2->set_align('hleft');
          $border2->set_merge(); # This is the key feature
         * 
         */

        # Only one cell should contain text, the others should be blank.
        ///$this->activeWorksheet->write      ($this->currentRow, $this->currentCol, $this->summary, $border1);
        //$this->activeWorksheet->write_blank($this->currentRow, $this->currentCol + 1,                 $border1);
        //$this->activeWorksheet->write_blank($this->currentRow, $this->currentCol + 2,                 $border1);
        # Create a "text wrap" format
        //$formatWrap = $this->workBook->addformat();
        //$formatWrap->set_text_wrap();        
        //$this->activeWorksheet->write( $this->currentRow , $this->currentCol, $this->summary, $formatWrap);  
        $this->activeWorksheet->set_column('B:C');
        $heading = $this->workBook->addformat([
            bold => 1,
            color => 'black',
            size => 10,
            merge => 1,
            align => 'vcenter'
        ]);

        $headings = ["Summary"];
        $this->activeWorksheet->write_row('B1', $headings, $heading);

        $this->activeWorksheet->set_column('C:D:E:F:G:H', 36);
        $heading = $this->workBook->addformat([
            bold => 0,
            color => 'black',
            size => 10,
            merge => 1,
            align => 'vjustify'
        ]);

        $headings = [$this->summary, '', '', '', '', ''];
        $this->activeWorksheet->write_row('C1', $headings, $heading);

        $this->currentRow = $this->currentRow + 2;
    }

    public function renderHeader()
    {


        foreach ($this->columns as $column) {
            if ($column instanceof CButtonColumn)
                $head = $column->header;
            elseif ($column->header === null && $column->name !== null) {
                if ($column->grid->dataProvider instanceof CActiveDataProvider)
                    $head = $column->grid->dataProvider->model->getAttributeLabel($column->name);
                else
                    $head = $column->name;
            } else
                $head = trim($column->header) !== '' ? $column->header : $column->grid->blankDisplay;

            $this->activeWorksheet->write($this->currentRow, $this->currentCol, $head, $this->headerFormat);
            $this->columnLenghts[$this->currentCol] = strlen($head);
            $this->currentCol++;
        }

        $this->currentRow++;
    }

    public function renderBody()
    {
        $batchPageSize = 100;
        $provider = $this->dataProvider;
        $pager = $provider->getPagination();
        $pager->setItemCount($provider->getTotalItemCount());

        $pager->setPageSize($batchPageSize);
        $pageNumber = $pager->getPageCount();
        $allCount = 0;
        for ($page = 0; $page < $pageNumber; $page++) {
            $pager->setCurrentPage($page);
            $this->dataProvider->setPagination($pager);
            $data = $this->dataProvider->getData(TRUE);
            $n = count($data);
            $allCount += $n;
            if ($n > 0) {
                for ($row = 0; $row < $n; ++$row)
                    $this->renderRow($row, $page * $batchPageSize + $row);
            }
        }
        return $allCount;
    }

    public function renderRow($row)
    {
        $data = $this->dataProvider->getData();
        $this->currentCol = 0;
        foreach ($this->columns as $n => $column) {
            if ($column instanceof CLinkColumn) {
                if ($column->labelExpression !== null)
                    $value = $column->evaluateExpression($column->labelExpression, ['data' => $data[$row], 'row' => $row]);
                else
                    $value = $column->label;
            } elseif ($column instanceof CButtonColumn)
                $value = ""; //Dont know what to do with buttons
            elseif ($column->value !== null)
                $value = $this->evaluateExpression($column->value, ['data' => $data[$row]]);
            elseif ($column->name !== null) {
                //$value=$data[$row][$column->name];
                $value = CHtml::value($data[$row], $column->name);
                $value = $value === null ? "" : $column->grid->getFormatter()->format($value, 'raw');
            }

            if (strpos($value, "$") !== FALSE) {
                $value = str_replace("$", "", $value);
            }
            $this->activeWorksheet->write($this->currentRow, $this->currentCol, $value, $this->rowFormat);
            if ($this->columnLenghts[$this->currentCol] < strlen($value)) {
                $this->columnLenghts[$this->currentCol] = strlen($value);
            }
            $this->currentCol++;
        }
        $this->currentRow++;
    }

    public function renderFooter($row)
    {
        $a = 0;
        foreach ($this->columns as $n => $column) {
            $a = $a + 1;
            if ($column->footer) {
                $footer = trim($column->footer) !== '' ? $column->footer : $column->grid->blankDisplay;

                $cell = $this->objPHPExcel->getActiveSheet()->setCellValue($this->columnName($a) . ($row + 2), $footer, true);
                if (is_callable($this->onRenderFooterCell))
                    call_user_func_array($this->onRenderFooterCell, [$cell, $footer]);
            }
        }
    }

    public function autofitColumns()
    {
        foreach ($this->columnLenghts as $col => $length) {
            $width = 0.9 * $length;
            $this->activeWorksheet->set_column($col, $col, $width);
        }
    }

    public function run()
    {
        $this->renderSummary();
        $this->renderHeader();
        $this->renderBody();
        $this->autofitColumns();
        $this->workBook->close();
        if ($this->stream) { //output to browser
            header("Content-Type: application/x-msexcel; name=\"" . $this->fileName . "\"");
            header("Content-Disposition: inline; filename=\"" . $this->fileName . "\"");
            $fh = fopen($this->fileName, "rb");
            fpassthru($fh);
        }
    }

}
