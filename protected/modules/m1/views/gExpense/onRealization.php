<?php
$this->breadcrumbs = [
    'G people',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gExpense']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
    //array('label'=>'Manage gPerson','url'=>array('admin')),
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
        ['label' => 'Waiting for Approval', 'url' => Yii::app()->createUrl('/m1/gExpense')],
        ['label' => 'Realization Detail', 'url' => Yii::app()->createUrl('/m1/gExpense/onRealization'), 'active' => true],
        ['label' => 'Finance', 'url' => Yii::app()->createUrl('/m1/gExpense/onProcess')],
        ['label' => 'Recent Travel / Return to Homebase', 'url' => Yii::app()->createUrl('/m1/gExpense/onRecent')],
    ],
    'htmlOptions' => [
    ]
]);
?>


<?php

$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-person-grid',
    'dataProvider' => gExpense::model()->onRealization(),
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
            'header' => 'Start - End Date',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->start_date . " - <br/>" . $data->end_date;
                },
        ],
        [
            'header' => 'Type - Purpose',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->expense_type->name
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], $data->purpose);
                },
        ],
        'destination',
        [
            'header' => 'Advanced / Realization Amount',
            'type' => 'raw',
            'value' => function ($data) {
                    return peterFunc::indoFormat($data->advanced_amount)
                    . "<br/>" . peterFunc::indoFormat($data->detailC);
                },
        ],
        [
            'class' => 'booster.widgets.TbButtonColumn',
            //'template'=>'{update}{delete}',
            'template' => '{delete}',
            //'updateButtonUrl'=>'Yii::app()->createUrl("/m1/gExpense/update",array("id"=>$data->id))',
            'deleteButtonUrl' => 'Yii::app()->createUrl("/m1/gExpense/delete",array("id"=>$data->id))',
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{verified}{print}{process}',
            'buttons' => [
                'verified' => [
                    'label' => 'Verified Realization',
                    'url' => 'Yii::app()->createUrl("/m1/gExpense/viewVerified",array("id"=>$data->id,"pid"=>$data->person->id))',
                    'visible' => '$data->approved_id ==2',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                        'style' => 'margin-bottom:3px',
                    ],
                ],
                'print' => [
                    'label' => 'Print Realization',
                    'url' => 'Yii::app()->createUrl("/m1/gExpense/printRealization",array("id"=>$data->id))',
                    'visible' => '$data->approved_id ==2',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                        'style' => 'margin-bottom:3px',
                        'target' => '_blank',
                    ],
                ],
                'process' => [
                    'label' => 'Process to Finance',
                    'url' => 'Yii::app()->createUrl("/m1/gExpense/process",array("id"=>$data->id,"pid"=>$data->parent_id))',
                    'visible' => '$data->approved_id ==2',
                    'options' => [
                        'ajax' => [
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
                                $.fn.yiiGridView.update("g-person-grid", {
                                    data: $(this).serialize()
                                });
                                }',
                        ],
                        'class' => 'btn btn-primary btn-xs',
                    ],
                ],
            ],
        ],
    ],
]);


