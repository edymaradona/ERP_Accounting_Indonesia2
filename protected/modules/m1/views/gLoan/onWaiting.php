<?php

$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-person-grid',
    'dataProvider' => gLoan::model()->onWaiting(),
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
                    return CHtml::link($data->person->employee_name, Yii::app()->createUrl("/m1/gLoan/view", ["id" => $data->parent_id]))
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], $data->person->mDepartment());
                },
        ],
        [
            'header' => 'Loan Type - Purpose',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->loan_type->name
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], $data->purpose);
                },
        ],
        [
            'header' => 'Debit',
            'value' => 'peterFunc::indoFormat($data->debit)',
        ],
        [
            'header' => 'Credit',
            'value' => 'peterFunc::indoFormat($data->credit)',
        ],
        [
            'header' => 'Balance',
            'value' => 'peterFunc::indoFormat($data->balance)',
        ],
        [
            'header' => 'Superior Status',
            'value' => '$data->superior_approved->name',
        ],
        [
            'header' => 'HR Status',
            'value' => '$data->approved->name',
        ],
        [
            'class' => 'booster.widgets.TbButtonColumn',
            //'template'=>'{update}{delete}',
            'template' => '{delete}',
            //'updateButtonUrl'=>'Yii::app()->createUrl("/m1/gLoan/update",array("id"=>$data->id))',
            'deleteButtonUrl' => 'Yii::app()->createUrl("/m1/gLoan/delete",array("id"=>$data->id))',
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{print}',
            'buttons' => [
                'print' => [
                    'label' => 'Print',
                    'url' => 'Yii::app()->createUrl("/m1/gLoan/printLoan",array("id"=>$data->id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                        'target' => '_blank',
                    ],
                ],
            ],
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{process}',
            'buttons' => [
                'process' => [
                    'label' => 'Process',
                    'url' => 'Yii::app()->createUrl("/m1/gLoan/process",array("id"=>$data->id,"pid"=>$data->parent_id))',
                    'visible' => '$data->approved_id ==1',
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

