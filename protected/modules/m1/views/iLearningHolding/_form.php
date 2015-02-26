<?php
/* @var $this ILearningController */
/* @var $model iLearning */
/* @var $form CActiveForm */
?>


<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'i-learning-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'learning_title'); ?>
<?php echo $form->textAreaGroup($model, 'objective'); ?>
<?php echo $form->textAreaGroup($model, 'outline'); ?>
<?php echo $form->textFieldGroup($model, 'participant'); ?>
<?php echo $form->textFieldGroup($model, 'duration'); ?>
<?php echo $form->dropDownListGroup($model, 'type_id', ['widgetOptions' => [
    'data' => sParameter::items('cTraining')
]]); ?>
<?php echo $form->dropDownListGroup($model, 'prerequisites_id', ['widgetOptions' => [
    'data' => iLearning::model()->sylabusList()
]]); ?>

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        <?php
        $this->widget('booster.widgets.TbButton', [
            'buttonType' => 'submit',
            'icon' => 'fa fa-check',
            'label' => $model->isNewRecord ? 'Create' : 'Save',
        ]);
        ?>

    </div>
</div>
<?php $this->endWidget(); ?>

