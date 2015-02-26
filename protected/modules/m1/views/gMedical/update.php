<?php
$this->breadcrumbs = [
    'G Cutis' => ['index'],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];

$this->menu4 = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gMedical']],
    ['label' => 'Medical Calendar', 'icon' => 'calendar', 'url' => ['/m1/gMedical/medicalCalendar']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

$this->menu1 = [
    ['label' => 'Report to Insurance/Finance', 'icon' => 'print', 'url' => ['/m1/gMedical/weeklyReport']],
    ['label' => 'Medical Reports', 'icon' => 'print', 'url' => ['/m1/gMedical/reportByDept']],
];

$this->menu5 = ['Medical'];

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gMedical/list')];

?>

    <div class="page-header">
        <h1>
            <i class="fa fa-medkit fa-fw"></i>
            Update:
            <?php echo $model->person->employee_name; ?>
        </h1>
    </div>



<?php
echo $this->renderPartial('_formUpdate', ['model' => $model]);
