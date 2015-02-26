<?php

class fBeginEndDate extends CFormModel
{

    public $begindate;
    public $enddate;
    public $report_id;
    public $company_id;
    public $period;
    public $level_id;
    public $year;

    public function rules()
    {
        return [
            ['begindate, enddate', 'required', 'on' => 'recruitment'],
            ['period', 'required', 'on' => 'attendance'],
            ['company_id, level_id, period,year', 'required', 'on' => 'performance'],
            ['period', 'required', 'on' => 'report'],            
            ['report_id,period, level_id, year,company_id', 'numerical', 'integerOnly' => true],
            ['begindate, enddate', 'type', 'type' => 'date', 'dateFormat' => 'dd-MM-yyyy'],
        ];
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return [
            'begindate' => 'Start Date',
            'enddate' => 'Finish Date',
            'report_id' => 'Report',
            'company_id' => 'Company',
            'period' => 'Period',
            'level_id' => 'Level',
        ];
    }

}
