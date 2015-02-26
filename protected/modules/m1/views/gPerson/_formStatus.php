<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker2', "
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

<div class="form">

    <?php
    $form = $this->beginWidget('TbActiveForm', [
        'id' => 'g-person-status-form',
        'enableAjaxValidation' => false,
        //'type'=>'horizontal',
    ]);
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldGroup($model, 'start_date', []); ?>

    <?php echo $form->textFieldGroup($model, 'end_date'); ?>

    <?php echo $form->dropDownListGroup($model, 'status_id', ['widgetOptions' => [
        'data' => sParameter::items('AK')
    ]]); ?>

    <?php echo $form->textAreaGroup($model, 'remark', ['widgetOptions' => ['htmlOptions' => ['rows' => 3]]]); ?>

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

