<?php
/* @var $this SAddressbookGroupController */
/* @var $model sAddressbookGroup */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 's-addressbook-group-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'group_name', ['class' => 'col-md-5']); ?>
<?php echo $form->textAreaGroup($model, 'description', ['class' => 'col-md-9', 'rows' => 4]); ?>

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

