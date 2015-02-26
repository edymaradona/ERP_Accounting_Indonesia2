<?php

$form = $this->beginWidget('booster.widgets.TbActiveForm', ['action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
]);
?>
<?php echo $form->textFieldRow($model, 'id'); ?>
<?php echo $form->label($model, 'parent_id'); ?>
<?php echo $form->textFieldRow($model, 'parent_id'); ?>
<?php echo $form->label($model, 'location'); ?>
<?php echo $form->textFieldRow($model, 'location', ['class' => 'col-md-3']); ?>
<?php echo $form->label($model, 'remarks'); ?>
<?php echo $form->textAreaRow($model, 'remarks', ['rows' => 6, 'cols' => 50]); ?>
<?php echo CHtml::submitButton('Search'); ?>
<?php $this->endWidget(); ?>
