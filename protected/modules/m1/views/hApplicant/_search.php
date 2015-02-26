<?php

$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'method' => 'get',
    'id' => 'searchForm',
    'type' => 'horizontal',
    'action' => Yii::app()->createUrl('/m1/hApplicant/index'),
]);
?>

<?php echo $form->textField($model, 'applicant_name', ['class' => 'form-control', 'placeholder' => 'search name, job description or job title']); ?>

    <br/>
<?php echo $form->dropDownList($model, 'sex_id', sParameter::itemsWithAll('cGender'), ['class' => 'form-control']); ?>

<?php /*
  <div class="form-group">
  <label class="control-label" for="fSearchApplicant_age_start">Age</label>
  <div class="col-sm-9">
  <?php //echo $form->textField($model,'age_start',array('class'=>'col-md-1')); ?>
  <?php //echo $form->textField($model,'age_end',array('class'=>'col-md-1')); ?>
  </div>
  </div>

  <div class="form-group">
  <label class="control-label" for="fSearchApplicant_experience_start">Experience</label>
  <div class="col-sm-9">
  <?php echo $form->textField($model,'experience_start',array('class'=>'col-md-1')); ?>
  <?php echo $form->textField($model,'experience_end',array('class'=>'col-md-1')); ?>
  </div>
  </div>

 */
?>

    <br/>
<?php echo $form->dropDownList($model, 'education_level', sParameter::itemsWithAll('EDU'), ['class' => 'form-control']); ?>

<?php

$this->endWidget();
