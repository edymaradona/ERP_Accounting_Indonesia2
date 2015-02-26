<br/>

<div class="row">
    <div class="pull-right">
        <?php echo CHtml::ajaxLink(
            'Confirm All',
            Yii::app()->createUrl('m1/iLearningHolding/confirmAll', ['id' => $model->id]),
            ['success' => 'js:function(data){
                                $.fn.yiiGridView.update("i-learning-sch-part-grid", {
                                    data: $(this).serialize()
                                });
                            }',

            ],
            ['class' => 'btn btn-primary btn-xs']
        ); ?>
    </div>
</div>


<?php
$this->widget('ext.booster.widgets.TbGridView', [
    'id' => 'i-learning-sch-part-grid',
    'dataProvider' => iLearningSchPart::model()->searchHolding($model->id),
    //'filter'=>$model,
    'columns' => [
        [
            'header' => '#No.',
            'value' => '$row+1',
            'htmlOptions' => [
                'style' => 'text-align:right;margin-right:5px',
            ],
        ],
        [
            'type' => 'raw',
            'value' => 'isset($data->employee) ? $data->employee->PhotoPath : ""',
            'htmlOptions' => [

            ],
        ],
        [
            'header' => 'Employee Name',
            'type' => 'raw',
            'value' => function ($data) {
                    return CHtml::tag('div', ['style' => 'font-weight: bold'], $data->employee->employee_name)
                    . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->employee->mCompany())
                    . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->employee->mDepartment())
                    . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->employee->mLevel());
                },
        ],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'day1',
            //'headerHtmlOptions' => array('style' => 'width: 110px'),
            'editable' => [
                'url' => $this->createUrl('/m1/iLearningHolding/updateParticipantAjax'),
                'type' => 'select',
                'source' => ['1' => 'Present', '2' => 'Partial', '3' => 'Absence'],
            ]
        ],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'day2',
            //'headerHtmlOptions' => array('style' => 'width: 110px'),
            'editable' => [
                'url' => $this->createUrl('/m1/iLearningHolding/updateParticipantAjax'),
                'type' => 'select',
                'source' => ['1' => 'Present', '2' => 'Partial', '3' => 'Absence'],
            ]
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("/m1/iLearningHolding/deleteParticipant",array("id"=>$data->id))',
        ],
        [
            'header' => 'FeedBack',
            'type' => 'raw',
            //'value' => 'CHtml::link("Feedback",Yii::app()->createUrl("/m1/iLearningHolding/feedback",array("id"=>$data->id,"pid"=>$data->employee_id)),
            //			array("class"=>"btn btn-info btn-xs"))',
            'value' => function ($data) {
                    return CHtml::link("Feedback", Yii::app()->createUrl("/m1/iLearningHolding/feedback", ["id" => $data->id, "pid" => $data->employee_id]),
                        ["class" => "btn btn-info btn-xs"]) . "<br/>" .
                    $data->resultFeedback;
                },
        ],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'remark',
            'sortable' => false,
            'editable' => [
                'type' => 'textarea',
                'url' => $this->createUrl('/m1/iLearningHolding/updateParticipantAjax'),
            ]
        ],
        //[
        //    'header' => 'Inputed By',
        //    'name' => 'created.username'
        //],
        //'flow.name',
        [
            'header' => 'Status',
            'type' => 'raw',
            //'value' => 'CHtml::link("Feedback",Yii::app()->createUrl("/m1/iLearningHolding/feedback",array("id"=>$data->id,"pid"=>$data->employee_id)),
            //          array("class"=>"btn btn-info btn-xs"))',
            'value' => function ($data) {
                    return $data->flow->name . "<br/>" .
                    $data->certificate_number;
                },
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{print}{confirm}{cancel}',
            'buttons' => [
                'print' => [
                    'label' => 'Print',
                    'url' => 'Yii::app()->createUrl("/m1/iLearningHolding/print",array("id"=>$data->id))',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                        'style' => 'margin-bottom:3px;',
                        'target' => '_blank',
                    ],
                ],
                'confirm' => [
                    'label' => 'Confirm',
                    'url' => 'Yii::app()->createUrl("/m1/iLearningHolding/confirm",array("id"=>$data->id))',
                    'visible' => '$data->flow_id == 1 || $data->flow_id == 3',
                    'options' => [
                        'ajax' => [
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
                                $.fn.yiiGridView.update("i-learning-sch-part-grid", {
                                    data: $(this).serialize()
                                });
                            }',
                        ],
                        'class' => 'btn btn-xs btn-primary',
                        'style' => 'margin-bottom:3px;',
                    ],
                ],
                'cancel' => [
                    'label' => 'Cancel',
                    'url' => 'Yii::app()->createUrl("/m1/iLearningHolding/cancel",array("id"=>$data->id))',
                    'visible' => '$data->flow_id == 1 || $data->flow_id == 2',
                    'options' => [
                        'ajax' => [
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
                                $.fn.yiiGridView.update("i-learning-sch-part-grid", {
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
