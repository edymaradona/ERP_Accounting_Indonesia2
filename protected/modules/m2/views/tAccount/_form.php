<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 't-account-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListGroup($model, 'haschild_id', ["No" => "No Child (Detail)", "Yes" => "Has Child (Summary)"]); ?>
<?php echo $form->textFieldGroup($model, 'account_no', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldGroup($model, 'account_name', ['class' => 'col-md-3']); ?>
<?php echo $form->textAreaGroup($model, 'short_description', ['class' => 'col-md-4', 'rows' => 3]); ?>
<?php //echo $form->dropDownListGroup($model,'currency_id',sParameter::items("cCurrency","*inherited*")); ?>
<?php //echo $form->textFieldGroup($model, 'beginning_balance', array('class' => 'col-md-3', 'hint' => 'Input this field with started amount for this account')); ?>
<?php //echo $form->dropDownListGroup($model,'state_id',sParameter::items("cStatus","*inherited*"));  ?>

<div class="form-group">
    <?php echo CHtml::htmlButton($model->isNewRecord ? '<i class="fa fa-check"></i>Create' : '<i class="fa fa-check"></i>Save', ['class' => 'btn', 'type' => 'submit']); ?>
</div>


<?php $this->endWidget(); ?>
