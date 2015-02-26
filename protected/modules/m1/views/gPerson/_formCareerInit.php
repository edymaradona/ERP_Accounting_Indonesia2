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

Yii::app()->clientScript->registerScript('datepicker1', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'start_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		});

		$( \"#" . CHtml::activeId($model, 'superior_name') . "\" ).autocomplete({
			'minLength' : 2,
			'source': ' " . Yii::app()->createUrl('/m1/gPerson/personAutoCompletePhoto') . "',
			'focus': function( event, ui ) {
			$(\"#" . CHtml::activeId($model, 'superior_name') . "\").val(ui.item.label);
			return false;
			},
			'select': function( event, ui ) {
			$(\"#" . CHtml::activeId($model, 'superior_id') . "\").val(ui.item.id);
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

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'start_date', ['value' => date("d-m-Y")]); ?>

<?php //echo $form->dropDownListGroup($model,'status_id',sParameter::items('cPromotion')); ?>
<?php echo $form->dropDownListGroup($model, 'status_id', ['widgetOptions' => [
    'data' => ['1' => 'Join (New)', '2' => 'Join (Continued)']
]]); ?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'company_id', ["class" => "col-sm-3 control-label"]); ?>
    <div class="col-sm-9">
        <?php
        echo $form->dropDownList($model, 'company_id', aOrganization::model()->companyDropDown(), [
                'empty' => 'Select Company:',
                'class' => 'form-control',
                'ajax' => [
                    'type' => 'POST',
                    'url' => CController::createUrl('/m1/gPerson/deptUpdate'),
                    'update' => '#' . CHtml::activeId($model, 'department_id'),
                ],
            ]
        );
        ?>
    </div>
</div>

<?php echo $form->dropDownListGroup($model, 'department_id', []); ?>

<?php echo $form->dropDownListGroup($model, 'section_id', ['widgetOptions' => [
    'data' => ['0'=>'Default']
]]); ?>

<?php echo $form->dropDownListGroup($model, 'level_id', ['widgetOptions' => [
    'data' => gParamLevel::model()->levelDropDown()
]]); ?>

<?php echo $form->textFieldGroup($model, 'job_title'); ?>

<?php echo $form->textFieldGroup($model, 'superior_name'); ?>
<?php echo $form->hiddenField($model, 'superior_id'); ?>

<?php
echo $form->textAreaGroup($model, 'reason', ['widgetOptions' => ['htmlOptions' => ['rows' => 3]]]);
