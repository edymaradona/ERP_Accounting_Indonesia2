<?php
$this->breadcrumbs = [
    'G people' => ['index'],
    $model->id,
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gAttendance']],
    ['label' => 'Schedule Upload', 'icon' => 'calendar', 'url' => ['timeBlock']],
    ['label' => 'Attendant Upload', 'icon' => 'user', 'url' => ['attendBlock']],
    ['label' => 'View By Date', 'icon' => 'home', 'url' => ['/m1/gAttendance/viewByDate']],
    ['label' => 'Parameter Time Block', 'icon' => 'wrench', 'url' => ['paramTimeblock']],
    ['label' => 'Print', 'icon' => 'print', 'url' => ['/m1/gAttendance/printDetail', 'id' => $model->id, 'month' => $month]],
    ['label' => 'Link to', 'icon' => 'user', 'items' => [
        ['label' => 'Link to Person', 'icon' => 'user', 'url' => ['/m1/gPerson/view', 'id' => $model->id]],
        ['label' => 'Link to Leave', 'icon' => 'plane', 'url' => ['/m1/gLeave/view', 'id' => $model->id]],
        ['label' => 'Link to Permission', 'icon' => 'hand-o-up', 'url' => ['/m1/gPermission/view', 'id' => $model->id]],
        ['label' => 'Link to Medical', 'icon' => 'hospital-o', 'url' => ['/m1/gMedical/view', 'id' => $model->id]],
        ['label' => 'Link to Performance', 'icon' => 'fire', 'url' => ['/m1/gPerformance/view', 'id' => $model->id]],
    ]],
    ['label' => 'Rekap by Dept', 'icon' => 'print', 'url' => ['/m1/gAttendance/reportByDept']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];


$this->menu1 = gAttendance::getTopUpdated();
$this->menu2 = gAttendance::getTopCreated();

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gAttendance/index')];
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-key fa-fw"></i>
            <?php echo $model->employee_name; ?>
        </h1>
    </div>


<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'tabs' => [
        ['label' => '<< Previous Month', 'url' => Yii::app()->createUrl("/m1/gAttendance/view", ["id" => $model->id, "month" => $month - 1])],
        ['label' => date("Ym", strtotime(date("Y-m", strtotime($month . " month")) . "-01")),
            'url' => Yii::app()->createUrl("/m1/gAttendance/view", ["id" => $model->id, "month" => $month])],
        ['label' => 'Next Month >>', 'url' => Yii::app()->createUrl("/m1/gAttendance/view", ["id" => $model->id, "month" => $month + 1])],
    ],
    'htmlOptions' => [
    ]
]);
?>

    <br/>

<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'tabs', // 'tabs' or 'pills'
    'tabs' => [
        ['label' => 'Attendance', 'content' => $this->renderPartial("_tabAttendance", ["model" => $model, "modelAttendance" => $modelAttendance, "month" => $month], true), 'active' => true],
        ['label' => 'Over Time', 'content' => $this->renderPartial("_tabOvertime", ["model" => $model, "month" => $month], true)],
        //array('label' => 'Leave / Permission', 'content' => $this->renderPartial("_tabLeavePermission", array("model" => $model, "modelAttendance" => $modelAttendance, "month" => $month), true)),
        ['label' => 'Detail', 'content' => $this->renderPartial("/gPerson/_personalInfo2", ["model" => $model], true),],
    ],
]);


