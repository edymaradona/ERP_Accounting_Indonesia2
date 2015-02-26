<?php
$form = $this->beginWidget('ext.booster.widgets.TbActiveForm', [
    'id' => 'c-supplier-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'company_name', ['class' => 'col-md-5', 'maxlength' => 50]); ?>

<?php echo $form->textFieldGroup($model, 'pic', ['class' => 'col-md-3', 'maxlength' => 40]); ?>

<?php echo $form->textFieldGroup($model, 'address', ['class' => 'col-md-5', 'maxlength' => 100]); ?>

<?php echo $form->textFieldGroup($model, 'address1', ['class' => 'col-md-4', 'maxlength' => 20]); ?>

<?php echo $form->textFieldGroup($model, 'address2', ['class' => 'col-md-3', 'maxlength' => 30]); ?>

<?php echo $form->textFieldGroup($model, 'address3', ['class' => 'col-md-3', 'maxlength' => 30]); ?>

<?php echo $form->textFieldGroup($model, 'city', ['class' => 'col-md-3', 'maxlength' => 100]); ?>

<?php echo $form->textFieldGroup($model, 'pos_code', ['class' => 'col-md-2', 'maxlength' => 7]); ?>

<?php echo $form->textFieldGroup($model, 'province', ['class' => 'col-md-2', 'maxlength' => 100]); ?>

<?php echo $form->textFieldGroup($model, 'telephone', ['class' => 'col-md-3', 'maxlength' => 50]); ?>

<?php echo $form->textFieldGroup($model, 'fax', ['class' => 'col-md-3', 'maxlength' => 50]); ?>

<?php echo $form->textFieldGroup($model, 'email', ['class' => 'col-md-3', 'maxlength' => 50]); ?>

<?php echo $form->textFieldGroup($model, 'method_id', ['class' => 'col-md-3']); ?>

<?php echo $form->textFieldGroup($model, 'bank_id', ['class' => 'col-md-3']); ?>

<?php echo $form->textFieldGroup($model, 'no_account', ['class' => 'col-md-3', 'maxlength' => 40]); ?>

<?php echo $form->textFieldGroup($model, 'atas_nama', ['class' => 'col-md-3', 'maxlength' => 40]); ?>

<?php echo $form->textFieldGroup($model, 'status_id', ['class' => 'col-md-3']); ?>


<div class="form-group">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', ['class' => 'btn primary']); ?>
</div>

<?php $this->endWidget(); ?>
