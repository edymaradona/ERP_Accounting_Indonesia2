<?php
$this->breadcrumbs = [
    'Loan Report',
];

$this->menu4 = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gLoan']],
];

$this->menu = [
    //array('label'=>'Report', 'icon'=>'print', 'url'=>array('report')),
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];
?>

    <div class="page-header">

        <h1>
            <i class="fa fa-suitcase fa-fw"></i>
            Loan Report
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
        <?php echo $form->labelEx($model, 'period', ['class' => 'col-sm-3 control-label']); ?>

        <div class="col-sm-9">

            <?php
            $this->widget('ext.EJuiMonthPicker.EJuiMonthPicker', [
                'model' => $model,
                'attribute' => 'period',
                'options' => [
                    'yearRange' => '-5:+0',
                    'dateFormat' => 'yymm',
                ],
                'htmlOptions' => [
                    'class' => 'form-control'
                ]
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
        '1' => '1. Loan Type Report by Dept',
    ]
]]);
?>

    <div class="form-group">
        <?php echo CHtml::htmlButton('<i class="fa fa-print fa-fw"></i>Report', ['class' => 'btn', 'type' => 'submit']); ?>
    </div>


<?php
$this->endWidget();

