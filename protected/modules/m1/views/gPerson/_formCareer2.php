<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker12', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'start_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		});
		$( \"#" . CHtml::activeId($model, 'end_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		});
			
});

		");
?>

<div class="row">
    <div class="col-md-12">

        <?php
        $form = $this->beginWidget('booster.widgets.TbActiveForm', [
            'id' => 'g-karir2-form',
            'enableAjaxValidation' => false,
            'type' => 'horizontal',
        ]);
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldGroup($model, 'start_date', []); ?>

        <?php echo $form->textFieldGroup($model, 'end_date', []); ?>

        <?php echo $form->dropDownListGroup($model, 'status_id', ['widgetOptions' => [
                'data' => ['8' => 'Assignment']]]
        ); ?>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'company_id', ["class" => "col-sm-3 control-label"]); ?>
            <div class="col-sm-9">
                <?php
                echo $form->dropDownList($model, 'company_id', aOrganization::model()->companyDropDown(), [
                    'empty' => 'Select Company:',
                    'ajax' => [
                        'type' => 'POST',
                        'url' => CController::createUrl('/m1/gPerson/deptUpdate2'),
                        'update' => '#' . CHtml::activeId($model, 'department_id'),
                    ],
                    'class' => 'form-control'
                ]);
                ?>
            </div>
        </div>

        <?php echo $form->dropDownListGroup($model, 'department_id', []); ?>

        <?php echo $form->dropDownListGroup($model, 'level_id', ['widgetOptions' => [
            'data' => gParamLevel::model()->levelDropDown()
        ]]); ?>

        <?php echo $form->textFieldGroup($model, 'job_title'); ?>

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
            </div>
        </div>
        <?php $this->endWidget(); ?>

    </div>
</div>
