<?php

$form = $this->beginWidget('booster.widgets.TbActiveForm', ['id' => 'ea-asset-supplier-form',
    'enableAjaxValidation' => false,
]);
?>
<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model, 'supplier_name', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'telpon', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'fax', ['class' => 'col-md-3']); ?>
<?php echo $form->textAreaRow($model, 'remarks', ['rows' => 6, 'cols' => 50]); ?>
<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
<?php $this->endWidget(); ?>