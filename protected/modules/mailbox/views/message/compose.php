<?php
$this->breadcrumbs = [
    ucfirst($this->module->id) => ['inbox'],
    ucfirst($this->getAction()->getId())
];

Yii::app()->clientScript->registerScript('something', '$("#' . CHtml::activeId($conv, 'subject') . '").focus();');
?>
<div class="row">
    <div class="col-md-2">

        <?php
        $this->renderpartial('_menu');
        ?>
    </div>
    <div class="col-md-10">

        <?php
        $this->renderPartial('_flash');


        $form = $this->beginWidget('TbActiveForm', [
            'id' => 'message-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => ['autocomplete' => $this->createUrl('ajax/auto')],
        ]);
        ?>

        <?php echo $form->textFieldGroup($conv, 'to', ['id' => 'message-to', 'class' => 'col-md-7', 'edit' => $this->module->editToField ? '1' : null]); ?>

        <?php echo $form->textFieldGroup($conv, 'subject', ['placeholder' => $this->module->defaultSubject, 'class' => 'col-md-7']); ?>

        <?php echo $form->textAreaGroup($msg, 'text', ['widgetOptions' => ['htmlOptions' => ['rows' => 7, 'placeholder' => 'Enter message here...']]]); ?>

        <div class="form-group">
            <?php
            $this->widget('booster.widgets.TbButton', [
                'buttonType' => 'submit',
                'context' => 'primary',
                'icon' => 'fa fa-check',
                'label' => 'Send Message',
            ]);
            ?>
        </div>

        <?php $this->endWidget(); ?><!-- form -->

    </div>


</div>

<!-- mailbox -->