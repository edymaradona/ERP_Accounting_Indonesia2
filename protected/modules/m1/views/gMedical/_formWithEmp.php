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
		$( \"#" . CHtml::activeId($model, 'receipt_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
    });

    $( \"#" . CHtml::activeId($model, 'process_date') . "\" ).datepicker({
    'dateFormat' : 'dd-mm-yy',
    });

    $( \"#" . CHtml::activeId($model, 'settlement_date') . "\" ).datepicker({
    'dateFormat' : 'dd-mm-yy',
    });

		$( \"#" . CHtml::activeId($model, 'parent_name') . "\" ).autocomplete({
			'minLength' : 2,
			'source': ' " . Yii::app()->createUrl('/m1/gPerson/personAutoCompletePhotoActive') . "',
			'focus': function( event, ui ) {
			   $(\"#" . CHtml::activeId($model, 'parent_name') . "\").val(ui.item.label);
			   return false;
			},
			'select': function( event, ui ) {
			   $(\"#" . CHtml::activeId($model, 'parent_id') . "\").val(ui.item.id);
         jQuery.ajax({
            'type':'POST',
            'url':'" . Yii::app()->createUrl('/m1/gMedical/familyUpdate') . "',
            'cache':false,
            'data':jQuery(this).parents(\"form\").serialize(),
            'success':function(html){
              jQuery(\"#" . CHtml::activeId($model, 'medical_for_id') . "\").html(html)
            }
          });

			   return false;
			},
			
		})
		.data( \"autocomplete\" )._renderItem = function( ul, item ) {
			return $( \"<li></li>\")
			.data( \"item.autocomplete\", item )
			.append('<a class=\'userautocompletelink\'><img src=\'" . Yii::app()->baseUrl . "/shareimages/hr/employee/thumb/" . "'+item.photo+'\'/><h5>'+item.label+'</h5></a>')
			.appendTo( ul );
		};
		
		
});

		");
?>

<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'g-medical-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'input_date', ['widgetOptions' => [
    'htmlOptions' => ['disabled' => true, 'value' => date("d-m-Y")]
]]); ?>

<?php echo $form->textFieldGroup($model, 'parent_name'); ?>

<?php echo $form->hiddenField($model, 'parent_id'); ?>

<?php echo $form->textFieldGroup($model, 'receipt_date'); ?>

<?php //echo $form->textFieldGroup($model, 'settlement_date'); ?>

<?php echo $form->dropDownListGroup($model, 'medical_for_id'); ?>

<?php echo $form->dropDownListGroup($model, 'medical_type_id', ['widgetOptions' => [
    'data' => gParamMedical::medicalDropDownAll()
]]); ?>

<?php echo $form->textAreaGroup($model, 'sympthom', ['widgetOptions' => ['htmlOptions' => ['rows' => 4]]]); ?>

<?php echo $form->numberFieldGroup($model, 'original_amount', ['hint' => 'Total original amount', 'widgetOptions' => ['htmlOptions' => ['min' => 1]]]); ?>

<?php //echo $form->numberFieldGroup($model, 'approved_amount', ['class' => 'col-md-2', 'min' => 1], array('hint' => 'Total approved amount')); ?>

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
?>

<div id="req_res02">...</div>

