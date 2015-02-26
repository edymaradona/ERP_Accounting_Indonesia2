<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker15', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'start_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		});
		$( \"#" . CHtml::activeId($model, 'end_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		});
			
});

		");
?>


<div class="row">
    <div class="col-md-12">

        <?php
        $form = $this->beginWidget('TbActiveForm', [
            'id' => 'gperson-education-nf-form',
            'enableAjaxValidation' => false,
            'type' => 'horizontal',
        ]);
        ?>


        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldGroup($model, 'start_date', ['widgetOptions' => ['htmlOptions' => ['value' => date("d-m-Y")]]]); ?>

        <?php echo $form->textFieldGroup($model, 'end_date'); ?>

        <?php echo $form->dropDownListGroup($model, 'type_id', ['widgetOptions' => [
            'data' => sParameter::items('cTraining')
        ]]); ?>

        <?php echo $form->textFieldGroup($model, 'topic'); ?>

        <?php echo $form->textFieldGroup($model, 'instructor'); ?>

        <?php echo $form->textFieldGroup($model, 'duration'); ?>

        <?php echo $form->dropDownListGroup($model, 'sertificate', ['widgetOptions' => [
            'data' => ['-1' => 'Yes', '0' => 'No']
        ]]); ?>

        <?php echo $form->textFieldGroup($model, 'organizer'); ?>

        <?php echo $form->textFieldGroup($model, 'place'); ?>

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

    </div>
    <!-- form -->
</div><!-- form -->