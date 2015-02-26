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
        ['label' => 'Insurance/Finance', 'url' => Yii::app()->createUrl('/m1/gMedical/onProcess'), 'active' => true],
        ['label' => 'Recent Medical', 'url' => Yii::app()->createUrl('/m1/gMedical/onRecent')],
    ],
    'htmlOptions' => [
    ]
]);
?>


<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-person-grid',
    'dataProvider' => gMedical::model()->onProcess(),
    //'filter'=>$model,
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
            'header' => 'Process Date',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->process_date
                    . CHtml::tag("div", ['style' => 'color:grey;font-size:12px;'], peterFunc::nicetime(strtotime($data->process_date)));
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
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'settlement_date',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gMedical/updateMedicalAjax'),
                'format' => 'dd-mm-yyyy',
                'inputclass' => 'col-md-2'
            ]],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'approved_amount',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gMedical/updateMedicalAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-2'
            ]
        ],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'remark',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gMedical/updateMedicalAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-3'
            ]
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{settle}',
            'buttons' => [
                'settle' => [
                    'label' => 'Settle',
                    'url' => 'Yii::app()->createUrl("/m1/gMedical/paid",array("id"=>$data->id,"pid"=>$data->parent_id))',
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
