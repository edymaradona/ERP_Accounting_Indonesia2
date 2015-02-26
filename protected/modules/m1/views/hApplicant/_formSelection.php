<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker1', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'assessment_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		});
			
});

		");
?>

<?php
/* @var $this GSelectionProgressController */
/* @var $model gSelectionProgress */
/* @var $form CActiveForm */
?>


<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'g-recruitment-invitation-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal'
]);
?>


<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListGroup($model, 'workflow_id', ['widgetOptions' => [
    'data' => gParamSelection::levelDropdown()
]]); ?>

<?php echo $form->dropDownListGroup($model, 'vacancy_id', ['widgetOptions' => [
    'data' => hVacancyApplicant::listVacancy($modelApplicant->id)
]]); ?>

<?php echo $form->textFieldGroup($model, 'assessment_date'); ?>
<?php echo $form->textFieldGroup($model, 'workflow_by'); ?>
<?php echo $form->textAreaGroup($model, 'assessment_summary', ['widgetOptions' => ['htmlOptions' => ['rows' => 4]]]); ?>
<?php echo $form->textAreaGroup($model, 'development_area', ['widgetOptions' => ['htmlOptions' => ['rows' => 4]]]); ?>

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


