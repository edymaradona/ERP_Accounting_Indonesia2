<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 't-account-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php
echo $form->dropDownListGroup($model, 'haschild_id', ["No" => "No Child (Detail)", "Yes" => "Has Child (Summary)"], [
    //'disabled'=>!empty($model->hasJournal),
    'hint' => 'Dropdown will disabled automatically when this account already has journal voucher on current period',
]);
?>
<?php echo $form->textFieldGroup($model, 'account_no', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldGroup($model, 'account_name', ['class' => 'col-md-3']); ?>
<?php echo $form->textAreaGroup($model, 'short_description', ['class' => 'col-md-5', 'rows' => 3]); ?>
<?php //echo $form->dropDownListGroup($model,'currency_id',sParameter::items("cCurrency","*inherited*")); ?>
<?php //echo $form->dropDownListGroup($model,'state_id',sParameter::items("cStatus","*inherited*")); ?>

<?php
$this->widget('ext.appendo.JAppendo', [
    'id' => 'repeateEnum',
    'model' => $model,
    'viewName' => '_accountProperties',
    'labelDel' => 'Remove Row',
    'appendoPath' => '/modules/m2/views/jAppendo/',
    //'cssFile' => 'css/jquery.appendo2.css'
]);
?>

<div class="form-group">
    <?php echo CHtml::htmlButton('<i class="fa fa-check"></i>' . 'Save', ['class' => 'btn', 'type' => 'submit']); ?>
</div>

<?php $this->endWidget(); ?>
