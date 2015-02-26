<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker', "
$(function() {
		$( \"#" . CHtml::activeId($model, 'receipt_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#" . CHtml::activeId($model, 'receipt_date') . "\" ).mask('99-99-9999');
		
		
});

		");
?>

<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'g-cuti-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'input_date', ['widgetOptions' => [
    'htmlOptions' => ['disabled' => true, 'value' => date("d-m-Y")]
]]); ?>

<?php echo $form->textFieldGroup($model, 'receipt_date'); ?>

<?php echo $form->dropDownListGroup($model, 'medical_type_id', ['widgetOptions' => [
    'data' => gParamMedical::model()->medicalDropDown()
]]); ?>

<?php echo $form->dropDownListGroup($model, 'medical_for_id', ['widgetOptions' => [
    'data' => gPersonFamily::model()->familyDropDown()
]]); ?>

<?php echo $form->textAreaGroup($model, 'sympthom', ['widgetOptions' => ['htmlOptions' => ['rows' => 4]]]); ?>

<?php echo $form->numberFieldGroup($model, 'original_amount', ['hint' => 'Total original amount', 'widgetOptions' => ['htmlOptions' => ['min' => 0]]]); ?>

<?php echo $form->textAreaGroup($model, 'remark', ['widgetOptions' => ['htmlOptions' => ['rows' => 4]]]); ?>



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
<?php
$this->endWidget();
