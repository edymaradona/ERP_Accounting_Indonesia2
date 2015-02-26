<?php
/* @var $this SSmsoutController */
/* @var $model sSmsout */
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
        <?php echo $form->label($model, 'sender_id'); ?>
        <?php echo $form->textField($model, 'sender_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'receivergroup_id'); ?>
        <?php echo $form->textField($model, 'receivergroup_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'receivergroup_tag'); ?>
        <?php echo $form->textField($model, 'receivergroup_tag', ['size' => 60, 'maxlength' => 100]); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'modem'); ?>
        <?php echo $form->textField($model, 'modem'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'message'); ?>
        <?php echo $form->textField($model, 'message', ['size' => 60, 'maxlength' => 767]); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'approved_id'); ?>
        <?php echo $form->textField($model, 'approved_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'created_date'); ?>
        <?php echo $form->textField($model, 'created_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'created_by'); ?>
        <?php echo $form->textField($model, 'created_by'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'updated_date'); ?>
        <?php echo $form->textField($model, 'updated_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'updated_by'); ?>
        <?php echo $form->textField($model, 'updated_by'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->