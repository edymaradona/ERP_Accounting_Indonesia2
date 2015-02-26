<?php
$this->breadcrumbs = [
    'G people' => ['index'],
    $model->id,
];

$this->menu4 = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gPermission']],
    ['label' => 'Link to', 'icon' => 'user', 'items' => [
        ['label' => 'Link to Person', 'icon' => 'user', 'url' => ['/m1/gPerson/view', 'id' => $model->id]],
        ['label' => 'Link to Leave', 'icon' => 'plane', 'url' => ['/m1/gLeave/view', 'id' => $model->id]],
        ['label' => 'Link to Attendance', 'icon' => 'bell', 'url' => ['/m1/gAttendance/view', 'id' => $model->id]],
        ['label' => 'Link to Medical', 'icon' => 'hospital-o', 'url' => ['/m1/gMedical/view', 'id' => $model->id]],
        ['label' => 'Link to Performance', 'icon' => 'fire', 'url' => ['/m1/gPerformance/view', 'id' => $model->id]],
    ]],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

$this->menu = [
    //array('label'=>'Print Summary', 'icon'=>'print', 'url'=>array('/m1/gEss/summaryPermission',"pid"=>$model->id)),
];

//$this->menu1=gPermission::getTopUpdated();
//$this->menu2=gPermission::getTopCreated();
$this->menu5 = ['Permission'];
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



<?php
$this->widget('booster.widgets.TbTabs', [
    'type' => 'tabs', // 'tabs' or 'pills'
    'tabs' => [
        ['label' => 'Permission History', 'content' => $this->renderPartial("_tabList", ["model" => $model], true), 'active' => true],
        ['label' => 'Profile', 'content' => $this->renderPartial("/gPerson/_personalInfo2", ["model" => $model], true)],
    ],
]);

