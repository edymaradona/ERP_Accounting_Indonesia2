<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker3', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'birth_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
			
});

		");
?>

<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'g-person-family-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
]);
?>

    <div class="row">
        <div class="col-md-12">
            <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldGroup($model, 'f_name'); ?>

            <?php echo $form->dropDownListGroup($model, 'relation_id', ['widgetOptions' => [
                'data' => sParameter::items('HK')
            ]]); ?>

            <?php echo $form->textFieldGroup($model, 'birth_place', []); ?>

            <?php echo $form->textFieldGroup($model, 'birth_date'); ?>

            <?php echo $form->dropDownListGroup($model, 'sex_id', ['widgetOptions' => [
                'data' => sParameter::items('cGender')
            ]]); ?>

            <?php echo $form->textAreaGroup($model, 'remark', ['widgetOptions' => ['htmlOptions' => ['rows' => 3]]]); ?>

            <?php //echo $form->dropDownListGroup($model,'payroll_cover_id',sParameter::items('cCover'));  ?>
        </div>
    </div>
    <!-- form -->

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

