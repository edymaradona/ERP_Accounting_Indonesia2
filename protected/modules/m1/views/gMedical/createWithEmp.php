<?php
$this->breadcrumbs = [
    'G Cutis' => ['index'],
    'Create',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gMedical']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

$this->menu1 = [
    ['label' => 'Report to Insurance/Finance', 'icon' => 'print', 'url' => ['/m1/gMedical/weeklyReport']],
    ['label' => 'Medical Reports', 'icon' => 'print', 'url' => ['/m1/gMedical/reportByDept']],
];

?>

    <div class="page-header">
        <h1>
            <i class="fa fa-medkit fa-fw"></i>
            Create Medical
        </h1>
    </div>


<?php
echo $this->renderPartial('_formWithEmp', ['model' => $model]);
