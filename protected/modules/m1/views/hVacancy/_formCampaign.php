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

<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'h-vacancy-sch-form',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'campaign_name'); ?>
<?php echo $form->textFieldGroup($model, 'start_date', ['widgetOptions' => ['htmlOptions' => ['value' => date("d-m-Y")]]]); ?>
<?php echo $form->textFieldGroup($model, 'end_date'); ?>
<?php echo $form->textAreaGroup($model, 'additional_info', ['widgetOptions' => ['htmlOptions' => ['rows' => 3]]]); ?>
<?php //echo $form->textFieldGroup($model,'status_id');  ?>

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
