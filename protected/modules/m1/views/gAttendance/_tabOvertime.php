<?php

$this->widget('booster.widgets.TbGridView', [
    'id' => 'cpersonalia-overtime-grid',
    'dataProvider' => gAttendance::model()->searchOvertime((int)$model->id, $month),
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}{summary}',
    //'filter'=>$model,
    'columns' => [
        /*        array(
          'header' => 'Permission',
          'class' => 'EJuiDlgsColumn',
          'template' => '{update}',
          'updateDialog' => array(
          'controllerRoute' => '/m1/gAttendance/updateAttendance',
          //'imageUrl'=>Yii::app()->request->baseUrlCdn.'/images/icon/ijin.png',
          'actionParams' => array('id' => '$data->id'),
          'dialogTitle' => 'Update Attendance',
          'dialogWidth' => 800, //override the value from the dialog config
          'dialogHeight' => 530
          ),
          ),
         */
        [
            'name' => 'cdate',
            'value' => '$data->cdate',
        ],
        [
            'header' => 'Pattern',
            'type' => 'raw',
            'value' => function ($data1) {
                    return
                        CHtml::tag('div', [], $data1->realpattern->code)
                        . CHtml::tag('div', [], peterFunc::toTime($data1->realpattern->in) . " - " . peterFunc::toTime($data1->realpattern->out));
                }
        ],
        [
            'name' => 'in',
            'type' => 'raw',
            'value' => function ($data3) {
                    return
                        (peterFunc::isTimeMore($data3->in, $data3->realpattern->in)) ?
                            CHtml::tag('div', ['style' => 'color: red;'], $data3->actualIn)
                            . CHtml::tag('div', ['style' => 'color: red;'], $data3->lateInStatus) : $data3->actualIn;
                }
        ],
        [
            'name' => 'out',
            'type' => 'raw',
            'value' => function ($data2) {
                    return
                        (peterFunc::isTimeMore($data2->realpattern->out, $data2->out)) ?
                            CHtml::tag('div', ['style' => 'color: red;'], $data2->actualOut)
                            . CHtml::tag('div', ['style' => 'color: red;'], $data2->earlyOutStatus) : $data2->actualOut;
                }
        ],
        [
            'header' => 'Hour Overtime In',
            'name' => 'overtimeIn',
        ],
        [
            'header' => 'Hour Overtime Out',
            'name' => 'overtimeOut',
        ],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'header' => 'Total Hour Overtime In',
            'name' => 'overtime_in',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gAttendance/updateAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-1'
            ]],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'header' => 'Total Hour Overtime Out',
            'name' => 'overtime_out',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gAttendance/updateAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-1'
            ]],
        [
            'class' => 'booster.widgets.TbEditableColumn',
            'name' => 'remark',
            'sortable' => false,
            'editable' => [
                'url' => $this->createUrl('/m1/gAttendance/updateAjax'),
                //'placement' => 'right',
                'inputclass' => 'col-md-2'
            ]],
    ],
]);


