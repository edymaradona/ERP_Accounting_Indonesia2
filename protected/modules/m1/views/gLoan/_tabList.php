<?php

$this->widget('booster.widgets.TbGridView', [
    //$this->widget('ext.groupgridview.GroupGridView', array(
    //'extraRowColumns' => array('process_date'),
    'id' => 'g-loan-grid',
    'dataProvider' => gLoan::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        [
            'header' => 'Process',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->process_date;
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
            'header' => 'Superior State',
            'value' => '$data->superior_approved->name',
        ],
        [
            'header' => 'HR State',
            'value' => '$data->approved->name',
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{process}',
            'buttons' => [
                'process' => [
                    'label' => 'Process',
                    'url' => 'Yii::app()->createUrl("/m1/gLoan/process",array("id"=>$data->id,"pid"=>$data->person->id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => [
                        'ajax' => [
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
														$.fn.yiiGridView.update("g-loan-grid", {
														data: $(this).serialize()
                                            });
                                        }',
                        ],
                        'class' => 'btn btn-xs btn-default',
                    ],
                ],
            ],
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
                    ],
                ],
            ],
        ],
        [
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gLoan/delete",array("id"=>$data->id))',
            'updateDialog' => [
                'controllerRoute' => 'm1/gLoan/update',
                'actionParams' => ['id' => '$data->id'],
                'dialogTitle' => 'Update Loan',
                'dialogWidth' => 800, //override the value from the dialog config
                'dialogHeight' => 530
            ],
        ],
    ],
]);
