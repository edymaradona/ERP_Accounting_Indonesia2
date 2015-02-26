<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker44', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'schedule_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
			
});

		");
?>

<?php
/* @var $this ILearningSchController */
/* @var $model iLearningSch */
/* @var $form CActiveForm */
?>


<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'i-learning-sch-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'schedule_date', ['hint' => '*bugs: for temporary, format date will use English format mm/dd/yyyy']); ?>
<?php echo $form->textFieldGroup($model, 'trainer_name'); ?>
<?php echo $form->textFieldGroup($model, 'location'); ?>
<?php echo $form->textAreaGroup($model, 'additional_info', ['widgetOptions' => ['htmlOptions' => ['rows' => 5]]]); ?>
<?php echo $form->dropDownListGroup($model, 'status_id', ['widgetOptions' => [
    'data' => sParameter::items("cTrainingStatus")
]]);
?>
<?php echo $form->textFieldGroup($model, 'cost'); ?>
<?php echo $form->dropDownListGroup($model, 'certificate_template_id', ['widgetOptions' => [
    'data' => ['0' => 'Non Certificate', '1' => 'Template 1', '2' => 'Template 2', '3' => 'Template 3']
]]);
?>
<?php echo (!$model->isNewRecord) ? $form->textFieldGroup($model, 'actual_mandays') : ""; ?>
<?php echo ($model->isNewRecord) ? $form->textFieldGroup($model, 'total_participant') : ""; ?>


    <div class="form-group">
        <?php
        $this->widget('booster.widgets.TbButton', [
            'buttonType' => 'submit',
            //'type' => 'primary',
            'icon' => 'fa fa-check',
            'label' => $model->isNewRecord ? 'Create' : 'Save',
        ]);
        ?>

    </div>

<?php
$this->endWidget();

