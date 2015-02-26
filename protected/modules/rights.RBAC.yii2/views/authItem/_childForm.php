<?php $form = $this->beginWidget('CActiveForm'); ?>

<?php echo $form->dropDownList($model, 'itemname', $itemnameSelectOptions); ?>
<?php echo $form->error($model, 'itemname'); ?>

<?php //echo CHtml::submitButton(Rights::t('core', 'Add')); ?>
<?php

$this->widget('booster.widgets.TbButton', [
    'buttonType' => 'submit',
    //'type' => 'primary',
    'icon' => 'fa fa-check',
    'label' => 'Add',
]);
?>


<?php $this->endWidget(); ?>
