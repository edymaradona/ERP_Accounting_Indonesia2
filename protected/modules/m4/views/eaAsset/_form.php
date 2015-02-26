<?php
$this->widget('application.extensions.moneymask.MMask', [
    'element' => '#mask',
    'currency' => 'PHP',
    'config' => [
        'precision' => 0,
        'thousands' => '.',
    ]
]);
?><?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', ['id' => 'my-form13',
    'type' => 'horizontal', 'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model, 'input_date'); ?>
<?php echo $form->textFieldRow($model, 'periode_date'); ?>
<?php echo $form->textFieldRow($model, 'item', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'brand', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'type', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'serial_number', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'category_id'); ?>
<?php echo $form->textFieldRow($model, 'inventory_code', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'bpb_number', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'po_number', ['class' => 'col-md-3']); ?>
<?php //echo $form->textFieldRow($model,'amount',array('class'=>'col-md-3','id'=>'mask')); ?>
<?php echo $form->textFieldRow($model, 'supplier_id'); ?>
<?php echo $form->textFieldRow($model, 'warranty', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'insurance', ['class' => 'col-md-3']); ?>

<?php echo $form->textFieldRow($model, 'remark', ['size' => 60, 'maxlength' => 500]); ?>

<?php echo $form->textFieldRow($model, 'photo_path', ['size' => 60, 'maxlength' => 500]); ?>
<?php echo $form->textFieldRow($model, 'accesslevel_id'); ?>
<div class="form-group">
    <?php echo CHtml::htmlButton('<i class="fa fa-check"></i>' . $model->isNewRecord ? 'Create' : 'Save', ['class' => 'btn', 'type' => 'submit']); ?>
</div>
<?php $this->endWidget(); ?>
