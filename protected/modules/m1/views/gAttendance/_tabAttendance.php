<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'cpersonalia-Attendance-grid',
    'dataProvider' => gAttendance::model()->search((int)$model->id, $month),
    'itemsCssClass' => 'table table-bordered table-condensed',
    'template' => '{summary}{items}{pager}',
    //( $row%2 ? $this->rowCssClass[1] : $this->rowCssClass[0] ) .
    'rowCssClassExpression' => '
        ( ($data->realpattern_id == 90) ? "" : "info" )
    ',
    //'filter'=>$model,
    'columns' => [
        [
            'header' => 'Update',
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gAttendance/deleteAttendance",array("id"=>$data->id))',
            'updateDialog' => [
                'controllerRoute' => '/m1/gAttendance/updateAttendance',
                //'imageUrl'=>Yii::app()->request->baseUrlCdn.'/images/icon/ijin.png',
                'actionParams' => ['id' => '$data->id'],
                'dialogTitle' => 'Update Attendance',
                'dialogWidth' => 800, //override the value from the dialog config
                'dialogHeight' => 530
            ],
        ],
        [
            'name' => 'cdate',
            'type' => 'raw',
            //'value' => '$data->cdate',
            'value' => function ($data) {
                    return
                        CHtml::tag('div', [], $data->cdate)
                        . CHtml::tag('div', ['style' => 'font-size: 11px;'], date('l', strtotime($data->cdate)));
                }
        ],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'realpattern_id',
            //we need not to set value, it will be auto-taken from source
            // 'headerHtmlOptions' => array('style' => 'width: 60px'),
            'editable' => [
                'type' => 'select2',
                'url' => $this->createUrl('/m1/gAttendance/updateAjax'),
                'source' => gParamTimeblock::timeBlockDropDown(),
            ]
        ],

        [
            'name' => 'in',
            'type' => 'raw',
            'value' => function ($data3) {
                    return
                        (peterFunc::isTimeMore($data3->in, $data3->realpattern->in)) ?
                            CHtml::tag('div', ['style' => 'color: red;'], $data3->actualIn)
                            . CHtml::tag('div', ['style' => 'color: red;font-size: 11px;'], $data3->lateInStatus) : $data3->actualIn;
                }
        ],
        [
            'name' => 'out',
            'type' => 'raw',
            'value' => function ($data2) {
                    return
                        (peterFunc::isTimeMore2($data2->realpattern->out, $data2->out, $data2->in)) ?
                            CHtml::tag('div', ['style' => 'color: red;'], $data2->actualOut)
                            . CHtml::tag('div', ['style' => 'color: red;font-size: 11px;'], $data2->earlyOutStatus) : $data2->actualOut;
                }
        ],
        [
            'header' => 'Status',
            'type' => 'raw',
            'value' => function ($data) {
                    return
                        CHtml::tag('div', [], isset($data->syncPermission) ? "#P# " . $data->syncPermission->permission_reason . " "
                            . CHtml::tag("span", ['class' => 'badge badge-info'], $data->syncPermission->approved->name) : "")
                        . CHtml::tag('div', [], isset($data->syncLeave) ? "#L# " . $data->syncLeave->leave_reason . " "
                            . CHtml::tag("span", ['class' => 'badge badge-info'], $data->syncLeave->approved->name) : "")
                        . CHtml::tag('div', [], ($data->approved_id != 0) ? "#A# " . $data->changepattern->code . ". " . $data->remark . " "
                            . CHtml::tag("span", ['class' => 'badge badge-info'], $data->superior_approved->name)
                            . CHtml::tag("span", ['class' => 'badge badge-info'], $data->approved->name) : "")
                            . CHtml::tag('div', [], isset($data->syncLearning) ? "#T# " . $data->syncLearning->getparent->getparent->learning_title . " "
                                . CHtml::tag("span", ['class' => 'badge badge-info'], $data->syncLearning->flow->name) : "");
                }
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{leaveauto}',
            'buttons' => [
                'leaveauto' => [
                    'label' => 'Set Auto Leave',
                    //'imageUrl'=>Yii::app()->request->baseUrlCdn.'/images/icon/alpha.png',
                    'visible' => '$data->actualIn =="??:??" && $data->actualOut =="??:??" && !isset($data->syncLeave) ',
                    'url' => 'Yii::app()->createUrl("/m1/gLeave/autoLeave", array("id"=>$data->id))',
                    'options' => [
                        'ajax' => [
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
								$.fn.yiiGridView.update("cpersonalia-Attendance-grid", {
								data: $(this).serialize()});
							}',
                        ],
                        'class' => 'btn btn-xs btn-default',
                        //'style' => 'margin-left:3px;',
                    ],
                ],
            ],
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{reset}',
            'buttons' => [
                'reset' => [
                    'label' => 'Reset In/Out',
                    //'imageUrl'=>Yii::app()->request->baseUrlCdn.'/images/icon/alpha.png',
                    'url' => 'Yii::app()->createUrl("/m1/gAttendance/reset", array("id"=>$data->id))',
                    'options' => [
                        'ajax' => [
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
                                $.fn.yiiGridView.update("cpersonalia-Attendance-grid", {
                                data: $(this).serialize()});
                            }',
                        ],
                        'class' => 'btn btn-xs btn-default',
                        'style' => 'margin-left:3px;',
                    ],
                ],

            ],
        ],
        'notes'
        //'remark',
    ],
]);
?>

    <br/>

<?php
$this->renderPartial('_formAttendance', ['model' => $modelAttendance]);

