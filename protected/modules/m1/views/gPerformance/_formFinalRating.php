<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker4', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		'format' : 'dd-mm-yyyy',
		});
			
});

		");

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . "/css/bootstrap-spinedit/js/bootstrap-spinedit.js");
Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . "/css/bootstrap-spinedit/css/bootstrap-spinedit.css");


/*Yii::app()->clientScript->registerScript('sel2', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'year') . "\" ).spinedit({
	    minimum: " . date('Y', strtotime('4 year ago')) . ",
    	maximum: " . date('Y') . ",
	    step: 1,
    	numberOfDecimals: 0,
		});


		});


"); */
?>

<div class="row">
    <div class="col-md-12">

        <div class="page-header">
            <h3>New Final Rating</h3>
        </div>


        <?php
        $form = $this->beginWidget('TbActiveForm', [
            'id' => 'g-person-performance-form',
            'enableAjaxValidation' => false,
            'type' => 'horizontal',
        ]);
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php //echo $form->textFieldGroup($model, 'input_date'); ?>

        <?php echo $form->textFieldGroup($model, 'year'); ?>

        <?php echo $form->dropDownListGroup($model, 'period_id', ['widgetOptions' => [
            'data' => sParameter::items('cSemester')
        ]]); ?>


        <?php //echo $form->textFieldGroup($model, 'amount', array('class' => 'col-md-2'));  ?>

        <?php //echo $form->textFieldGroup($model, 'pa_value', array('class' => 'col-md-2','style' => 'text-transform: uppercase')); ?>
        <?php echo $form->dropDownListGroup($model, 'pa_value', ['widgetOptions' => [
            'data' => ['A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'E' => 'E']
        ]]); ?>

        <?php echo $form->dropDownListGroup($model, 'potential', ['widgetOptions' => [
            'data' => ['' => '', 'HF+' => 'HF+', 'HF++' => 'HF++']
        ]]); ?>

        <?php //echo $form->textAreaGroup($model, 'future_dev', array('rows' => 3, 'class' => 'col-md-5')); ?>

        <?php echo $form->textAreaGroup($model, 'remark', ['rows' => 3, 'class' => 'col-md-5']); ?>

        <div class="form-group">
            <div class="col-sm-3">
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