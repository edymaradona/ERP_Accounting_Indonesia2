<?php
$this->breadcrumbs = [
    'G people',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gMedical']],
    ['label' => 'Medical Calendar', 'icon' => 'calendar', 'url' => ['/m1/gMedical/medicalCalendar']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];


$this->menu1 = [
    ['label' => 'Report to Insurance/Finance', 'icon' => 'print', 'url' => ['/m1/gMedical/weeklyReport']],
    ['label' => 'Medical Reports', 'icon' => 'print', 'url' => ['/m1/gMedical/reportByDept']],
];

$this->menu5 = ['Medical'];

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gMedical/list')];

?>

    <div class="page-header">
        <h1>
            <i class="fa fa-medkit fa-fw"></i>
            Medical
        </h1>
    </div>

<?php
//$this->renderPartial('_search', [
//    'model' => $model,
//]);
?>

<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'tabs' => [
        ['label' => 'Waiting for Process', 'url' => Yii::app()->createUrl('/m1/gMedical')],
        ['label' => 'Insurance/Finance', 'url' => Yii::app()->createUrl('/m1/gMedical/onProcess')],
        ['label' => 'Recent Medical', 'url' => Yii::app()->createUrl('/m1/gMedical/onRecent'), 'active' => true],
    ],
    'htmlOptions' => [
    ]
]);
?>

<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-person-grid',
    'dataProvider' => gMedical::model()->OnRecent(),
    //'filter'=>$model,
    //'template' => '{items}{pager}',
    'columns' => [
        [
            'type' => 'raw',
            'value' => '$data->person->photoPath',
            'htmlOptions' => ["width" => "50px"],
        ],
        [
            'header' => 'Name',
            'type' => 'raw',
            'value' => function ($data) {
                    return CHtml::link($data->person->employee_name, Yii::app()->createUrl("/m1/gMedical/view", ["id" => $data->parent_id]))
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], $data->person->mDepartment());
                },
        ],
        [
            'header' => 'Process and Settlement Date',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->process_date . "<br/>" . $data->settlement_date;
                },
        ],
        [
            'header' => 'Medical For',
            'value' => '$data->medicalForPlus',
        ],
        [
            'header' => 'Medical Type - Sympthom',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->medical_type->name
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], $data->sympthom);
                },
        ],
        [
            'header' => 'Original Amount',
            'value' => 'peterFunc::indoFormat($data->original_amount)',
        ],
        [
            'header' => 'Approved Amount',
            'value' => 'peterFunc::indoFormat($data->approved_amount)',
        ],
        'remark'
    ],
]);
