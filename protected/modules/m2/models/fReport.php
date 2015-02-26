<?php

class fReport extends CFormModel
{

    public $periode_date;
    public $report_id;

    public function rules()
    {
        return [
            ['periode_date, report_id', 'required'],
            ['periode_date, report_id', 'numerical', 'integerOnly' => true],
        ];
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return [
            'periode_date' => 'Periode Date',
            'report_id' => 'Report',
        ];
    }

}
