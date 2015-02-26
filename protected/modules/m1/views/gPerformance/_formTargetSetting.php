<?php
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . "/css/bootstrap-maxlength/bootstrap-maxlength.js");

Yii::app()->clientScript->registerScript('sel2', "
		$(function() {
		$( \"textarea#" . CHtml::activeId($model, 'kpi_desc') . "\" ).maxlength({
			alwaysShow: true
		});

		});


");
?>

<div class="row">
    <div class="col-md-12">

        <div class="page-header">
            <h3>New Target Setting (<?php echo $year ?>)</h3>
        </div>


        <?php
        $form = $this->beginWidget('booster.widgets.TbActiveForm', [
            'id' => 'g-target-setting-form',
            'enableAjaxValidation' => false,
            'type' => 'horizontal',
        ]);
        ?>


        <?php
        //echo $form->dropDownListGroup($model,'company_id',[],
        //array('class'=>'col-md-5','maxlength'=>50));
        ?>


        <?php echo $form->dropDownListGroup($model, 'strategic_objective', ['widgetOptions' => [
            'data' => sParameter::items('cStrategicObjective')
        ]]);?>


        <?php echo $form->dropDownListGroup($model, 'period', ['widgetOptions' => [
            'data' => ['0' => 'Full Year', '1' => 'Semester I Only', '2' => 'Semester II Only']
        ]]); ?>


        <?php echo $form->textAreaGroup($model, 'strategic_desc', ['widgetOptions' => ['htmlOptions' => ['rows' => 5]]]); ?>


        <?php echo $form->textAreaGroup($model, 'kpi_desc', ['widgetOptions' => ['htmlOptions' => ['maxlength' => 1000, 'rows' => 5]]]); ?>


        <?php echo $form->textFieldGroup($model, 'weight'); ?>


        <?php echo $form->textFieldGroup($model, 'target'); ?>


        <?php echo $form->textFieldGroup($model, 'unit'); ?>


        <?php echo $form->textAreaGroup($model, 'remark', ['widgetOptions' => ['htmlOptions' => ['rows' => 5]]]); ?>


        <?php echo $form->textAreaGroup($model, 'strategic_initiative', ['class' => 'col-md-5', 'rows' => 5]); ?>

        <?php /*
        <?php echo $form->dropDownListGroup($model, 'validate_id', ['widgetOptions' => [
            'data' => sParameter::items('cTargetSettingValidate')
        ]]);?>
        */
        ?>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
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
