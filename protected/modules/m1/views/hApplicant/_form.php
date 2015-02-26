<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker4', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'birth_date') . "\" ).datepicker({
			'dateFormat' : 'dd-mm-yy',
			'changeMonth' : true,
			'changeYear' : true,
			'yearRange' : '" . date("Y", strtotime("-65 year")) . ":" . date("Y", strtotime("-15 year")) . "',
		});
		$( \"#" . CHtml::activeId($model, 'identity_valid') . "\" ).datepicker({
			'dateFormat' : 'dd-mm-yy',
		});
			
});

		");
?>

<?php $this->widget('ext.tooltipster.tooltipster'); ?>

<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'g-person-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
]);
?>

<?php echo $form->errorSummary($model); ?>

<div class="row">
    <div class="col-md-12">

        <?php //echo $form->textFieldGroup($model,'applicant_code',[]); ?>

        <?php echo $form->textFieldGroup($model, 'applicant_name'); ?>

        <?php echo $form->emailFieldGroup($model, 'email'); ?>

        <?php echo $form->textFieldGroup($model, 'birth_place'); ?>

        <?php echo $form->textFieldGroup($model, 'birth_date'); ?>

        <?php echo $form->textFieldGroup($model, 'handphone'); ?>

        <?php echo $form->dropDownListGroup($model, 'religion_id', ['widgetOptions' => [
            'data' => sParameter::items("cAgama")
        ]]); ?>

        <?php echo $form->dropDownListGroup($model, 'sex_id', ['widgetOptions' => [
            'data' => sParameter::items("cGender")
        ]]); ?>

        <?php echo $form->textFieldGroup($model, 'identity_number', ['hint' => 'KTP/SIM/Passport Number']); ?>

        <?php //echo $form->textFieldGroup($model,'identity_valid',array('class'=>'tooltipster', 'title'=>'select from box or type-in directly using this format DD-MM-YYYY')); ?>

        <?php //echo $form->textFieldGroup($model,'home_phone',[]); ?>

        <?php echo $form->textAreaGroup($model, 'address1', ['class' => 'col-md-5', 'rows' => 3]); ?>

        <?php echo $form->checkboxGroup($model, 'freshgrad_id', ['hint' => 'Check it, if you Fresh Graduation or less than 1 Year experience']); ?>

        <?php echo $form->textFieldGroup($model, 'expected_sallary', ['class' => 'tooltipster', 'title' => 'expected salary (in Rupiah)']); ?>

        <?php echo $form->textFieldGroup($model, 'expected_position', ['class' => 'col-md-5']); ?>

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
    </div>
</div>

<?php $this->endWidget(); ?>

