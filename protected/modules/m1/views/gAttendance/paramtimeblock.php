<?php
$this->breadcrumbs = [
    'G people',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gAttendance']],
    ['label' => 'Schedule Upload', 'icon' => 'calendar', 'url' => ['timeBlock']],
    ['label' => 'Attendant Upload', 'icon' => 'user', 'url' => ['attendBlock']],
    ['label' => 'View By Date', 'icon' => 'home', 'url' => ['/m1/gAttendance/viewByDate']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

$this->menu1 = gPerson::getTopUpdated();
$this->menu2 = gPerson::getTopCreated();

?>

    <div class="page-header">
        <h1>
            <i class="fa fa-key fa-fw"></i>
            Param Time Block
        </h1>
    </div>



<?php
$this->widget('TbGridView', [
    'id' => 'g-param-timeblock-grid',
    'dataProvider' => gParamTimeblock::model()->search(),
    //'filter'=>$model,
    'columns' => [
        'id',
        'code',
        [
            'name' => 'in',
            //'value' => 'peterFunc::toTime($data->in)',
        ],
        [
            'name' => 'out',
            //'value' => 'peterFunc::toTime($data->out)',
        ],
        [
            'name' => 'rest_in',
            'value' => 'peterFunc::toTime($data->rest_in)',
        ],
        [
            'name' => 'rest_out',
            'value' => 'peterFunc::toTime($data->rest_out)',
        ],
        'remark',
        [
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("/m1/gAttendance/deleteParamTimeblock",array("id"=>$data->id))',
            'updateDialog' => [
                'controllerRoute' => 'm1/gAttendance/updateParamTimeblock',
                'actionParams' => ['id' => '$data->id'],
                'dialogTitle' => 'Update Param Time Block',
                'dialogWidth' => 800, //override the value from the dialog config
                'dialogHeight' => 530
            ],
        ],
        //array(
        //	'class'=>'TbButtonColumn',
        //	'template'=>'{delete}{update}',
        //	'deleteButtonUrl'=>'Yii::app()->createUrl("/m1/gHrParameter/deleteParamTimeblock",array("id"=>$data->id))',
        //),
    ],
]);
?>

    <div class="page-header">
        <h3>New Param Time Block</h3>
    </div>

<?php
echo $this->renderPartial('_formParamTimeblock', ['model' => $model]);
