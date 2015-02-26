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
        ],
        'cdate',
        [
            'header' => 'Real Pattern',
            'value' => '$data->realpattern->code',
        ],
        [
            'header' => 'Request Pattern',
            'value' => '$data->changepattern->code',
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
            'class' => 'TbButtonColumn',
            'template' => '{approved}',
            'buttons' => [
                'approved' => [
                    'label' => 'Approved',
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
                    ],
                ],
            ],
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{rejected}',
            'buttons' => [
                'rejected' => [
                    'label' => 'Rejected',
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
                        'class' => 'btn btn-primary btn-xs',
                    ],
                ],
            ],
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{emptied}',
            'buttons' => [
                'emptied' => [
                    'label' => 'Deleted',
                    'url' => 'Yii::app()->createUrl("/m1/gAttendance/emptied",array("id"=>$data->id,"pid"=>$data->parent_id))',
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
                    ],
                ],
            ],
        ],
    ],
]);

