<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'matrix-user-module-form1',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->dropDownListGroup($model, 's_module_id', ['widgetOptions' => [
    'data' => sModule::itemsAll()
]]); ?>

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
