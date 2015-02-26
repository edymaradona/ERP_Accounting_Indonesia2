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

Yii::app()->clientScript->registerScript('datepicker', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'applicant_name') . "\" ).autocomplete({
			'minLength' : 2,
			'source': ' " . Yii::app()->createUrl('/m1/jSelectionHolding/employeeAutoCompletePhoto') . "',
			'focus': function( event, ui ) {
			$(\"#" . CHtml::activeId($model, 'applicant_name') . "\").val(ui.item.label);
			return false;
			},
			'select': function( event, ui ) {
			$(\"#" . CHtml::activeId($model, 'applicant_id') . "\").val(ui.item.id);
			return false;
			},
			
		})
		.data( \"autocomplete\" )._renderItem = function( ul, item ) {
			return $( \"<li></li>\")
			.data( \"item.autocomplete\", item )
			.append('<a class=\'userautocompletelink\'><img src=\'"
    . Yii::app()->baseUrl . "/shareimages/hr/applicant/" . "'+item.photo+'\'/><strong>'+item.label+'</strong><br/>'+item.detail+'</a>')
			.appendTo( ul );
		};
		

});

		");
?>

<div class="page-header">
    <h3>Existing Employee</h3>
</div>


<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'i-learning-sch-part-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'applicant_name', ['hint' => 'Select from your current employee', 'class' => 'col-md-4']); ?>
<?php echo $form->hiddenField($model, 'applicant_id'); ?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'company_id', ["class" => "control-label col-sm-3 "]); ?>
    <div class="col-sm-9">
        <?php
        echo $form->dropDownList($model, 'company_id', aOrganization::model()->companyDropDown(), [
                'empty' => 'Select Company:',
                'class' => 'form-control',
                'ajax' => [
                    'type' => 'POST',
                    'url' => CController::createUrl('/m1/jSelection/deptUpdate'),
                    'update' => '#' . CHtml::activeId($model, 'department_id'),
                ]
            ]
        );
        ?>
    </div>
</div>

<?php echo $form->dropDownListGroup($model, 'department_id', []); ?>

<?php echo $form->dropDownListGroup($model, 'level_id', ['widgetOptions' => [
    'data' => gParamLevel::model()->levelDropDown()
]]); ?>

<?php echo $form->textFieldGroup($model, 'for_position'); ?>

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
