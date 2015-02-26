<br/>

<?php

$this->widget('booster.widgets.TbGridView', [
    //$this->widget('ext.groupgridview.GroupGridView', array(
    //'extraRowColumns' => array('start_date'),
    'id' => 'g-permission-grid',
    'dataProvider' => gPermission::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => [
        [
            'name' => 'start_date',
            'htmlOptions' => [
                'style' => 'width:100px',
            ],
            'type' => 'raw',
            'value' => function ($data) {
                    return
                        $data->start_date
                        . CHtml::tag('div', ['style' => 'font-size: 11px;'], date('l', strtotime($data->start_date)));
                }
        ],
        [
            'name' => 'end_date',
            'htmlOptions' => [
                'style' => 'width:100px',
            ],
            'type' => 'raw',
            'value' => function ($data) {
                    return
                        $data->end_date
                        . CHtml::tag('div', ['style' => 'font-size: 11px;'], date('l', strtotime($data->end_date)));
                }
        ],
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
                    'url' => 'Yii::app()->createUrl("/m1/gEss/permissionSuperiorApproved",array("id"=>$data->id,"pid"=>$data->person->id))',
                    'visible' => '$data->superior_approved_id ==1',
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
                    'url' => 'Yii::app()->createUrl("/m1/gEss/permissionSuperiorRejected",array("id"=>$data->id,"pid"=>$data->person->id))',
                    'visible' => '$data->superior_approved_id ==1',
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
    ],
]);
