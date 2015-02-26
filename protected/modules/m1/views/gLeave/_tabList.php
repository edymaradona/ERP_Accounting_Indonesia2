<?php
$this->widget('booster.widgets.TbGridView', [
    //$this->widget('ext.groupgridview.GroupGridView', array(
    //'extraRowColumns' => array('start_date'),
    'id' => 'g-leave-grid',
    'dataProvider' => GLeave::model()->search($model->id),
    //'filter'=>$model,
    //'template' => '{items}',
    //'rowCssClassExpression' => '$data->cssReason()',
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
        'start_date',
        'end_date',
        //'number_of_day',
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'number_of_day',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gLeave/updateLeaveAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-1'
            ]],
        'leave_reason',
        //'mass_leave',
        //'person_leave',
        //'balance',
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'balance',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gLeave/updateLeaveAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-1'
            ]],
        [
            'header' => 'Superior State',
            'value' => '$data->superior_approved->name',
            'cssClassExpression' => '( ($data->superior_approved_id == 2) ? "green" : "white" )',
        ],
        [
            'header' => 'HR State',
            'value' => '$data->approved->name',
            'cssClassExpression' => '( ($data->approved_id == 2) ? "green" : "white" )',
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{print}{printextended}',
            'buttons' => [
                'print' => [
                    'label' => 'Print',
                    'url' => 'Yii::app()->createUrl("/m1/gLeave/printLeave",array("id"=>$data->id))',
                    'visible' => '$data->approved_id ==1 || $data->approved_id ==6',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                    ],
                ],
                'printextended' => [
                    'label' => 'Print Extended',
                    'url' => 'Yii::app()->createUrl("/m1/gLeave/printExtendedLeave",array("id"=>$data->id))',
                    'visible' => '$data->approved_id ==5',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                    ],
                ],
            ],
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{approved}',
            'buttons' => [
                'approved' => [
                    'label' => 'Approved',
                    'url' => 'Yii::app()->createUrl("/m1/gLeave/approved",array("id"=>$data->id,"pid"=>$data->person->id))',
                    'visible' => '$data->approved_id ==1 || $data->approved_id ==5 || $data->approved_id ==6',
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
        [
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gLeave/delete",array("id"=>$data->id))',
            'updateDialog' => [
                'controllerRoute' => 'm1/gLeave/update',
                'actionParams' => ['id' => '$data->id'],
                'dialogTitle' => 'Update Leave',
                'dialogWidth' => 800, //override the value from the dialog config
                'dialogHeight' => 530
            ],
        ],
    ],
]);

