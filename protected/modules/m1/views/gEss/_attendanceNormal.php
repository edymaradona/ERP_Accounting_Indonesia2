<br/>

<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'pills',
    'justified' => true,
    'tabs' => [
        ['label' => '<< Previous Month', 'url' => Yii::app()->createUrl("/m1/gEss/attendance", ["id" => $model->id, "month" => $month - 1])],
        ['label' => date("Ym", strtotime(date("Y-m", strtotime($month . " month")) . "-01")),
            'url' => Yii::app()->createUrl("/m1/gEss/attendance", ["id" => $model->id, "month" => $month])],
        ['label' => 'Next Month >>',
            'url' => Yii::app()->createUrl("/m1/gEss/attendance", ["id" => $model->id, "month" => $month + 1]),
            'itemOptions' => ($month == 0) ? ['class' => 'disabled'] : ['class' => '']
        ],
    ],
]);
?>


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
            'header' => 'Pattern',
            'type' => 'raw',
            'value' => function ($data1) {
                    return
                        CHtml::tag('div', [], (isset($data1->realpattern)) ? $data1->realpattern->code : "")
                        . CHtml::tag('div', ['style' => 'font-size: 11px;'], peterFunc::toTime($data1->realpattern->in) . " - " . peterFunc::toTime($data1->realpattern->out));
                }
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
                        (peterFunc::isTimeMore($data2->realpattern->out, $data2->out)) ?
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
            'template' => '{permission}{attendance}{mydelete}{printchange}',
            'buttons' => [
                'permission' => [
                    'label' => 'Set Permission',
                    //'imageUrl'=>Yii::app()->request->baseUrlCdn.'/images/icon/alpha.png',
                    'url' => 'Yii::app()->createUrl("/m1/gEss/createPermission", array("id"=>$data->id))',
                    'options' => [
                        /* 'ajax' => array(
                          'type' => 'GET',
                          'url' => "js:$(this).attr('href')",
                          'success' => 'js:function(data){
                          $.fn.yiiGridView.update("g-permission-grid", {
                          data: $(this).serialize()});
                          }',
                          ), */
                        'class' => 'btn btn-xs btn-default',
                        'style' => 'margin-bottom:3px;',
                    ],
                    'visible' => '$data->realpattern_id !=90',
                ],
                'attendance' => [
                    'label' => 'Change Schedule',
                    //'imageUrl'=>Yii::app()->request->baseUrlCdn.'/images/icon/alpha.png',
                    'url' => 'Yii::app()->createUrl("/m1/gEss/changeAttendance", array("id"=>$data->id))',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                        //'style' => 'margin-left:3px;',
                    ],
                    'visible' => '($data->approved_id == 0 || $data->approved_id == 2)'
                ],
                'mydelete' => [
                    'label' => 'Delete',
                    //'imageUrl'=>Yii::app()->request->baseUrlCdn.'/images/icon/alpha.png',
                    'url' => 'Yii::app()->createUrl("/m1/gEss/changeAttendanceDelete", array("id"=>$data->id))',
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
                        'style' => 'margin-bottom:2px;',
                    ],
                    'visible' => '($data->approved_id == 1 || $data->approved_id == 3)'
                ],
                'printchange' => [
                    'label' => 'Print',
                    //'imageUrl'=>Yii::app()->request->baseUrlCdn.'/images/icon/alpha.png',
                    'url' => 'Yii::app()->createUrl("/m1/gEss/changeAttendancePrint", array("id"=>$data->id))',
                    'options' => [
                        'class' => 'btn btn-xs btn-default',
                        //'style' => 'margin-left:3px;',
                    ],
                    'visible' => '($data->approved_id == 1)'
                ],
            ],
        ],
        //'remark'
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'notes',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gEss/updateAttendanceAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-2'
            ]],
    ],
]);
?>


