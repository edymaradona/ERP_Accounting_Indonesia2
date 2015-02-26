<?php
/* @var $this GPayrollController */
/* @var $model gPayroll */
/* @var $form CActiveForm */
?>

<style>
    .ui-datepicker-calendar {
        display: none;
    }
</style>
<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('monthpicker1', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'yearmonth_start') . "\" ).datepicker({

		'changeMonth': true,
        'changeYear': true,
        'showButtonPanel': true,
        'dateFormat': 'yymm',
        'onClose': function(dateText, inst) { 
            var month = $(\"#ui-datepicker-div .ui-datepicker-month :selected\").val();
            var year = $(\"#ui-datepicker-div .ui-datepicker-year :selected\").val();
            $(this).datepicker('setDate', new Date(year, month, 1));
        }


		});
				
});

		");
?>

<div class="row">
    <div class="col-md-12">

        <?php
        $form = $this->beginWidget('TbActiveForm', [
            'id' => 'g-payroll-form',
            'enableAjaxValidation' => false,
        ]);
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldGroup($model, 'yearmonth_start'); ?>
        <?php echo $form->dropDownListGroup($model, 'category_id', ['widgetOptions' => [
            'data' => sParameter::items('cPayrollChange')
        ]]); ?>
        <?php echo $form->numberFieldGroup($model, 'basic_salary', ['widgetOptions' => ['htmlOptions' => ['min' => 0]]]); ?>
        <?php echo $form->numberFieldGroup($model, 'prorate_salary', ['widgetOptions' => ['htmlOptions' => ['min' => 0]]]); ?>
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
</div>