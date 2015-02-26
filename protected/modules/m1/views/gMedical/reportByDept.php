<?php
$this->breadcrumbs = [
    'Recruitment Report',
];

$this->menu4 = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gAttendance']],
    ['label' => 'Medical Calendar', 'icon' => 'calendar', 'url' => ['/m1/gMedical/medicalCalendar']],
];

$this->menu = [
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

$this->menu1 = [
    ['label' => 'Report to Insurance/Finance', 'icon' => 'print', 'url' => ['/m1/gMedical/weeklyReport']],
    ['label' => 'Medical Reports', 'icon' => 'print', 'url' => ['/m1/gMedical/reportByDept']],
];

?>

    <div class="page-header">

        <h1>
            <i class="fa fa-suitcase fa-fw"></i>
            Medical Report
        </h1>

    </div>



<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'allocation-form',
    'enableAjaxValidation' => false, 'type' => 'horizontal',
]);
?>


<?php echo $form->errorSummary($model); ?>


<?php
echo $form->dropDownListGroup($model, 'report_id', ['widgetOptions' => [
    'data' => [
        '1' => '1. Medical Report by Dept',
    ]
]]);
?>

    <div class="form-group">
        <?php echo CHtml::htmlButton('<i class="fa fa-print fa-fw"></i>Report', ['class' => 'btn', 'type' => 'submit']); ?>
    </div>


<?php
$this->endWidget();

