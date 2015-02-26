<?php

class fAddressbook extends CFormModel
{

    public $pid;
    public $complete_name;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['pid, complete_name', 'required'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'complete_name' => 'Complete Name',
        ];
    }

}
