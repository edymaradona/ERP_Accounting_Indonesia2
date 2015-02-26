<?php
/* @var $this SCompanyNewsController */
/* @var $model SCompanyNews */
/* @var $form CActiveForm */
?>

<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker2', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'iom_date') . "\" ).datepicker({
			'dateFormat' : 'dd-mm-yy',
		});
                            
                });

		");
?>


<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'sNotification-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'iom_number', ['class' => 'col-md-7', 'disabled' => true]); ?>

<?php echo $form->textFieldGroup($model, 'iom_to', ['class' => 'col-md-7']); ?>

<?php echo $form->textFieldGroup($model, 'iom_cc', ['class' => 'col-md-7']); ?>

<?php echo $form->textFieldGroup($model, 'iom_from', ['class' => 'col-md-7']); ?>

<?php echo $form->textFieldGroup($model, 'subject', ['class' => 'col-md-7']); ?>

<?php echo $form->textFieldGroup($model, 'attachment', ['class' => 'col-md-7']); ?>

<?php echo $form->textFieldGroup($model, 'iom_date'); ?>

<?php
//echo $form->html5EditorRow($model, 'content', [
//    'htmlOptions' => ['class' => 'col-md-4', 'rows' => 5, 'height' => '300']]);
echo $form->redactorGroup($model, 'content', [], ['class' => 'col-md-4', 'rows' => 15]);
?>

<?php echo $form->textFieldGroup($model, 'sender_by', ['class' => 'col-md-7']); ?>

<?php echo $form->textFieldGroup($model, 'sender_title', ['class' => 'col-md-7']); ?>

<?php echo $form->textFieldGroup($model, 'approved_by', ['class' => 'col-md-7']); ?>

<?php echo $form->textFieldGroup($model, 'approved_title', ['class' => 'col-md-7']); ?>



<div class="control-group">
    <?php
    $this->widget('booster.widgets.TbButton', [
        'buttonType' => 'submit',
        // 'type' => 'primary',
        'icon' => 'fa fa-check',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    ]);
    ?>
</div>


<?php $this->endWidget(); ?>
