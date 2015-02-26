<?php
/* @var $this GPayrollController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = [
    'G Payrolls',
];

$this->menu = [
    ['label' => 'Report', 'icon' => 'print', 'url' => ['/m1/gPerformanceHolding/report']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];
?>

<div class="page-header">
    <h1>
        <i class="fa fa-flask fa-fw"></i>
        PRODESI Information
    </h1>
</div>

<?php
$this->renderPartial('_search', [
    'model' => $model,
]);
?>



<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'encodeLabel' => false,
    'tabs' => [
        ['label' => '<i class="fa fa-chevron-left fa-fw"></i>Previous Month', 'url' => Yii::app()->createUrl("/m1/gPerformanceHolding/index", ["periode" => peterFunc::cBeginDateBefore($periode)])],
        ['label' => $periode,
            'url' => Yii::app()->createUrl("/m1/gPerformanceHolding/index", ["periode" => $periode])],
        ['label' => 'Next Month <i class="fa fa-chevron-right"></i>', 'url' => Yii::app()->createUrl("/m1/gPerformanceHolding/index", ["month" => peterFunc::cBeginDateAfter($periode)])],
    ],
    'htmlOptions' => [

    ]
]);
?>

<br/>

<h4 style="margin-top: -5px; padding: 8px; background-color:#E6E6E6">
    Mutation</h4>

<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-newemployee-grid',
    'dataProvider' => gPerson::model()->getNewMutationAll($periode),
    'htmlOptions' => ["style" => "padding-top:0px"],
    'columns' => [
        [
            'type' => 'raw',
            'value' => '$data->photoPath',
            'htmlOptions' => ["width" => "50px"],
        ],
        [
            'header' => 'Name',
            'type' => 'raw',
            //'value' => 'CHtml::link($data->employee_name,Yii::app()->createUrl("/m1/gPerformanceHolding/view",array("id"=>$data->id)))',
            'value' => function ($data) {
                    return CHtml::link($data->employee_name, Yii::app()->createUrl("/m1/gPerformanceHolding/view", ["id" => $data->id])) . "<br/>" .
                    $data->mCompany() . "<br/>" . $data->mDepartment() . "<br/>" .
                    $data->mPreviousCompany() . "<br/>" . $data->mPreviousDepartment();
                },
        ],
        [
            'header' => 'Start Date',
            'value' => '$data->mCareerDate()',
        ],
        [
            'header' => 'New / Previous Job Title',
            'type' => 'raw',
            //'value' => '$data->mJobTitle()',
            'value' => function ($data) {
                    return $data->mJobTitle() . "<br/>" . $data->mPreviousJobTitle();
                },
        ],
        [
            'header' => 'New / Previous Level',
            'type' => 'raw',
            //'value' => '$data->mJobTitle()',
            'value' => function ($data) {
                    return $data->mLevel() . "<br/>" . $data->mPreviousLevel();
                },
        ],
        //array(
        //    'header' => 'Status',
        //    'value' => '$data->mStatus()',
        //),
    ],
]);
?>

<br/>

<h4 style="margin-top: -5px; padding: 8px; background-color:#E6E6E6">
    Promotion</h4>

<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-newemployee-grid',
    'dataProvider' => gPerson::model()->getNewPromotionAll($periode),
    'htmlOptions' => ["style" => "padding-top:0px"],
    'columns' => [
        [
            'type' => 'raw',
            'value' => '$data->photoPath',
            'htmlOptions' => ["width" => "50px"],
        ],
        [
            'header' => 'Name',
            'type' => 'raw',
            //'value' => 'CHtml::link($data->employee_name,Yii::app()->createUrl("/m1/gPerformanceHolding/view",array("id"=>$data->id)))',
            'value' => function ($data) {
                    return CHtml::link($data->employee_name, Yii::app()->createUrl("/m1/gPerformanceHolding/view", ["id" => $data->id])) . "<br/>" .
                    $data->mCompany() . "<br/>" . $data->mDepartment();
                },
        ],
        [
            'header' => 'Start Date',
            'value' => '$data->mCareerDate()',
        ],
        [
            'header' => 'New / Previous Job Title',
            'type' => 'raw',
            //'value' => '$data->mJobTitle()',
            'value' => function ($data) {
                    return $data->mJobTitle() . "<br/>" . $data->mPreviousJobTitle();
                },
        ],
        [
            'header' => 'New / Previous Level',
            'type' => 'raw',
            //'value' => '$data->mJobTitle()',
            'value' => function ($data) {
                    return $data->mLevel() . "<br/>" . $data->mPreviousLevel();
                },
        ],
        //array(
        //    'header' => 'Status',
        //    'value' => '$data->mStatus()',
        //),
    ],
]);
?>
