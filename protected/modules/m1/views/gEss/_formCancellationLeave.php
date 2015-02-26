<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#" . CHtml::activeId($model, 'start_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#" . CHtml::activeId($model, 'end_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).mask('99-99-9999');
		$( \"#" . CHtml::activeId($model, 'start_date') . "\" ).mask('99-99-9999');
		$( \"#" . CHtml::activeId($model, 'end_date') . "\" ).mask('99-99-9999');
});
		");
?>

<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'g-cuti-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'input_date', ['widgetOptions' => [
    'htmlOptions' => ['disabled' => true, 'value' => date("d-m-Y")]
]]); ?>

<?php echo $form->textFieldGroup($model, 'start_date', ['hint' => 'Date when your leave cancelled']); ?>

<?php echo $form->textFieldGroup($model, 'end_date', ['hint' => 'Date when your cancelled leave ended']); ?>

<?php echo $form->numberFieldGroup($model, 'number_of_day', ['hint' => 'Total days of cancelled leaving', 'widgetOptions' => ['htmlOptions' => ['min' => 1]]]); ?>

<?php echo $form->textAreaGroup($model, 'leave_reason', ['rows' => 3]); ?>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?php
            $this->widget('booster.widgets.TbButton', [
                'buttonType' => 'submit',
                'context' => 'primary',
                'icon' => 'fa fa-check',
                'label' => $model->isNewRecord ? 'Create' : 'Save',
            ]);
            ?>
        </div>
    </div>

<?php
$this->endWidget();
