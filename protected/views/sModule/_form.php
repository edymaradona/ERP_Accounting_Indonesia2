<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'module-module-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>


<?php echo $form->dropDownListGroup($model, 'parent_id', ['widgetOptions' => [
    'data' => sModule::items()
]]); ?>

<?php echo $form->dropDownListGroup($model, 'name', ['widgetOptions' => [
    'data' => sModule::model()->moduleList
]]); ?>

<?php echo $form->textFieldGroup($model, 'sort', ['class' => 'col-md-3']); ?>

<?php echo $form->textFieldGroup($model, 'title', ['class' => 'col-md-3']); ?>

<?php echo $form->textFieldGroup($model, 'description', ['class' => 'col-md-3']); ?>

<?php echo $form->textFieldGroup($model, 'link', ['class' => 'col-md-3']); ?>

<?php echo $form->textFieldGroup($model, 'image', ['class' => 'col-md-3']); ?>

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

