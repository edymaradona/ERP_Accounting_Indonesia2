<?php
/* @var $this JSelectionController */
/* @var $model jSelection */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('TbActiveForm', [
        'id' => 'j-selection-form',
        'enableAjaxValidation' => false,
    ]);
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?php //echo $form->textFieldGroup($model,'pic',array('class'=>'col-md-3'));  ?>
    <?php echo $form->dropDownListGroup($model, 'category_id', ['widgetOptions' => [
        'data' => sParameter::items('cSelectionType')
    ]]); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'schedule_date', ['class' => 'col-sm-3 control-label']); ?>
        <div class="col-sm-9">
            <?php
            $this->widget(
                'ext.EJuiDateTimePicker.EJuiDateTimePicker', [
                    'model' => $model,
                    'attribute' => 'schedule_date',
                    'options' => [
                        'dateFormat' => 'dd-mm-yy',
                        'timeFormat' => 'hh:mm', //'hh:mm tt' default
                        'stepMinute' => 15,
                    ],
                    'htmlOptions' => [
                        'class' => 'form-control'
                    ]
                ]
            );
            ?>
        </div>
    </div>

    <?php echo $form->textAreaGroup($model, 'additional_info', ['widgetOptions' => ['htmlOptions' => ['rows' => 3]]]); ?>
    <?php //echo $form->textFieldGroup($model,'cost'); ?>
    <?php echo $form->dropDownListGroup($model, 'status_id', ['widgetOptions' => [
        'data' => sParameter::items("cTrainingStatus")
    ]]); ?>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?php
            $this->widget('booster.widgets.TbButton', [
                'buttonType' => 'submit',
                'context' => 'primary',
                'icon' => 'fa fa-check',
                'label' => $model->isNewRecord ? 'Create' : 'Save',
            ]);
            ?>

        </div>
    </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->