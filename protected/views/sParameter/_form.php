<br/>

<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'parameter-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->textFieldGroup($model, 'type'); ?>

<?php echo $form->textFieldGroup($model, 'code'); ?>

<?php echo $form->textFieldGroup($model, 'name', ['class' => 'col-md-3']); ?>

<?php echo $form->dropDownListGroup($model, 'status_id', ['widgetOptions' => [
    'data' => sParameter::items("cStatus")
]]); ?>

<div class="control-group">
    <?php //echo CHtml::htmlButton($model->isNewRecord ? '<i class="fa fa-check fa-fw"></i>Create':'<i class="fa fa-check fa-fw"></i>Save', array('class'=>'btn', 'type'=>'submit'));  ?>
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
