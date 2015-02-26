<?php
$this->breadcrumbs = [
    'G people' => ['index'],
    $model->id,
];

$this->menu4 = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gMedical']],
    ['label' => 'Link to', 'icon' => 'user', 'items' => [
        ['label' => 'Link to Person', 'icon' => 'user', 'url' => ['/m1/gPerson/view', 'id' => $model->id]],
        ['label' => 'Link to Leave', 'icon' => 'plane', 'url' => ['/m1/gLeave/view', 'id' => $model->id]],
        ['label' => 'Link to Permission', 'icon' => 'hand-o-up', 'url' => ['/m1/gPermission/view', 'id' => $model->id]],
        ['label' => 'Link to Attendance', 'icon' => 'bell', 'url' => ['/m1/gAttendance/view', 'id' => $model->id]],
        ['label' => 'Link to Performance', 'icon' => 'fire', 'url' => ['/m1/gPerformance/view', 'id' => $model->id]],
    ]],
    ['label' => 'Medical Calendar', 'icon' => 'calendar', 'url' => ['/m1/gMedical/medicalCalendar']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

$this->menu1 = [
    ['label' => 'Report to Insurance/Finance', 'icon' => 'print', 'url' => ['/m1/gMedical/weeklyReport']],
    ['label' => 'Medical Reports', 'icon' => 'print', 'url' => ['/m1/gMedical/reportByDept']],
];

//$this->menu1=gMedical::getTopUpdated();
//$this->menu2=gMedical::getTopCreated();
$this->menu5 = ['Medical'];

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gMedical/list')];

?>

    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1>
                    <i class="fa fa-medkit fa-fw"></i>
                    <?php echo $model->employee_name; ?>
                </h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <?php
            echo $this->renderPartial("/gMedical/_medicalBalance", ["model" => $model], true);
            ?>
        </div>
    </div>


<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'tabs', // 'tabs' or 'pills'
    'tabs' => [
        ['label' => 'Medical History', 'content' => $this->renderPartial("_tabList", ["model" => $model], true), 'active' => true],
        ['label' => 'Profile', 'content' => $this->renderPartial("/gPerson/_personalInfo2", ["model" => $model], true)],
    ],
]);

