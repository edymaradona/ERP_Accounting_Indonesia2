<?php
/* @var $this SNotificationGroupMemberController */
/* @var $model sNotificationGroupMember */
/* @var $form CActiveForm */
?>

<div class="raw">

    <?php
    $form = $this->beginWidget('TbActiveForm', [
        'id' => 's-notification-group-member-form',
        'enableAjaxValidation' => false,
        'type' => 'horizontal',
    ]);
    ?>


    <?php echo $form->errorSummary($model); ?>

    <?php //echo $form->textFieldGroup($model,'user_id');  ?>
    <?php echo $form->dropDownListGroup($model, 'user_id', ['widgetOptions' => [
        'data' => sUser::getAllUsers()
    ]]); ?>

    <?php echo $form->dropDownListGroup($model, 'status_id', ['widgetOptions' => [
        'data' => sParameter::items('cStatus')
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