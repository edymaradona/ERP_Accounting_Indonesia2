<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', ['action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
]);
?>
<?php echo $form->textFieldRow($model, 'item', ['class' => 'col-md-3']); ?>

<?php echo $form->textFieldRow($model, 'brand', ['class' => 'col-md-3']); ?>

<?php echo $form->textFieldRow($model, 'type', ['class' => 'col-md-3']); ?>

<?php echo $form->textFieldRow($model, 'serial_number', ['class' => 'col-md-3']); ?>

<?php echo $form->textFieldRow($model, 'inventory_code', ['class' => 'col-md-3']); ?>

<?php echo $form->textFieldRow($model, 'bpb_number', ['class' => 'col-md-3']); ?>

<?php echo $form->textFieldRow($model, 'po_number', ['class' => 'col-md-3']); ?>

<?php echo $form->textFieldRow($model, 'supplier_id'); ?>
<div class="form-group">
    <?php echo CHtml::htmlButton('<i class="fa fa-check"></i>' . $model->isNewRecord ? 'Create' : 'Save', ['class' => 'btn', 'type' => 'submit']); ?>
</div>
<?php $this->endWidget(); ?>
