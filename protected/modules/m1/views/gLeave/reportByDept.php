<?php
$this->breadcrumbs = [
    'Recruitment Report',
];

$this->menu4 = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gLeave']],
    ['icon' => 'calendar', 'label' => 'Leave Calendar', 'url' => ['/m1/gLeave/leaveCalendar']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

$this->menu = [
    //array('label'=>'Report', 'icon'=>'print', 'url'=>array('report')),
];


?>

    <div class="page-header">

        <h1>
            <i class="fa fa-suitcase"></i>
            Periodic Leave Reports By Departments
        </h1>

    </div>



<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'allocation-form',
    'enableAjaxValidation' => false, 'type' => 'horizontal',
]);
?>


<?php echo $form->errorSummary($model); ?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'company_id', ["class" => "col-sm-3 control-label"]); ?>
    <div class="col-sm-9">
        <?php
        echo $form->dropDownList($model, 'company_id', sUser::model()->getMyGroupArrayName(), [
            'class' => 'form-control'
        ]);
        ?>
    </div>
</div>

<?php
echo $form->dropDownListGroup($model, 'report_id', ['widgetOptions' => [
    'data' => [
        '1' => '1. Leave Balance by Dept',
        '2' => '2. Employee Leave by Month',
        //'3'=>'3. Summary HR Interview Report',
        //'4'=>'4. Summary User Interview Report',
        //'5'=>'5. Summary Candidate Source Report',
        //'6'=>'6. Report 6',
    ]
]]);
?>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?php
            $this->widget('booster.widgets.TbButton', [
                'buttonType' => 'submit',
                'context' => 'primary',
                'icon' => 'fa fa-check',
                'label' => 'Report',
            ]);
            ?>
        </div>
    </div>


<?php
$this->endWidget();

