<style>
    .userautocompletelink {
        height: 52px;
    }

    .userautocompletelink img {
        float: left;
        margin-right: 5px;
        width: 40px;
    }

</style>

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
		$( \"#" . CHtml::activeId($model, 'number_of_day') . "\" ).mask('9?9');
						

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

<?php echo $form->textFieldGroup($model, 'start_date', ['label'=>'Start Date of Switchover Leave <span class="required">*</required>','widgetOptions' => [
    //'htmlOptions' => ['disabled' => true]
]]); ?>

<?php echo $form->textFieldGroup($model, 'end_date', ['label'=>'End Date of Switchover Leave <span class="required">*</required>','widgetOptions' => [
    //'htmlOptions' => ['disabled' => true]
]]); ?>

<?php echo $form->numberFieldGroup($model, 'number_of_day', ['hint' => 'Total days of switchover leave', 'widgetOptions' => ['htmlOptions' => ['min' => 0]]]); ?>

<?php echo $form->textAreaGroup($model, 'leave_reason', ['widgetOptions' => ['htmlOptions' => ['rows' => 4]]]); ?>


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

