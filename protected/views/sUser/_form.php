<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('autocomplet', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'default_group_name') . "\" ).autocomplete({
		'minLength': '2',
		'source' : '" . Yii::app()->createUrl('/aOrganization/organizationAutoComplete') . "',
		'focus' : function( event, ui ) {
		$(\"#" . CHtml::activeId($model, 'default_group_name') . "\").val(ui.item.label);
		return false;
},
		'select' : function( event, ui ) {
		$(\"#" . CHtml::activeId($model, 'default_group') . "\").val(ui.item.id);
		return false;
},

});
});

		");

//Yii::app()->clientScript->registerScript('mask', "
//		$(function() {
//		$( \"#".CHtml::activeId($model,'username')."\" ).mask('aaaaaaaaaaaaaaa');
//		});
//");
?>

<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'user-module-form',
    //'type'=>'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'full_name', ['class' => 'col-md-4']); ?>

<?php echo $form->textFieldGroup($model, 'username', ['class' => 'col-md-3']); ?>

<?php echo $form->passwordFieldGroup($model, 'password', ['class' => 'col-md-3']); ?>

<?php //echo $form->dropDownListGroup($model,'default_group',aOrganization::model()->rootList);  ?>
<?php echo $form->textFieldGroup($model, 'default_group_name', ['class' => 'col-md-4']); ?>
<?php echo $form->hiddenField($model, 'default_group'); ?>


<?php echo $form->dropDownListGroup($model, 'status_id', ['widgetOptions' => [
    'data' => sParameter::items("cStatus")
]]); ?>

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
