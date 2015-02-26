<style>
    .userautocompletelink {
        height: 52px;
    }

    .userautocompletelink img {
        float: left;
        margin-right: 5px;
        width: 40px;
    }

</style>

<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
Yii::app()->getClientScript()->registerCoreScript('maskedinput');

Yii::app()->clientScript->registerScript('datepicker', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#" . CHtml::activeId($model, 'start_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#" . CHtml::activeId($model, 'end_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).mask('99-99-9999');
		$( \"#" . CHtml::activeId($model, 'start_date') . "\" ).mask('99-99-9999');
		$( \"#" . CHtml::activeId($model, 'end_date') . "\" ).mask('99-99-9999');
				
		$( \"#" . CHtml::activeId($model, 'parent_name') . "\" ).autocomplete({
			'minLength' : 2,
			'source': ' " . Yii::app()->createUrl('/m1/gPerson/personAutoCompletePhoto') . "',
			'focus': function( event, ui ) {
			$(\"#" . CHtml::activeId($model, 'parent_name') . "\").val(ui.item.label);
			return false;
			},
			'select': function( event, ui ) {
			$(\"#" . CHtml::activeId($model, 'parent_id') . "\").val(ui.item.id);
			return false;
			},
			
		})
		.data( \"autocomplete\" )._renderItem = function( ul, item ) {
			return $( \"<li></li>\")
			.data( \"item.autocomplete\", item )
			.append('<a class=\'userautocompletelink\'><img src=\'" . Yii::app()->baseUrl . "/shareimages/hr/employee/" . "'+item.photo+'\'/><h5>'+item.label+'</h5></a>')
			.appendTo( ul );
		};
		

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

<?php echo $form->textFieldGroup($model, 'parent_name'); ?>

<?php echo $form->hiddenField($model, 'parent_id'); ?>

<?php echo $form->textFieldGroup($model, 'input_date', ['widgetOptions' => [
    'htmlOptions' => ['disabled' => true, 'value' => date("d-m-Y")]
]]); ?>

<?php echo $form->textFieldGroup($model, 'start_date'); ?>

<?php //echo $form->textFieldGroup($model, 'end_date'); ?>

<?php echo $form->numberFieldGroup($model, 'number_of_day', ['hint' => 'Total days of extended leaving', 'widgetOptions' => ['htmlOptions' => ['min' => 0]]]); ?>

<?php echo $form->textAreaGroup($model, 'leave_reason', ['widgetOptions' => ['htmlOptions' => ['rows' => 4]]]); ?>


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

