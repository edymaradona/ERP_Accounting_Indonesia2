<?php

Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker2', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'start_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		});
		$( \"#" . CHtml::activeId($model, 'end_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		});
			
});

		");
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'start_date', ['value' => date("d-m-Y")]); ?>

<?php echo $form->textFieldGroup($model, 'end_date'); ?>

<?php echo $form->dropDownListGroup($model, 'status_id', ['widgetOptions' => [
    'data' => sParameter::items('AK')
]]); ?>

<?php

echo $form->textAreaGroup($model, 'remark', ['widgetOptions' => ['htmlOptions' => ['rows' => 3]]]);
