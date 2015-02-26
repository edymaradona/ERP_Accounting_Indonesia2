<?php

$this->widget('booster.widgets.TbDetailView', [
    'data' => [
        'id' => 1,
        'account_type' => $model->cRoot,
        'currency' => $model->cCurrency,
        'state' => $model->cState,
        'has_child' => $model->haschildIsInherited,
        'parent_account' => $model->parentNameLink,
        'cash_bank' => $model->cashbankValue,
        'cash_bank_code' => $model->cashbankCodeValue,
        'entity' => $model->entityListComp,
        //'hutang' => (isset($model->hutang)) ? $model->hutang->setMvalue() : "Not Set",
        //'inventory' => (isset($model->inventory)) ? $model->inventory->setMvalue() : "Not Set",
    ],
    'attributes' => [
        ['name' => 'account_type', 'label' => 'Account Type'],
        ['name' => 'currency', 'label' => 'Currency'],
        ['name' => 'state', 'label' => 'Status'],
        ['name' => 'has_child', 'type' => 'raw', 'label' => 'Has Child'],
        ['name' => 'parent_account', 'type' => 'raw', 'label' => 'Parent Account'],
        ['name' => 'entity', 'label' => 'Entity'],
        ['name' => 'cash_bank', 'label' => 'Cash Bank Account', 'visible' => (isset($model->cashbank))],
        ['name' => 'cash_bank_code', 'label' => 'Cash Bank Code', 'visible' => (isset($model->cashbankCode))],
        //array('name' => 'hutang', 'label' => 'Payable Account', 'visible' => (isset($model->hutang))),
        //array('name' => 'inventory', 'label' => 'Inventory Account', 'visible' => (isset($model->inventory))),
    ],
]);
?>





