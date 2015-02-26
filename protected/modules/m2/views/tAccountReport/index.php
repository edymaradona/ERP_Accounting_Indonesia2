<?php
Yii::app()->getClientScript()->registerCoreScript('maskedinput');

Yii::app()->clientScript->registerScript('periode_date', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'periode_date') . "\" ).mask('999999');
});

		");
?>


<?php
$this->breadcrumbs = [
    'Account Report',
];
?>

<div class="page-header">
    <h1>
        Accounting Report
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
    <?php echo $form->labelEx($model, 'periode_date', ['class' => 'control-label']); ?>

    <div class="controls">

        <?php
        $this->widget('ext.EJuiMonthPicker.EJuiMonthPicker', [
            'model' => $model,
            'attribute' => 'periode_date',
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

<?php echo $form->dropDownListGroup($model, 'report_id', tAccountReport::accountReportList()); ?>

<div class="form-group">
    <?php echo CHtml::htmlButton('<i class="icon-fa-print"></i>Report', ['class' => 'btn', 'type' => 'submit']); ?>
</div>

<?php $this->endWidget(); ?>

