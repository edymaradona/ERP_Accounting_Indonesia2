<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
]);
?>
<?php echo $form->label($model, 'complete_name'); ?>
<?php echo $form->textFieldRow($model, 'complete_name', ['class' => 'col-md-3']); ?>
<?php echo $form->label($model, 'company_name'); ?>
<?php echo $form->textFieldRow($model, 'company_name', ['class' => 'col-md-3']); ?>
<?php echo $form->label($model, 'title'); ?>
<?php echo $form->textFieldRow($model, 'title', ['class' => 'col-md-3']); ?>
<?php echo $form->label($model, 'handphone'); ?>
<?php echo $form->textFieldRow($model, 'handphone', ['class' => 'col-md-3']); ?>
<?php echo $form->label($model, 'email'); ?>
<?php echo $form->textFieldRow($model, 'email', ['class' => 'col-md-3']); ?>

<div class="form-group">
    <?php echo CHtml::htmlButton('<i class="icon-fa-search"></i>Search', ['class' => 'btn', 'type' => 'submit']); ?>
</div>
<?php $this->endWidget(); ?>
