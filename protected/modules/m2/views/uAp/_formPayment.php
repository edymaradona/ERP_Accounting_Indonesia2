<h4>Payment Process</h4>

<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker', "
$(function() {
		$( \"#" . CHtml::activeId($model, 'payment_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		});		
		$( \"#" . CHtml::activeId($model, 'effective_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		});		
		
});

		");
?>


<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'u-ap-payment-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
]);
?>


<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'payment_date', ['class' => 'col-md-2']); ?>

<?php //echo $form->textFieldGroup($model,'payment_ref',array('class'=>'col-md-5','maxlength'=>100)); ?>

<?php echo $form->dropDownListGroup($model, 'payment_source_id', tAccount::cashbankAccount()); ?>
<?php echo $form->dropDownListGroup($model, 'payment_type_id', ['1' => 'Cash', '2' => 'Cheque/Giro']); ?>
<?php echo $form->textAreaGroup($model, 'description', ['class' => 'col-md-5', 'rows' => 4]); ?>

<?php echo $form->textFieldGroup($model, 'amount', ['class' => 'col-md-3', 'maxlength' => 15]); ?>

<?php echo $form->textFieldGroup($model, 'effective_date', ['class' => 'col-md-2']); ?>


<div class="form-group">
    <?php
    $this->widget('booster.widgets.TbButton', [
        'buttonType' => 'submit',
        'type' => 'primary',
        'icon' => 'fa fa-check',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    ]);
    ?>
</div>

<?php $this->endWidget(); ?>
