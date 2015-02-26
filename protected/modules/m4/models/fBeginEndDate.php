<?php

class fBeginEndDate extends CFormModel
{

    public $begindate;
    public $enddate;

    public function rules()
    {
        return [
            ['begindate, enddate', 'required'],
            ['begindate, enddate', 'type', 'type' => 'date', 'dateFormat' => 'yyyy-MM-dd'],
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
        ];
    }

}
