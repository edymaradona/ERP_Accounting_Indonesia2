<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class fUltah extends CFormModel
{

    public $module;
    public $bulan;

    public function rules()
    {
        return [
            // username and password are required
            ['module, bulan', 'required'],
            //array('begindate, enddate', 'type', 'type'=>'date', 'dateFormat'=>'yyyy-MM-dd'),
            ['bulan', 'numerical', 'integerOnly' => true],
            ['bulan', 'length', 'max' => 15],
        ];
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return [
            'module' => 'Nama Module',
            'bulan' => 'Nama Bulan',
        ];
    }

}
