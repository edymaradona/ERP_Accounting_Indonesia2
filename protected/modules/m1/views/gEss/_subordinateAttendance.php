<br/>

<?php

$attendanceMonth = gAttendance::searchCountMonth($model->id, $month) != 0 ? CHtml::tag("span", ['class' => 'badge badge-info'], gAttendance::searchCountMonth($model->id, $month)) : "";
$attendanceMonthPrev = gAttendance::searchCountMonth($model->id, $month - 1) != 0 ? CHtml::tag("span", ['class' => 'badge badge-info'], gAttendance::searchCountMonth($model->id, $month - 1)) : "";
$attendanceMonthNext = gAttendance::searchCountMonth($model->id, $month + 1) != 0 ? CHtml::tag("span", ['class' => 'badge badge-info'], gAttendance::searchCountMonth($model->id, $month + 1)) : "";

$this->widget('booster.widgets.TbTabs', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'encodeLabel' => false,
    'tabs' => [
        ['label' => '<< Previous Month ' . " " . $attendanceMonthPrev, 'url' => Yii::app()->createUrl("/m1/gEss/subordinate", ["id" => $model->id, "month" => $month - 1])],
        ['label' => date("Ym", strtotime(date("Y-m", strtotime($month . " month")) . "-01")) . " " . $attendanceMonth,
            'url' => Yii::app()->createUrl("//m1/gEss/subordinate", ["id" => $model->id, "month" => $month])],
        ['label' => 'Next Month >> ' . " " . $attendanceMonthNext, 'visible' => ($month != 0), 'url' => Yii::app()->createUrl("/m1/gEss/subordinate", ["id" => $model->id, "month" => $month + 1])],
    ],
    'htmlOptions' => [
    ]
]);
?>

<br/>

<?php

$this->widget('booster.widgets.TbGridView', [
    'id' => 'cpersonalia-Attendance-grid',
    'dataProvider' => gAttendance::model()->search((int)$model->id, $month),
    'itemsCssClass' => 'table table-striped table-bordered table-condensed',
    'template' => '{summary}{items}{pager}',
    //'filter'=>$model,
    'columns' => [
        [
            'name' => 'cdate',
            'type' => 'raw',
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
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'realpattern_id',
            //we need not to set value, it will be auto-taken from source
            // 'headerHtmlOptions' => array('style' => 'width: 60px'),
            'editable' => [
                'type' => 'select2',
                'url' => $this->createUrl('/m1/gEss/updateAttendanceAjax'),
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
                        . CHtml::tag('div', [], ($data->approved_id > 0) ? "#A# " . $data->changepattern->code . ". " . $data->remark . " "
                            . CHtml::tag("span", ['class' => 'badge badge-info'], $data->superior_approved->name)
                            . CHtml::tag("span", ['class' => 'badge badge-info'], $data->approved->name) : "");
                }
        ],
        [
            'class' => 'TbButtonColumn',
            'template' => '{approved}',
            'buttons' => [
                'approved' => [
                    'label' => 'Approved',
                    'url' => 'Yii::app()->createUrl("/m1/gEss/attendanceSuperiorApproved",array("id"=>$data->id,"pid"=>$data->person->id))',
                    'visible' => '$data->superior_approved_id ==1',
                    'options' => [
                        'ajax' => [
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
														$.fn.yiiGridView.update("cpersonalia-Attendance-grid", {
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
                    'url' => 'Yii::app()->createUrl("/m1/gEss/attendanceSuperiorRejected",array("id"=>$data->id,"pid"=>$data->person->id))',
                    'visible' => '$data->superior_approved_id ==1',
                    'options' => [
                        'ajax' => [
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
														$.fn.yiiGridView.update("cpersonalia-Attendance-grid", {
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
?>

