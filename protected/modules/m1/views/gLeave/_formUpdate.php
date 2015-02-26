<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#" . CHtml::activeId($model, 'start_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#" . CHtml::activeId($model, 'end_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#" . CHtml::activeId($model, 'work_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});


});

		");
?>

<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'g-cuti-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php //echo $form->textFieldGroup($model,'input_date');  ?>

<?php echo $form->textFieldGroup($model, 'start_date'); ?>

<?php echo $form->textFieldGroup($model, 'end_date'); ?>

<?php echo $form->numberFieldGroup($model, 'number_of_day', ['hint' => 'Total days of leaving', 'widgetOptions' => ['htmlOptions' => ['min' => 0]]]); ?>

<?php echo $form->textFieldGroup($model, 'work_date'); ?>

<?php echo $form->textAreaGroup($model, 'leave_reason', ['widgetOptions' => ['htmlOptions' => ['rows' => 4]]]); ?>

<?php echo $form->textFieldGroup($model, 'balance'); ?>

<?php //echo $form->textFieldGroup($model,'replacement',array('class'=>'col-md-5','maxlength'=>10,'hint'=>'Your office mate as replacement during your leave')); ?>
<?php /*
  <div class="form-group">
  <?php echo $form->labelEx($model,'replacement',array('class'=>'control-label')); ?>
  <div class="col-sm-9">
  <?php
  $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
  'model'=>$model,
  'attribute'=>'replacement',
  'source'=>$this->createUrl('/m1/gPerson/personAutoComplete'),
  'options'=>array(
  'minLength'=>'2',
  //'focus'=> 'js:function( event, ui ) {
  //	$("#'.CHtml::activeId($model,'replacement').'").val(ui.item.label);
  //	return false;
  //}',
  ),
  'htmlOptions'=>array(
  'class'=>'input-medium',
  'placeholder'=>'Search Name',
  'class'=>'col-md-4',
  ),
  ));

  ?>
  </div>
  </div>
 */
?>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?php
            $this->widget('booster.widgets.TbButton', [
                'buttonType' => 'submit',
                'context' => 'primary',
                'icon' => 'fa fa-check',
                'label' => $model->isNewRecord ? 'Create' : 'Save',
            ]);
            ?>
        </div>
    </div>
<?php
$this->endWidget();

