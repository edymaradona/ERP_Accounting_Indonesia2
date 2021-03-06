<?php

$form = $this->beginWidget('booster.widgets.TbActiveForm', ['id' => 'ea-asset-category-form',
    'enableAjaxValidation' => false,
]);
?>
<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model, 'parent_id'); ?>
<?php echo $form->textFieldRow($model, 'inventory_type', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'type1_info', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'type2_info', ['class' => 'col-md-3']); ?>
<?php echo $form->textAreaRow($model, 'remarks', ['rows' => 6, 'cols' => 50]); ?>
<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
<?php $this->endWidget(); ?>