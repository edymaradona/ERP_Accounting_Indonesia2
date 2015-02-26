<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'u-journal-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'input_date'); ?>

<?php //echo $form->dropDownListGroup($model,'yearmonth_periode',array(Yii::app()->params["cCurrentPeriod"]=>Yii::app()->params["cCurrentPeriod"])); ?>

<?php echo $form->textAreaGroup($model, 'remark', ['rows' => 2, 'class' => 'col-md-5']); ?>

<hr/>

<?php
$this->widget('ext.appendo.JAppendo', [
    'id' => 'repeateEnum',
    'model' => $model,
    'viewName' => '_detailJournalMemorial',
    'labelDel' => 'Remove Row',
    'appendoPath' => '/modules/m2/views/jAppendo/',
    //'cssFile' => 'css/jquery.appendo2.css'
]);
?>

<div class="form-group">
    <?php echo CHtml::htmlButton('<i class="fa fa-check"></i>Create', ['class' => 'btn', 'type' => 'submit']); ?>
</div>

<?php $this->endWidget(); ?>
