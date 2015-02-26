<?php $form = $this->beginWidget('TbActiveForm'); ?>

<?php echo $form->dropDownListGroup($model, 'itemname', ['widgetOptions' => [
    'data' => $itemnameSelectOptions
]]); ?>

<div class="form-group">
    <?php //echo CHtml::submitButton(Rights::t('core', 'Assign')); ?>
    <?php
    $this->widget('booster.widgets.TbButton', [
        'buttonType' => 'submit',
        //'type' => 'primary',
        'icon' => 'fa fa-check',
        'label' => 'Assign',
    ]);
    ?>
</div>

<?php $this->endWidget(); ?>

