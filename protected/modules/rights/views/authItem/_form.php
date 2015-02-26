<?php if ($model->scenario === 'update'): ?>

    <h3>
        <?php echo Rights::getAuthItemTypeName($model->type); ?>
    </h3>

<?php endif; ?>

<?php //$form=$this->beginWidget('CActiveForm'); ?>
<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'aPorder-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php
echo $form->textFieldGroup($model, 'name', ['maxlength' => 255, 'class' => 'text-field',
    'hint' => Rights::t('core', 'Do not change the name unless you know what you are doing.')]);
?>

<?php
echo $form->textFieldGroup($model, 'description', ['maxlength' => 255, 'class' => 'text-field',
    'hint' => Rights::t('core', 'A descriptive name for this item.')]);
?>

<?php if (Rights::module()->enableBizRule === true): ?>

    <?php
    echo $form->textFieldGroup($model, 'bizRule', ['maxlength' => 255, 'class' => 'text-field',
        'hint' => Rights::t('core', 'Code that will be executed when performing access checking.')]);
    ?>

<?php endif; ?>

<?php if (Rights::module()->enableBizRule === true && Rights::module()->enableBizRuleData): ?>

    <?php echo $form->labelEx($model, 'data'); ?>
    <?php
    echo $form->textField($model, 'data', ['maxlength' => 255, 'class' => 'text-field',
        'hint' => Rights::t('core', 'Additional data available when executing the business rule.')]);
    ?>

<?php endif; ?>

<div class="form-group">
    <?php //echo CHtml::submitButton(Rights::t('core', 'Assign'));  ?>
    <?php
    $this->widget('booster.widgets.TbButton', [
        'buttonType' => 'submit',
        //'type' => 'primary',
        'icon' => 'fa fa-check',
        'label' => 'Save',
    ]);
    ?>

    <?php echo CHtml::link(Rights::t('core', 'Cancel'), Yii::app()->user->rightsReturnUrl, ['class' => 'btn']); ?>

</div>

<?php $this->endWidget(); ?>
