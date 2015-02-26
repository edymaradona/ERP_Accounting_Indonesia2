<?php

$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'action' => Yii::app()->createUrl('/m1/hVacancy/index'),
    'method' => 'get',
    'id' => 'searchForm',
    'htmlOptions' => ['class' => 'form-inline'],
]);
?>

<?php echo $form->textField($model, 'vacancy_title', ['maxlength' => 100]); ?>

<?php echo CHtml::htmlButton('<i class="fa fa-search fa-fw"></i>Search', ['class' => 'btn', 'type' => 'submit']); ?>

<?php $this->endWidget(); ?>
