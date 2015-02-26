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
			.append('<a style=\'height:52px;\'><img style=\'float:left;margin-right:5px;width:40px; \'src=\'" . Yii::app()->baseUrl . "/shareimages/hr/employee/thumb/" . "'+item.photo+'\'/><h5>'+item.label+'</h5></a>')
			.appendTo( ul );
		};
			
		});

		");
?>

<div class="row">
    <div class="col-md-12">

        <?php
        $form = $this->beginWidget('booster.widgets.TbActiveForm', [
            'id' => 'g-karir-form',
            'enableAjaxValidation' => false,
            'type' => 'horizontal',
        ]);
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldGroup($model, 'start_date', []); ?>

        <?php echo $form->dropDownListGroup($model, 'status_id', ['widgetOptions' => [
            'data' => sParameter::items('cPromotion', 0, [7, 8])
        ]]); ?>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'company_id', ["class" => "col-sm-3 control-label"]); ?>
            <div class="col-sm-9">
                <?php
                echo $form->dropDownList($model, 'company_id', aOrganization::model()->companyDropDown(), [
                    'empty' => 'Select Company:',
                    'ajax' => [
                        'type' => 'POST',
                        'url' => CController::createUrl('/m1/gPerson/deptUpdate'),
                        'update' => '#' . CHtml::activeId($model, 'department_id'),
                    ],
                    'class' => 'form-control'
                ]);?>
            </div>
        </div>

        <?php echo $form->dropDownListGroup($model, 'department_id', ['widgetOptions' => [
            'data' => (!$model->isNewRecord) ? $model->deptUpdate() : []
        ]]); ?>

        <?php echo $form->dropDownListGroup($model, 'section_id', ['widgetOptions' => [
            'data' => ['0'=>'Default']
        ]]); ?>

        <?php echo $form->dropDownListGroup($model, 'level_id', ['widgetOptions' => [
            'data' => gParamLevel::model()->levelDropDown()
        ]]); ?>

        <?php echo $form->textFieldGroup($model, 'job_title'); ?>

        <?php echo $form->textFieldGroup($model, 'superior_name'); ?>
        <?php echo $form->hiddenField($model, 'superior_id'); ?>

        <?php echo $form->textFieldGroup($model, 'custom1_date', []); ?>

        <?php echo $form->textAreaGroup($model, 'reason', ['widgetOptions' => ['htmlOptions' => ['rows' => 3]]]); ?>

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

                <?php /*
              <?php echo CHtml::ajaxSubmitButton('Save',CHtml::normalizeUrl(array('/m1/gPerson/updateCareerAjax','id'=>$model->id)),
              array(
              'dataType'=>'json',
              'type'=>'post',
              'success'=>'function(data) {
              $.fn.yiiGridView.update("g-karir-grid");
              }',
              ),
              array('id'=>'mybtn','class'=>'btn btn-primary'));
              ?>
             */
                ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>

    </div>
</div>
