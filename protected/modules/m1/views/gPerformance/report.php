<?php
$this->breadcrumbs = [
    'Recruitment Report',
];

$this->menu4 = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gPerformance']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

$this->menu = [
    //array('label'=>'Report', 'icon'=>'print', 'url'=>array('report')),
];
?>

    <div class="page-header">

        <h1>
            <i class="fa fa-suitcase"></i>
            Performance Report
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
        //'1' => '1. High Flyer Report',
        '2' => '2. Rekapitulasi Performance Appraisal',
        //'3'=>'3. Summary HR Interview Report',
        //'4'=>'4. Summary User Interview Report',
        //'5'=>'5. Summary Candidate Source Report',
        //'6'=>'6. Report 6',
    ]
]]);
?>

<?php echo $form->dropDownListGroup($model, 'level_id', ['widgetOptions' => [
    'data' => gParamLevel::model()->levelDropDown("all")
]]); ?>

<?php echo $form->numberFieldGroup($model, 'year', ['min' => 0]); ?>

<?php
echo $form->dropDownListGroup($model, 'period', ['widgetOptions' => [
    'data' => [
        '1' => 'January - June (Semester I)',
        '2' => 'January - December (Full Year)',
    ]
]]);
?>

<div class="row">
    <div class="col-md-12">

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <?php echo CHtml::htmlButton('<i class="fa fa-print fa-fw"></i>Export to Excel', ['class' => 'btn', 'type' => 'submit']); ?>
            </div>
        </div>
    </div>
</div>


<?php
$this->endWidget();

