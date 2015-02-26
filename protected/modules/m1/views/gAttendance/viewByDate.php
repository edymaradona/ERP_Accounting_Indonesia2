<?php
$this->breadcrumbs = [
    'G people' => ['index'],
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gAttendance']],
    ['label' => 'Schedule Upload', 'icon' => 'calendar', 'url' => ['timeBlock']],
    ['label' => 'Attendant Upload', 'icon' => 'user', 'url' => ['attendBlock']],
    ['label' => 'View By Date', 'icon' => 'home', 'url' => ['/m1/gAttendance/viewByDate']],
    ['label' => 'Parameter Time Block', 'icon' => 'wrench', 'url' => ['paramTimeblock']],
    ['label' => 'Print', 'icon' => 'print', 'url' => ['/m1/gAttendance/printDetail']],
    ['label' => 'Link to', 'icon' => 'user', 'items' => [
        ['label' => 'Link to Person', 'icon' => 'user', 'url' => ['/m1/gPerson/view']],
        ['label' => 'Link to Leave', 'icon' => 'plane', 'url' => ['/m1/gLeave/view']],
        ['label' => 'Link to Permission', 'icon' => 'hand-o-up', 'url' => ['/m1/gPermission/view']],
        ['label' => 'Link to Medical', 'icon' => 'hospital-o', 'url' => ['/m1/gMedical/view']],
        ['label' => 'Link to Performance', 'icon' => 'fire', 'url' => ['/m1/gPerformance/view']],
    ]],
    ['label' => 'Rekap by Dept', 'icon' => 'print', 'url' => ['/m1/gAttendance/reportByDept']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];


$this->menu1 = gAttendance::getTopUpdated();
$this->menu2 = gAttendance::getTopCreated();

//$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gAttendance/index')];
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-key fa-fw"></i>
            <?php echo date("Y-m-d", strtotime($day ." day")) ?>
        </h1>
    </div>


<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'tabs' => [
        ['label' => '<< Previous Date', 'url' => Yii::app()->createUrl("/m1/gAttendance/viewByDate", ['day'=>$day - 1])],
        ['label' => 'Date: '.date("Y-m-d", strtotime($day ." day")),
            'url' => Yii::app()->createUrl("/m1/gAttendance/viewByDate", [])],
        ['label' => 'Next Date >>', 'url' => Yii::app()->createUrl("/m1/gAttendance/viewByDate", ['day'=>$day + 1])],
    ],
    'htmlOptions' => [
    ]
]);
?>

<br/>

<?php
Yii::app()->clientScript->registerScript('sel_status', "
        $('#selStatus').change(function() {
            //alert(this.value);
            $.fn.yiiGridView.update('cpersonalia-Attendance-grid', {
                    data: $(this).serialize()
            });            
            return false;
        });
    ");

$data = CHtml::listData(aOrganization::model()->compDeptGroup(), 'department_id', 'Department');

$department_id = key($data);

echo CHtml::dropDownList(
    'dropDownStatus',
    $department_id,
    aOrganization::model()->compDeptGroup(),
    [
        'style' => 'margin-bottom:10px;',
        'id' => 'selStatus',
        'class' => 'form-control',
    ]
);
?>

<?php
$this->widget('booster.widgets.TbGridView', [
    'id' => 'cpersonalia-Attendance-grid',
    'dataProvider' => gAttendance::model()->searchByDate($day,$department_id),
    'itemsCssClass' => 'table table-bordered table-condensed',
    'template' => '{summary}{items}{pager}',
    //( $row%2 ? $this->rowCssClass[1] : $this->rowCssClass[0] ) .
    'rowCssClassExpression' => '
        ( ($data->realpattern_id == 90) ? "" : "info" )
    ',
    //'filter'=>$model,
    'columns' => [
        [
            'header' => 'Employee Name',
            'value' => '$data->person->employee_name',
        ],
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





