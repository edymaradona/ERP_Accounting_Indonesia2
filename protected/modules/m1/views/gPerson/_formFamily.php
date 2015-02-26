<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker3', "
		$(function() {
			$( \"#" . CHtml::activeId($model, 'birth_date') . "\" ).datepicker({
				'dateFormat' : 'dd-mm-yy',
			});
			$( \"#" . CHtml::activeId($model, 'relation_id') . "\" ).change(function() {
				if ($(this).val() == '1') {
					$( \"#" . CHtml::activeId($model, 'sex_id') . "\" ).html('<option value=\"1\">Male</option><option selected=\"selected\" value=\"2\">Female</option>');
					$( \"#" . CHtml::activeId($model, 'payroll_cover_id') . "\" ).html('<option selected=\"selected\" value=\"1\">Covered</option><option value=\"2\">Not Covered</option><option value=\"3\">Other</option>');
				} else if ($(this).val() == '2') {
					$( \"#" . CHtml::activeId($model, 'sex_id') . "\" ).html('<option selected=\"selected\" value=\"1\">Male</option><option value=\"2\">Female</option>');
					$( \"#" . CHtml::activeId($model, 'payroll_cover_id') . "\" ).html('<option value=\"1\">Covered</option><option selected=\"selected\" value=\"2\">Not Covered</option><option value=\"3\">Other</option>');
				} else if ($(this).val() == '3') {
					$( \"#" . CHtml::activeId($model, 'payroll_cover_id') . "\" ).html('<option selected=\"selected\" value=\"1\">Covered</option><option value=\"2\">Not Covered</option><option value=\"3\">Other</option>');
				} else if ($(this).val() == '4') {
					$( \"#" . CHtml::activeId($model, 'payroll_cover_id') . "\" ).html('<option value=\"1\">Covered</option><option selected=\"selected\" value=\"2\">Not Covered</option><option value=\"3\">Other</option>');
				} else if ($(this).val() == '5') {
					$( \"#" . CHtml::activeId($model, 'payroll_cover_id') . "\" ).html('<option value=\"1\">Covered</option><option selected=\"selected\" value=\"2\">Not Covered</option><option value=\"3\">Other</option>');
				} else if ($(this).val() == '6') {
					$( \"#" . CHtml::activeId($model, 'payroll_cover_id') . "\" ).html('<option value=\"1\">Covered</option><option selected=\"selected\" value=\"2\">Not Covered</option><option value=\"3\">Other</option>');
				} else {
					$( \"#" . CHtml::activeId($model, 'sex_id') . "\" ).html('<option selected=\"selected\" value=\"1\">Male</option><option value=\"2\">Female</option>');
				}
			});

			
		});


");
?>

<div class="row">
    <div class="col-md-12">

        <?php
        $form = $this->beginWidget('TbActiveForm', [
            'id' => 'g-person-family-form',
            'enableAjaxValidation' => false,
            'type' => 'horizontal',
        ]);
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldGroup($model, 'f_name'); ?>

        <?php echo $form->dropDownListGroup($model, 'relation_id', ['widgetOptions' => [
            'data' => sParameter::items('HK')
        ]]); ?>

        <?php echo $form->textFieldGroup($model, 'birth_place'); ?>

        <?php echo $form->textFieldGroup($model, 'birth_date'); ?>

        <?php echo $form->dropDownListGroup($model, 'sex_id', ['widgetOptions' => [
            'data' => sParameter::items('cGender')
        ]]); ?>

        <?php echo $form->textAreaGroup($model, 'remark', ['widgetOptions' => ['htmlOptions' => ['rows' => 3]]]); ?>

        <?php echo $form->dropDownListGroup($model, 'payroll_cover_id', ['widgetOptions' => [
            'data' => sParameter::items('cCover')
        ]]); ?>

        <?php echo $form->textFieldGroup($model, 'insurance_number'); ?>

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
        <?php $this->endWidget(); ?>
    </div>
</div>

