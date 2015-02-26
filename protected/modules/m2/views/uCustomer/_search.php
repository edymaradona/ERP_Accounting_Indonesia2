<?php
$form = $this->beginWidget('ext.booster.widgets.TbActiveForm', [
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
]);
?>

<?php echo $form->textFieldGroup($model, 'company_name', ['class' => 'col-md-5', 'maxlength' => 50]); ?>

<?php echo $form->textFieldGroup($model, 'pic', ['class' => 'col-md-5', 'maxlength' => 40]); ?>

<div class="actions">
    <?php echo CHtml::submitButton('Search', ['class' => 'btn primary']); ?>
</div>

<?php $this->endWidget(); ?>
