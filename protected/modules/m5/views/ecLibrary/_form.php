<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'ec-library-form',
	'enableAjaxValidation'=>false,
    'type' => 'horizontal',
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListGroup($model, 'category_id', ['widgetOptions' => [
    'data' => sParameter::items('cBookCategory')
]]); ?>
<?php echo $form->textFieldGroup($model,'title',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-5','maxlength'=>150)))); ?>
<?php echo $form->textAreaGroup($model,'description', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'col-md-8')))); ?>
<?php echo $form->textFieldGroup($model,'code',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-5','maxlength'=>50)))); ?>
<?php echo $form->textFieldGroup($model,'location',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-5','maxlength'=>100)))); ?>
<?php echo $form->textFieldGroup($model,'quantity',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'col-md-5')))); ?>

<div class="control-group">
    <?php echo CHtml::htmlButton($model->isNewRecord ? '<i class="fa fa-check fa-fw"></i>Create' : '<i class="fa fa-check fa-fw"></i>Save', ['class' => 'btn', 'type' => 'submit']); ?>
</div>

<?php $this->endWidget(); ?>
