<?php

$this->widget('booster.widgets.TbMenu', [
    'type' => 'list',
    'items' => [
        ['label' => 'HOME'],
        ['label' => 'Main Dashboard', 'icon' => 'leaf', 'url' => Yii::app()->createUrl("/m1/default2")],
        ['label' => 'Dashboard Detail', 'icon' => 'leaf', 'url' => Yii::app()->createUrl("/m1/default2/index2")],
        ['label' => 'COMPARISON'],
        ['label' => 'Total Employee', 'icon' => 'th-large', 'url' => Yii::app()->createUrl("/m1/default2/compTotalEmployee")],
        ['label' => 'By Company Type', 'icon' => 'th-large', 'url' => Yii::app()->createUrl("/m1/default2/compCompanyType")],
        ['label' => 'Employee (Profile)', 'icon' => 'th-large', 'url' => Yii::app()->createUrl("/m1/default2/compByProfile")],
        ['label' => 'Employee (Career)', 'icon' => 'th-large', 'url' => Yii::app()->createUrl("/m1/default2/compByCareer")],
        ['label' => 'DATA COMPLETION'],
        ['label' => 'Uncomplete Data', 'icon' => 'list', 'url' => Yii::app()->createUrl("/m1/default2/uncomplete")],
        ['label' => 'OPERATION'],
        ['label' => 'Request to Mutation', 'icon' => 'list', 'url' => Yii::app()->createUrl("/m1/default2/requestMutation")],
        ['label' => 'Permission vs Leave', 'icon' => 'list', 'url' => Yii::app()->createUrl("/m1/default2/permissionLeave")],
    ],
    'htmlOptions' => [
    ]
]);
