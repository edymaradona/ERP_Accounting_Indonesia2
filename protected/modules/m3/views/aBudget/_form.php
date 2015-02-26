<?php

$form = $this->beginWidget('booster.widgets.TbActiveForm', ['id' => 'abudget-form',
    'enableAjaxValidation' => false,
]);
?>
<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model, 'parent_id', ['size' => 11, 'maxlength' => 11]); ?>
<?php echo $form->textFieldRow($model, 'year'); ?>

<?php echo $form->textFieldRow($model, 'code', ['class' => 'col-md-3']); ?>

<?php echo $form->textFieldRow($model, 'name', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'unit', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'amount', ['class' => 'col-md-3']); ?>

<?php echo $form->textFieldRow($model, 'remark', ['class' => 'col-md-3']); ?>

<?php echo $form->textFieldRow($model, 'created_date'); ?>
<?php echo $form->textFieldRow($model, 'created_by', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'updated_date'); ?>
<?php echo $form->textFieldRow($model, 'updated_by', ['class' => 'col-md-3']); ?>
<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
<?php $this->endWidget(); ?>