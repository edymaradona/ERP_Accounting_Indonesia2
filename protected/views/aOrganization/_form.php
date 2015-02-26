<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'a-organization-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
]);
?>

<?php echo $form->errorSummary($model); ?>


<?php //echo $form->textFieldGroup($model,'branch_code_number',array('class'=>'col-md-2',)); ?>
<?php echo $form->textFieldGroup($model, 'branch_code', ['class' => 'col-md-2',]); ?>
<?php echo $form->textFieldGroup($model, 'name', ['class' => 'col-md-4']); ?>
<?php echo $form->textFieldGroup($model, 'custom1', ['class' => 'col-md-1']); ?>
<?php echo $form->textFieldGroup($model, 'custom2', ['class' => 'col-md-1']); ?>
<?php echo $form->textFieldGroup($model, 'custom3', ['class' => 'col-md-1']); ?>
<?php echo $form->dropDownListGroup($model, 'custom4', ['widgetOptions' => [
    'data' => sParameter::items('cCompanyCat')
]]); ?>

<?php echo $form->textAreaGroup($model, 'address', ['rows' => 3, 'class' => 'col-md-4']); ?>

<?php /*
  <?php echo $form->labelEx($model,'propinsi_id'); ?>
  <?php
  echo $form->dropDownList($model,'propinsi_id',sKabupatenPropinsi::items("Any"),
  array(
  'empty'=>'select Propinsi:',
  'ajax' => array(
  'type'=>'POST',
  'url'=>CController::createUrl('aOrganization/kabupatenUpdate'),
  'update'=>'#'.CHtml::activeId($model,'kabupaten_id'),
  )
  )
  );

  ?>
 */
?>

<?php //echo $form->dropDownListGroup($model,'kabupaten_id',[]); ?>

<?php echo $form->textFieldGroup($model, 'pos_code', ['class' => 'col-md-2']); ?>
<?php //echo $form->textFieldGroup($model,'phone_code_area',array('class'=>'col-md-3')); ?>
<?php echo $form->textFieldGroup($model, 'telephone', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldGroup($model, 'fax', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldGroup($model, 'email', ['class' => 'col-md-4']); ?>
<?php echo $form->textFieldGroup($model, 'website', ['class' => 'col-md-4']); ?>
<?php echo $form->dropDownListGroup($model, 'status_id', ['widgetOptions' => [
    'data' => sParameter::items('cOrganizationStatus')
]]); ?>


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

