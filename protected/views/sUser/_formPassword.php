<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'user-form',
    //'type'=>'horizontal',
    'enableAjaxValidation' => true,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php //echo $form->textFieldGroup($model, 'salt', ['disabled' => true]); ?>
<?php echo $form->passwordFieldGroup($model, 'old_password', ['class' => 'col-md-3']); ?>
<?php echo $form->passwordFieldGroup($model, 'new_password', ['class' => 'col-md-3']); ?>
<?php echo $form->passwordFieldGroup($model, 'new_password_repeat', ['class' => 'col-md-3']); ?>


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