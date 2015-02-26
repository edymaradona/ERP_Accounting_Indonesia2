<?php

$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-person-grid',
    'dataProvider' => gPermission::model()->onWaiting(),
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
                    return CHtml::link($data->person->employee_name, Yii::app()->createUrl("/m1/gPermission/view", ["id" => $data->parent_id]))
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], $data->person->mDepartment());
                },
        ],
        //'number_of_day',
        [
            'header' => 'Permission Type - Reason',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->start_date . " -> " . $data->end_date
                    . "<br/>" . $data->permission_type->name
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], $data->permission_reason);
                },
        ],
        [
            'header' => 'Superior/ HR Status',
            'type' => 'raw',
            //'value' => '$data->superior_approved->name',
            'value' => function ($data) {
                    return $data->superior_approved->name . " " . CHtml::tag('i', ['style' => 'color: #999; font-size: 12px'], $data->created->username) . "<br/>" .
                    $data->approved->name . " " . CHtml::tag('i', ['style' => 'color: #999; font-size: 12px'], ($data->created_by != $data->updated_by && isset($data->updated->username)) ? $data->updated->username : "");
                },
        ],
        [
            'class' => 'booster.widgets.TbButtonColumn',
            //'template'=>'{update}{delete}',
            'template' => '{delete}',
            //'updateButtonUrl'=>'Yii::app()->createUrl("/m1/gPermission/update",array("id"=>$data->id))',
            'deleteButtonUrl' => 'Yii::app()->createUrl("/m1/gPermission/delete",array("id"=>$data->id))',
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{print}{approved}',
            'buttons' => [
                'print' => [
                    'label' => 'Print',
                    'url' => 'Yii::app()->createUrl("/m1/gPermission/printPermission",array("id"=>$data->id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                        'style' => 'margin-bottom:5px;',
                        'target' => '_blank',
                    ],
                ],
                'approved' => [
                    'label' => 'Approved',
                    'url' => 'Yii::app()->createUrl("/m1/gPermission/approved",array("id"=>$data->id,"pid"=>$data->parent_id))',
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

