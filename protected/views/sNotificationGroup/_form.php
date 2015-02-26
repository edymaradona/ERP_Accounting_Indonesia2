<?php
/* @var $this SNotificationGroupController */
/* @var $model sNotificationGroup */
/* @var $form CActiveForm */
?>

<div class="raw">

    <?php
    $form = $this->beginWidget('TbActiveForm', [
        'id' => 's-notification-group-form',
        'enableAjaxValidation' => false,
    ]);
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldGroup($model, 'group_name', ['class' => 'col-md-4']); ?>
    <?php echo $form->textAreaGroup($model, 'group_description', ['class' => 'col-md-4', 'rows' => 3]); ?>
    <?php echo $form->dropDownListGroup($model, 'status_id', ['widgetOptions' => [
        'data' => sParameter::items("cStatus")
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

</div><!-- form -->