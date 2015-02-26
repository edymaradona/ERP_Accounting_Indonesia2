<?php

class FullForm extends CFormModel
{

    public $textField;
    public $checkBox;
    public $dropDownList;
    public $passwordField;
    public $textArea;
    public $radioButton; //@todo trouble with initializate in Form()
    public $fileField;

    public function rules()
    {
        return [
            ['textField', 'required', 'message' => 'textField are not empty'],
            ['fileField', 'file'],
            ['checkBox, dropDownList, passwordField, textArea, radioButton', 'safe'],
        ];
    }

}