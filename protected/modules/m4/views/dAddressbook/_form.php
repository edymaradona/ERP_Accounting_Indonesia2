<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', ['id' => 'my-form11',
    'type' => 'horizontal', 'enableAjaxValidation' => false,
]);
?>
<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model, 'complete_name', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'company_name', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'title', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'address1', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'address2', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'address3', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'handphone', ['class' => 'col-md-3']); ?>
<?php echo $form->textFieldRow($model, 'email', ['class' => 'col-md-3']); ?>
<?php echo $form->dropDownListRow($model, 'defaultgroup', DAddressbookGroup::items()); ?>
    <div class="form-group">
        <?php echo CHtml::htmlButton('<i class="fa fa-check"></i>' . $model->isNewRecord ? 'Create' : 'Save', ['class' => 'btn', 'type' => 'submit']); ?>
    </div>
<?php $this->endWidget(); ?>