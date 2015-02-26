<?php
/* @var $this TBalanceSheetController */
/* @var $model tBalanceSheet */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 't-balance-sheet-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php //echo $form->textField($model,'budget',array('size'=>11,'maxlength'=>11)); ?>
<?php echo $form->textFieldGroup($model, 'beginning_balance', ['size' => 11, 'maxlength' => 11]); ?>
<?php echo $form->textFieldGroup($model, 'debit', ['size' => 11, 'maxlength' => 11]); ?>
<?php echo $form->textFieldGroup($model, 'credit', ['size' => 11, 'maxlength' => 11]); ?>
<?php echo $form->textFieldGroup($model, 'end_balance', ['size' => 11, 'maxlength' => 11]); ?>
<?php echo $form->textAreaGroup($model, 'remark', ['rows' => 6, 'cols' => 50]); ?>

<div class="form-group">
    <?php
    $this->widget('booster.widgets.TbButton', [
        'buttonType' => 'submit',
        'type' => 'primary',
        'icon' => 'fa fa-check',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    ]);
    ?>
</div>

<?php $this->endWidget(); ?>

