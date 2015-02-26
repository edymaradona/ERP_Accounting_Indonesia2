<?php
$this->breadcrumbs = [
    'G people',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gExpense']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];


//$this->menu1=gExpense::getTopUpdated();
//$this->menu2=gExpense::getTopCreated();
$this->menu5 = ['Travel / Return to Homebase'];

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gExpense/list')];

?>

    <div class="page-header">
        <h1>
            <i class="fa fa-money fa-fw"></i>
            Travel / Return to Homebase
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
        ['label' => 'Waiting for Process', 'url' => Yii::app()->createUrl('/m1/gExpense')],
        ['label' => 'Realization Detail', 'url' => Yii::app()->createUrl('/m1/gExpense/onRealization')],
        ['label' => 'Finance', 'url' => Yii::app()->createUrl('/m1/gExpense/onProcess')],
        ['label' => 'Recent Travel / Return to Homebase', 'url' => Yii::app()->createUrl('/m1/gExpense/onRecent'), 'active' => true],
    ],
    'htmlOptions' => [
    ]
]);
?>

<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-person-grid',
    'dataProvider' => gExpense::model()->OnRecent(),
    //'filter'=>$model,
    'template' => '{items}{pager}',
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
                    return CHtml::link($data->person->employee_name, Yii::app()->createUrl("/m1/gExpense/view", ["id" => $data->parent_id]))
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], $data->person->mDepartment());
                },
        ],
        [
            'header' => 'Process and Paid Date',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->process_date . "<br/>" . $data->paid_date;
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
