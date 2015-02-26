<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker', "
$(function() {
		$( \"#" . CHtml::activeId($model, 'cdate') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		
		
});

		");
?>

<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'g-Attendance-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
]);
?>


<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'cdate', ['widgetOptions' => ['htmlOptions' => ['disabled' => true]]]); ?>
<?php echo $form->dropDownListGroup($model, 'realpattern_id', ['widgetOptions' => [
    'data' => gParamTimeblock::timeBlockDropDown(), 'htmlOptions' => ['disabled' => 'disabled']
]]); ?>

<?php echo $form->dropDownListGroup($model, 'changepattern_id', ['widgetOptions' => [
    'data' => gParamTimeblock::timeBlockDropDown()
]]); ?>

<?php //echo $form->textFieldGroup($model,'overtime_factor',array('size'=>3,'maxlength'=>3)); ?>
<?php echo $form->textAreaGroup($model, 'remark', ['widgetOptions' => ['htmlOptions' => ['rows' => 3]]]); ?>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?php
            $this->widget('booster.widgets.TbButton', [
                'buttonType' => 'submit',
                'context' => 'primary',
                'icon' => 'fa fa-check',
                'label' => $model->isNewRecord ? 'Create' : 'Save',
                'visible' => ($model->approved_id == 0 || $model->approved_id == 2)
            ]);
            ?>

            <?php
            $this->widget('booster.widgets.TbButton', [
                'context' => 'primary',
                'buttonType' => 'link',
                'url' => Yii::app()->createUrl('/m1/gEss/attendance'),
                'label' => 'Close',
                'icon' => 'fa fa-check',
                'visible' => ($model->approved_id == 1)
            ]);
            ?>


            <?php
            $this->widget('booster.widgets.TbButton', [
                'context' => 'primary',
                'buttonType' => 'link',
                'url' => Yii::app()->createUrl('/m1/gEss/changeAttendancePrint', ['id' => $model->id]),
                'label' => 'Print',
                'icon' => 'fa fa-check',
                'visible' => ($model->approved_id == 1),
                'htmlOptions' => [
                    'target' => '_blank'
                ]
            ]);
            ?>


        </div>
    </div>

<?php
$this->endWidget();


