<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 't-account-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListGroup($model, 'accmain_id', tAccountMain::items()); ?>
<?php echo $form->textFieldGroup($model, 'account_no', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldGroup($model, 'account_name', ['class' => 'col-md-3']); ?>
<?php echo $form->textAreaGroup($model, 'short_description', ['class' => 'col-md-5', 'rows' => 3]); ?>
<?php echo $form->dropDownListGroup($model, 'currency_id', sParameter::items("cCurrency")); ?>
<?php echo $form->dropDownListGroup($model, 'state_id', sParameter::items("cStatusAcc")); ?>

<div class="form-group">
    <?php echo CHtml::htmlButton('<i class="fa fa-check"></i>' . $model->isNewRecord ? 'Create' : 'Save', ['class' => 'btn', 'type' => 'submit']); ?>
</div>

<?php $this->endWidget(); ?>

