<?php
$this->breadcrumbs = [
    'G people',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gAttendance']],
    ['label' => 'Schedule Upload', 'icon' => 'calendar', 'url' => ['timeBlock']],
    ['label' => 'Attendant Upload', 'icon' => 'user', 'url' => ['attendBlock']],
    ['label' => 'View By Date', 'icon' => 'home', 'url' => ['/m1/gAttendance/viewByDate']],
    //['label' => 'Change Shift List', 'icon' => 'info-sign', 'url' => ['listchange']],
    ['label' => 'Parameter Time Block', 'icon' => 'wrench', 'url' => ['paramTimeblock']],
    ['label' => 'Rekap by Dept', 'icon' => 'print', 'url' => ['/m1/gAttendance/reportByDept']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

$this->menu1 = gAttendance::getTopUpdated();
$this->menu2 = gAttendance::getTopCreated();

$this->menu7 = aOrganization::compDeptAttendanceFilter();

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gAttendance/index')];

$this->menu10 = [
    ['label' => 'Rekap by Dept', 'icon' => 'print', 'url' => ['/m1/gAttendance/reportByDept']],
];
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-key fa-fw"></i>
            Attendance
        </h1>
    </div>


<?php
$this->widget('booster.widgets.TbListView', [
    'dataProvider' => $dataProvider,
    'itemView' => '/gPerson/_view',
]);
