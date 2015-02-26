<?php
/* @var $this SUserRegistrationController */
/* @var $model sUserRegistration */
/* @var $form CActiveForm */
?>

<div class="raw">
    <div class="class12">

        <?php
        $form = $this->beginWidget('TbActiveForm', [
            'id' => 's-user-registration-form',
            'enableAjaxValidation' => false,
            'type' => 'horizontal',
        ]);
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->dropDownListGroup($model, 'module_name', ['widgetOptions' => [
            'data' => ['Recruitment' => 'Recruitment']
        ]]); ?>
        <?php //echo $form->textFieldGroup($model,'registration_date'); ?>
        <?php //echo $form->textFieldGroup($model,'activation_code',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->textFieldGroup($model, 'email', ['size' => 60, 'maxlength' => 255]); ?>
        <?php //echo $form->passwordFieldGroup($model,'password',array('size'=>60,'maxlength'=>255));  ?>
        <?php echo $form->dropDownListGroup($model, 'status_id', ['widgetOptions' => [
            'data' => sParameter::items('cStatusP')
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

    </div>
    <!-- form -->
</div><!-- form -->