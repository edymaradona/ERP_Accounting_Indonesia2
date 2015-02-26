<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'module-module-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php //echo $form->dropDownListGroup($model,'parent_id',sModule::items()); ?>

<?php echo $form->textFieldGroup($model, 'sort', ['class' => 'col-md-3']); ?>

<?php echo $form->textFieldGroup($model, 'category_name', ['class' => 'col-md-3']); ?>

<?php echo $form->textAreaGroup($model, 'category_description', ['class' => 'col-md-5', 'rows' => 3]); ?>

<div class="control-group">
    <?php
    $this->widget('booster.widgets.TbButton', [
        'buttonType' => 'submit',
        // 'type' => 'primary',
        'icon' => 'fa fa-check',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    ]);
    ?>
</div>


<?php $this->endWidget(); ?>

