<?php
$this->breadcrumbs = [
    'Recruitment Report',
];

$this->menu4 = [
];

$this->menu = [
    //array('label'=>'Report', 'icon'=>'print', 'url'=>array('report')),
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gAttendance']],
    ['label' => 'View By Date', 'icon' => 'home', 'url' => ['/m1/gAttendance/viewByDate']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];
?>

    <div class="page-header">

        <h1>
            <i class="fa fa-suitcase fa-fw"></i>
            Attendance Report
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


    <div class="form-group">
        <?php echo $form->labelEx($model, 'period', ['class' => 'col-sm-3 control-label']); ?>
        <div class="col-sm-3 ">

            <?php
            $this->widget('ext.EJuiMonthPicker.EJuiMonthPicker', [
                'model' => $model,
                'attribute' => 'period',
                'options' => [
                    'yearRange' => '-5:+0',
                    'dateFormat' => 'yymm',
                ],
                'htmlOptions' => [
                    'value' => date('Ym'),
                    'class' => 'form-control'
                ],
                //'htmlOptions'=>array(
                //    'onChange'=>'js:doSomething()',
                //),
            ]);
            ?>
        </div>
    </div>

<?php
echo $form->dropDownListGroup($model, 'report_id', ['widgetOptions' => [
    'data' => [
        '1' => '1. Attendance Report by Dept',
        '2' => '2. Attendance Report By Dept (Detail) | **ON PROGRESS**',
    ],
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

