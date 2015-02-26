<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'g-person-grid',
    'dataProvider' => gLeave::model()->onWaiting(),
    //'filter'=>$model,
    'template' => '{items}',
    'rowCssClassExpression' => '
        ( (strtotime($data->start_date) <= time()) ? "warning" : "" )
    ',
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
                    return CHtml::link($data->person->employee_name, Yii::app()->createUrl("/m1/gLeave/view", ["id" => $data->parent_id]))
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
            'header' => 'No. of Days/ Balance',
            'type' => 'raw',
            //'value' => '$data->superior_approved->name',
            'value' => function ($data) {
                    return $data->number_of_day . "<br/>" .
                    (isset($data->person->leaveBalance)) ? $data->person->leaveBalance->balance : 0 ;
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
            //'updateButtonUrl'=>'Yii::app()->createUrl("/m1/gLeave/update",array("id"=>$data->id))',
            'deleteButtonUrl' => 'Yii::app()->createUrl("/m1/gLeave/delete",array("id"=>$data->id))',
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{print}{printextended}{printcancel}{approved}',
            'buttons' => [
                'print' => [
                    'label' => 'Print',
                    'url' => 'Yii::app()->createUrl("/m1/gLeave/printLeave",array("id"=>$data->id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                        'style' => 'margin-bottom:5px;',
                        'target' => '_blank',
                    ],
                ],
                'printextended' => [
                    'label' => 'Print Extended',
                    'url' => 'Yii::app()->createUrl("/m1/gLeave/printExtendedLeave",array("id"=>$data->id))',
                    'visible' => '$data->approved_id ==5',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                        'style' => 'margin-bottom:5px;',
                        'target' => '_blank',
                    ],
                ],
                'printcancel' => [
                    'label' => 'Print',
                    'url' => 'Yii::app()->createUrl("/m1/gLeave/printCancellationLeave",array("id"=>$data->id))',
                    'visible' => '$data->approved_id ==6',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                        'style' => 'margin-bottom:5px;',
                        'target' => '_blank',
                    ],
                ],
                'approved' => [
                    'label' => 'Approved',
                    //'icon' => 'icon-ok-circle',
                    'url' => 'Yii::app()->createUrl("/m1/gLeave/approved",array("id"=>$data->id,"pid"=>$data->parent_id))',
                    'visible' => '$data->approved_id ==1 || $data->approved_id ==5 || $data->approved_id ==6 ',
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

