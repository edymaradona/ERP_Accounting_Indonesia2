<?php

$form = $this->beginWidget('TbActiveForm', [
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
]);
?>

<?php echo $form->label($model, 'title'); ?>
<?php echo $form->textField($model, 'title', ['class' => 'col-md-3']); ?>

<?php echo CHtml::submitButton('Search'); ?>

<?php $this->endWidget(); ?>
