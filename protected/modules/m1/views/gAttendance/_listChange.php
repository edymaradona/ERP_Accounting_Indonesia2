<?php

$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-attendance-grid',
    'dataProvider' => gAttendance::model()->onWaiting(),
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
                    return CHtml::link($data->person->employee_name, Yii::app()->createUrl("/m1/gAttendance/view", ["id" => $data->parent_id]))
                    . "<br/>" . CHtml::tag('div', ['style' => 'color: #999; font-size: 12px'], $data->person->mDepartment());
                },
            'htmlOptions' => [
                'style' => 'width: 100px;',
            ]
        ],
        [
            'name' => 'cdate',
            'htmlOptions' => [
                'style' => 'width: 75px;',
            ]
        ],
        [
            'header' => 'Real / Request Pattern',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->realpattern->code . "<br/> | <br/>" .
                    $data->changepattern->code;
                },
            'htmlOptions' => [
                'style' => 'width: 100px;',
            ]
        ],
        [
            'header' => 'Superior/ HR Status',
            'type' => 'raw',
            'value' => function ($data) {
                    return $data->superior_approved->name . "<br/>" .
                    $data->approved->name;
                },
        ],
        'remark',
        [
            'class' => 'TbButtonColumn',
            'template' => '{approved}{rejected}{deleteschedule}',
            'buttons' => [
                'approved' => [
                    'label' => 'Approve',
                    'url' => 'Yii::app()->createUrl("/m1/gAttendance/approved",array("id"=>$data->id,"pid"=>$data->parent_id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => [
                        'ajax' => [
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
								$.fn.yiiGridView.update("g-attendance-grid", {
									data: $(this).serialize()
								});
								}',
                        ],
                        'class' => 'btn btn-primary btn-xs',
                        'style' => 'margin-bottom: 5px',
                    ],
                ],
                'rejected' => [
                    'label' => 'Reject',
                    'url' => 'Yii::app()->createUrl("/m1/gAttendance/rejected",array("id"=>$data->id,"pid"=>$data->parent_id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => [
                        'ajax' => [
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
								$.fn.yiiGridView.update("g-attendance-grid", {
									data: $(this).serialize()
								});
								}',
                        ],
                        'class' => 'btn btn-xs btn-default',
                        'style' => 'margin-bottom: 5px',
                    ],
                ],
                'deleteschedule' => [
                    'label' => 'Reset',
                    'url' => 'Yii::app()->createUrl("/m1/gAttendance/deleteSchedule",array("id"=>$data->id,"pid"=>$data->parent_id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => [
                        'ajax' => [
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
                                $.fn.yiiGridView.update("g-attendance-grid", {
                                    data: $(this).serialize()
                                });
                                }',
                        ],
                        'class' => 'btn btn-xs btn-default',
                    ],
                ],
            ],
        ],],
]);

