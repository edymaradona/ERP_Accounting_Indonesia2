<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 't-account-entity-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>


<?php echo $form->errorSummary($model); ?>


<?php echo $form->dropDownListGroup($model, 'entity_id', aOrganization::model()->companyDropDown()); ?>
<?php echo $form->textAreaGroup($model, 'remark', ['class' => 'col-md-3', 'rows' => 3]); ?>
<?php echo $form->dropDownListGroup($model, 'state_id', sParameter::items("cStatusAcc")); ?>
<div class="form-group">
    <?php echo CHtml::htmlButton('<i class="fa fa-check"></i>' . $model->isNewRecord ? 'Create' : 'Save', ['class' => 'btn', 'type' => 'submit']); ?>
</div>

<?php $this->endWidget(); ?>
