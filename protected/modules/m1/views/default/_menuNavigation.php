<?php

$this->widget('booster.widgets.TbMenu', [
    'type' => 'list',
    'items' => [
        ['label' => 'HOME'],
        ['label' => 'Main Dashboard', 'icon' => 'leaf', 'url' => Yii::app()->createUrl("/m1/default")],
        ['label' => 'CURRENT DATA'],
        ['label' => 'Profile', 'icon' => 'th-large', 'url' => Yii::app()->createUrl("/m1/default/compByProfile")],
        ['label' => 'Career', 'icon' => 'th-large', 'url' => Yii::app()->createUrl("/m1/default/compByCareer")],
        ['label' => 'Department', 'icon' => 'th-large', 'url' => Yii::app()->createUrl("/m1/default/compByDepartment")],
        ['label' => 'DATA COMPLETION'],
        ['label' => 'Uncomplete Data', 'icon' => 'list', 'url' => Yii::app()->createUrl("/m1/default/uncomplete")],
        ['label' => 'INFORMATION'],
        ['label' => 'Birthday', 'icon' => 'list', 'url' => Yii::app()->createUrl("/m1/default/birthday")],
        ['label' => 'Probation/Contract', 'icon' => 'list', 'url' => Yii::app()->createUrl("/m1/default/probationcontract")],
        ['label' => 'Employee In/Out', 'icon' => 'list', 'url' => Yii::app()->createUrl("/m1/default/employeeinout")],
        ['label' => 'Black List', 'icon' => 'list', 'url' => Yii::app()->createUrl("/m1/default/blacklist")],
    ],
    'htmlOptions' => [

    ]
]);
