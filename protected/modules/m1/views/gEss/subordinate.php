<?php
$this->renderPartial('_menuEss', ['model' => $model, 'month' => $month, 'year' => $year]);
?>


<div class="page-header">
    <h1>
        <i class="fa fa-user fa-fw"></i>
        <?php echo $model->employee_name; ?>
    </h1>
</div>

<?php
$leave = gLeave::searchCount($model->id) != 0 ? CHtml::tag("span", ['class' => 'badge badge-info'], gLeave::searchCount($model->id)) : "";
$permission = gPermission::searchCount($model->id) != 0 ? CHtml::tag("span", ['class' => 'badge badge-info'], gPermission::searchCount($model->id)) : "";
$attendance = gAttendance::searchCount($model->id) != 0 ? CHtml::tag("span", ['class' => 'badge badge-info'], gAttendance::searchCount($model->id)) : "";

$this->widget('booster.widgets.TbTabs', [
    'type' => 'tabs', // 'tabs' or 'pills'
    'id' => 'tabs',
    'encodeLabel' => false,
    'tabs' => [
        ['id' => 'tab3', 'label' => 'Attendance ' . $attendance, 'content' => $this->renderPartial("_subordinateAttendance", ["model" => $model, 'month' => $month], true), 'active' => true],
        ['id' => 'tab1', 'label' => 'Leave ' . $leave, 'content' => $this->renderPartial("_subordinateLeave", ["model" => $model], true)],
        ['id' => 'tab2', 'label' => 'Permission ' . $permission, 'content' => $this->renderPartial("_subordinatePermission", ["model" => $model], true)],
        ['id' => 'tab4', 'label' => 'Profile', 'content' => $this->renderPartial("/gPerson/_personalInfo2", ["model" => $model, 'month' => $month], true)],
        ['id' => 'tab5', 'label' => 'Career-Experience-Status', 'content' => $this->renderPartial("/gPersonHolding/_mainCareerExperienceStatus", ["model" => $model], true)],
    ],
]);
?>
