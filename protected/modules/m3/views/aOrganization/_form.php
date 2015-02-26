<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'c-jemaat-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>


<?php echo $form->textFieldRow($model, 'branch_code', ['class' => 'col-md-3',]); ?>
<?php echo $form->dropDownListRow($model, 'structure_id', sParameter::items("cStructure")); ?>
<?php echo $form->textFieldRow($model, 'name', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'address', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'address2', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'address3', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'address4', ['class' => 'col-md-3']); ?>

<?php /*
  <?php echo $form->labelEx($model,'propinsi_id'); ?>
  <?php
  echo $form->dropDownList($model,'propinsi_id',sKabupatenPropinsi::items("Any"),
  array(
  'empty'=>'select Propinsi:',
  'ajax' => array(
  'type'=>'POST',
  'url'=>CController::createUrl('/m3/aOrganization/kabupatenUpdate'),
  'update'=>'#'.CHtml::activeId($model,'kabupaten_id'),
  )
  )
  );

  ?>
 */
?>

<?php echo $form->dropDownListRow($model, 'kabupaten_id', []); ?>

<?php echo $form->textFieldRow($model, 'pos_code', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'phone_code_area', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'telephone', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'fax', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'email', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'website', ['class' => 'col-md-3']); ?>


<div class="form-group">
    <?php echo CHtml::htmlButton($model->isNewRecord ? '<i class="fa fa-check"></i>Create' : '<i class="fa fa-check"></i>Save', ['class' => 'btn', 'type' => 'submit']); ?>
</div>

<?php $this->endWidget(); ?>

