<?php
$this->breadcrumbs = [
    'Print List Journal',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m2/tAccount']],
];
?>

<div class="page-header">
    <h1>
        Print List Journal
    </h1>
</div>

<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'allocation-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>


<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListGroup($model, 'account_no_id', tAccount::item(), ['class' => 'col-md-5']); ?>

<?php //echo $form->textFieldGroup($model, 'begindate'); ?>
<?php //echo $form->textFieldGroup($model, 'enddate'); ?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'begindate', ['class' => 'control-label']); ?>

    <div class="controls">

        <?php
        $this->widget('ext.EJuiMonthPicker.EJuiMonthPicker', [
            'model' => $model,
            'attribute' => 'begindate',
            'options' => [
                'yearRange' => '-5:+0',
                'dateFormat' => 'yymm',
            ],
            //'htmlOptions'=>array(
            //    'onChange'=>'js:doSomething()',
            //),
        ]);
        ?>
    </div>
</div>

<?php
echo $form->dropDownListGroup($model, 'type_report_id', [
    '1' => 'Summary Style',
    '2' => 'Detail Style',
]);

//echo $form->dropDownListGroup($model, 'post_id', sParameter::items("cStatus", 2));
?>

<div class="form-group">
    <?php echo CHtml::htmlButton('<i class="fa fa-check"></i>Report', ['class' => 'btn', 'type' => 'submit']); ?>
</div>

<?php $this->endWidget(); ?>
