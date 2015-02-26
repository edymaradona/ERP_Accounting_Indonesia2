<?php

class M2Module extends CWebModule
{

    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport([
            'm2.models.*',
            'm2.components.*',
            'm2.reports.*',
        ]);
    }

    public $ACCOUNT_TYPE_ALL = [
        'accmain_id' => 'accmain_id',
        'haschild_id' => 'haschild_id',
        'cashbank_id' => 'cashbank_id',
        'cashbank_code' => 'cashbank_code',
        'currency_id' => 'currency_id',
        'state_id' => 'state_id'
    ];
    public $ACCOUNT_TYPE_SPEC1 = [
        'cashbank_id' => 'cashbank_id',
        'cashbank_code' => 'cashbank_code',
        'currency_id' => 'currency_id',
        'state_id' => 'state_id'
    ];

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        } else
            return false;
    }

}
