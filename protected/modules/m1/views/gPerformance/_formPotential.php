<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker5', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
			
});

		");
?>

<div class="row">
    <div class="col-md-12">

        <div class="page-header">
            <h3>New Potential</h3>
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

        <?php echo $form->numberFieldGroup($model, 'year', ['widgetOptions' => ['htmlOptions' => ['min' => 0]]]); ?>

        <?php echo $form->numberFieldGroup($model, 'amount', ['widgetOptions' => ['htmlOptions' => ['min' => 0]]]); ?>

        <?php //echo $form->numberFieldGroup($model, 'qualification', ['min' => 0]); ?>

        <?php echo $form->textAreaGroup($model, 'remark', ['widgetOptions' => ['htmlOptions' => ['rows' => 3]]]); ?>

        <?php
        echo $form->redactorGroup($model, 'core_description');
        ?>

        <?php
        echo $form->redactorGroup($model, 'management_description');
        ?>

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