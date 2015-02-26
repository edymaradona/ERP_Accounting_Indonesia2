<?php
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->getClientScript()->registerCoreScript('maskedinput');


Yii::app()->clientScript->registerScript('datepicker', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).datepicker({
			
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).mask('99-99-9999');
});

		");
?>


<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'u-po-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
]);
?>


<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListGroup($model, 'supplier_id', uSupplier::items(), ['class' => 'col-md-5']); ?>

<?php echo $form->textFieldGroup($model, 'input_date', ['class' => 'col-md-2']); ?>

<?php //echo $form->textFieldGroup($model,'system_ref',array('class'=>'col-md-5','maxlength'=>100)); ?>

<?php echo $form->dropDownListGroup($model, 'po_type_id', ['1' => '1', '2' => '2']); ?>

<?php echo $form->textAreaGroup($model, 'remark', ['rows' => 3, 'class' => 'col-md-5']); ?>

<div class="form-group">
    <?php
    $this->widget('booster.widgets.TbButton', [
        'buttonType' => 'submit',
        'type' => 'primary',
        'icon' => 'fa fa-check',
        'label' => 'Create',
    ]);
    ?>

</div>

<?php
$this->widget('ext.appendo.JAppendo', [
    'id' => 'repeateEnum',
    'model' => $model,
    'viewName' => '_detailPo',
    'labelDel' => 'Remove Row',
    'appendoPath' => '/modules/m2/views/jAppendo/',
    //'cssFile' => 'css/jquery.appendo2.css'
]);
?>

<?php $this->endWidget(); ?>
