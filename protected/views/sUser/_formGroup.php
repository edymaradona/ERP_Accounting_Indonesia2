<?php
Yii::app()->clientScript->registerScript('autocompl', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'organization_root_name') . "\" ).autocomplete({
		'minLength': '2',
		'source' : '" . Yii::app()->createUrl('/aOrganization/organizationAutoComplete') . "',
		'focus' : function( event, ui ) {
		$(\"#" . CHtml::activeId($model, 'organization_root_name') . "\").val(ui.item.label);
		return false;
},
		'select' : function( event, ui ) {
		$(\"#" . CHtml::activeId($model, 'organization_root_id') . "\").val(ui.item.id);
		return false;
},

});
});

		");
?>

<?php
$form = $this->beginWidget('ext.booster.widgets.TbActiveForm', [
    'id' => 's-group-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>


<?php echo $form->errorSummary($model); ?>

<?php //echo $form->dropDownListGroup($model,'organization_root_id', aOrganization::getRootList()  ,array('class'=>'col-md-5')); ?>
<?php echo $form->textFieldGroup($model, 'organization_root_name'); ?>
<?php echo $form->hiddenField($model, 'organization_root_id'); ?>


<div class="control-group">
    <?php
    $this->widget('booster.widgets.TbButton', [
        'buttonType' => 'submit',
        // 'type' => 'primary',
        'icon' => 'fa fa-check',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    ]);
    ?>
</div>

<?php $this->endWidget(); ?>
