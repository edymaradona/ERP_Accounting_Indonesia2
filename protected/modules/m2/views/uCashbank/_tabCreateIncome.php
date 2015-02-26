<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
Yii::app()->getClientScript()->registerCoreScript('maskedinput');


Yii::app()->clientScript->registerScript('datepicker2', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).datepicker({
			
		'dateFormat' : 'dd-mm-yy',
		'changeMonth' : true,
        'changeYear' : true,
});
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).mask('99-99-9999');
});

		");
?>

<div class="page-header">
    <h1>
        <?php echo(isset($model->system_ref) ? "Update: " . $model->system_ref : "") ?>
    </h1>
</div>

<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'u-journal-formIn',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'input_date'); ?>

<?php //echo $form->dropDownListGroup($model,'yearmonth_periode',array(Yii::app()->params["cCurrentPeriod"]=>Yii::app()->params["cCurrentPeriod"])); ?>

<?php echo $form->dropDownListGroup($model, 'var_account', tAccount::cashBankAccount()); ?>
<?php echo $form->textFieldGroup($model, 'cb_received_from', ['class' => 'col-md-3']); ?>
<?php echo $form->textAreaGroup($model, 'remark', ['class' => 'col-md-5', 'rows' => 3]); ?>

<?php
$this->widget('ext.appendo.JAppendo', [
    'id' => 'repeateEnum2',
    'model' => $model,
    'viewName' => '_detailJournalIncome',
    'labelDel' => 'Remove Row',
    'appendoPath' => '/modules/m2/views/jAppendo/',
    //'cssFile' => 'css/jquery.appendo2.css'
]);
?>

<div class="form-group">
    <?php echo CHtml::htmlButton('<i class="fa fa-check"></i>Save Income', ['class' => 'btn', 'type' => 'submit']); ?>
</div>


<?php $this->endWidget(); ?>
