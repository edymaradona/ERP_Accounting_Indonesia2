<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
]);
?>

<?php echo $form->textFieldGroup($model, 'id'); ?>

<?php echo $form->textFieldGroup($model, 'employee_code_global'); ?>

<?php echo $form->textFieldGroup($model, 'employee_name'); ?>

<?php echo $form->textFieldGroup($model, 'birth_place'); ?>

<?php echo $form->textFieldGroup($model, 'birth_date'); ?>

<?php echo $form->checkboxGroup($model, 'sex', false); ?>


<?php /* 	
  <?php echo $form->textFieldGroup($model,'religion_id',array('class'=>'col-md-5')); ?>

  <?php echo $form->textFieldGroup($model,'address1',array('class'=>'col-md-5','maxlength'=>255)); ?>

  <?php echo $form->textFieldGroup($model,'address2',array('class'=>'col-md-5','maxlength'=>50)); ?>

  <?php echo $form->textFieldGroup($model,'address3',array('class'=>'col-md-5','maxlength'=>50)); ?>

  <?php echo $form->textFieldGroup($model,'pos_code',array('class'=>'col-md-5','maxlength'=>5)); ?>

  <?php echo $form->textFieldGroup($model,'identity_number',array('class'=>'col-md-5','maxlength'=>25)); ?>

  <?php echo $form->textFieldGroup($model,'identity_valid',array('class'=>'col-md-5')); ?>

  <?php echo $form->textFieldGroup($model,'identity_address1',array('class'=>'col-md-5','maxlength'=>255)); ?>

  <?php echo $form->textFieldGroup($model,'identity_address2',array('class'=>'col-md-5','maxlength'=>50)); ?>

  <?php echo $form->textFieldGroup($model,'identity_address3',array('class'=>'col-md-5','maxlength'=>50)); ?>

  <?php echo $form->textFieldGroup($model,'identity_pos_code',array('class'=>'col-md-5','maxlength'=>5)); ?>

  <?php echo $form->textFieldGroup($model,'email',array('class'=>'col-md-5','maxlength'=>100)); ?>

  <?php echo $form->textFieldGroup($model,'email2',array('class'=>'col-md-5','maxlength'=>100)); ?>

  <?php echo $form->textFieldGroup($model,'blood_id',array('class'=>'col-md-5','maxlength'=>10)); ?>

  <?php echo $form->textFieldGroup($model,'home_phone',array('class'=>'col-md-5','maxlength'=>50)); ?>

  <?php echo $form->textFieldGroup($model,'handphone',array('class'=>'col-md-5','maxlength'=>50)); ?>

  <?php echo $form->textFieldGroup($model,'handphone2',array('class'=>'col-md-5','maxlength'=>50)); ?>

  <?php echo $form->textFieldGroup($model,'c_pathfoto',array('class'=>'col-md-5','maxlength'=>255)); ?>

  <?php echo $form->textFieldGroup($model,'account_number',array('class'=>'col-md-5','maxlength'=>50)); ?>

  <?php echo $form->textFieldGroup($model,'account_name',array('class'=>'col-md-5','maxlength'=>50)); ?>

  <?php echo $form->textFieldGroup($model,'bank_name',array('class'=>'col-md-5','maxlength'=>45)); ?>

  <?php echo $form->textFieldGroup($model,'userid',array('class'=>'col-md-5')); ?>

  <?php echo $form->textFieldGroup($model,'activation_code',array('class'=>'col-md-5','maxlength'=>16)); ?>

  <?php echo $form->textFieldGroup($model,'activation_expire',array('class'=>'col-md-5')); ?>

  <?php echo $form->textFieldGroup($model,'created_date',array('class'=>'col-md-5')); ?>

  <?php echo $form->textFieldGroup($model,'created_by',array('class'=>'col-md-5')); ?>

  <?php echo $form->textFieldGroup($model,'updated_date',array('class'=>'col-md-5')); ?>

  <?php echo $form->textFieldGroup($model,'updated_by',array('class'=>'col-md-5')); ?>

 */
?>

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        <?php
        $this->widget('booster.widgets.TbButton', [
            'buttonType' => 'submit',
            'context' => 'primary',
            'icon' => 'fa fa-check',
            'label' => 'Search',
        ]);
        ?>
    </div>
</div>

<?php $this->endWidget(); ?>
