<?php
/* @var $this JSelectionController */
/* @var $model jSelection */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', [
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ]);
    ?>

    <div class="row">
        <?php echo $form->label($model, 'id'); ?>
        <?php echo $form->textField($model, 'id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'pic'); ?>
        <?php echo $form->textField($model, 'pic', ['size' => 60, 'maxlength' => 100]); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'category_id'); ?>
        <?php echo $form->textField($model, 'category_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'schedule_date'); ?>
        <?php echo $form->textField($model, 'schedule_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'additional_info'); ?>
        <?php echo $form->textField($model, 'additional_info', ['size' => 60, 'maxlength' => 500]); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'cost'); ?>
        <?php echo $form->textField($model, 'cost'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'status_id'); ?>
        <?php echo $form->textField($model, 'status_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'created_date'); ?>
        <?php echo $form->textField($model, 'created_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'created_by'); ?>
        <?php echo $form->textField($model, 'created_by', ['size' => 50, 'maxlength' => 50]); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'updated_date'); ?>
        <?php echo $form->textField($model, 'updated_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'updated_by'); ?>
        <?php echo $form->textField($model, 'updated_by', ['size' => 50, 'maxlength' => 50]); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->