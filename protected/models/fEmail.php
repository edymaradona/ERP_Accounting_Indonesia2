<?php

class fEmail extends CFormModel
{

    public $name;
    public $username;
    public $receiver;
    public $email;
    public $useremail;
    public $subject;
    public $body;
    public $verifyCode;

    public function rules()
    {
        return [
            ['subject, body', 'required'],
            ['useremail, email', 'email'],
            ['receiver', 'ext.MultiEmailValidator', 'delimiter' => ',', 'min' => 1, 'max' => 5],
            //array('verifyCode', 'captcha', 'allowEmpty' => !extension_loaded('gd'), 'on' => 'help'),
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'User Name',
            'useremail' => 'Email User',
            'receiver' => 'Receiver',
            'verifyCode' => 'Verification Code',
        ];
    }

}
