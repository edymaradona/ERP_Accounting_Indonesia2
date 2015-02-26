<?php

$this->widget('booster.widgets.TbGridView', [
    //$this->widget('ext.groupgridview.GroupGridView', array(
    //'extraRowColumns' => array('start_date'),
    'id' => 'g-permission-grid',
    'dataProvider' => gPermission::model()->search($model->id),
    //'filter'=>$model,
    //'template' => '{items}',
    'columns' => [
        //'start_date',
        'start_date',
        'end_date',
        'number_of_day',
        //'work_date',
        [
            'header' => 'Permission Type - Reason',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->permission_type->name
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], $data->permission_reason);
                },
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
            'template' => '{approved}',
            'buttons' => [
                'approved' => [
                    'label' => 'Approved',
                    'url' => 'Yii::app()->createUrl("/m1/gPermission/approved",array("id"=>$data->id,"pid"=>$data->person->id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => [
                        'ajax' => [
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
														$.fn.yiiGridView.update("g-permission-grid", {
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
                    'url' => 'Yii::app()->createUrl("/m1/gPermission/printPermission",array("id"=>$data->id))',
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
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPermission/delete",array("id"=>$data->id))',
            'updateDialog' => [
                'controllerRoute' => 'm1/gPermission/update',
                'actionParams' => ['id' => '$data->id'],
                'dialogTitle' => 'Update Permission',
                'dialogWidth' => 800, //override the value from the dialog config
                'dialogHeight' => 530
            ],
        ],
    ],
]);
