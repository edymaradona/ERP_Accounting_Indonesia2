<br/>

<div class="row">
    <div class="col-md-12">

        <?php
        echo $this->renderPartial("/gLeave/_leaveBalance", ["model" => $model], true);
        ?>
    </div>
</div>


<?php
$this->widget('booster.widgets.TbGridView', [
    //$this->widget('ext.groupgridview.GroupGridView', array(
    //'extraRowColumns' => array('start_date'),
    'id' => 'g-leave-grid',
    'dataProvider' => GLeave::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'rowCssClassExpression' => '
        ( ($data->approved_id == 9) ? "info" : "" )
    ',
    //'rowCssClassExpression'=> function($data){
    //	if ($data->leave_reason == "Auto Generated Leave") {
    //	return "highlight";
    //	} else
    //	return "white";
    //	}
    //},
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
        'leave_reason',
        //'mass_leave',
        //'person_leave',
        'balance',
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
                    'url' => 'Yii::app()->createUrl("/m1/gEss/leaveSuperiorApproved",array("id"=>$data->id,"pid"=>$data->person->id))',
                    'visible' => '$data->superior_approved_id ==1 || $data->superior_approved_id ==5 || $data->superior_approved_id ==6',
                    'options' => [
                        'ajax' => [
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
														$.fn.yiiGridView.update("g-leave-grid", {
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
                    'url' => 'Yii::app()->createUrl("/m1/gEss/leaveSuperiorRejected",array("id"=>$data->id,"pid"=>$data->person->id))',
                    'visible' => '$data->superior_approved_id ==1 || $data->superior_approved_id ==5 || $data->superior_approved_id ==6',
                    'options' => [
                        'ajax' => [
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
														$.fn.yiiGridView.update("g-leave-grid", {
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

