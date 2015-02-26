<?php
/* @var $this HVacancyController */
/* @var $model hVacancy */
/* @var $form CActiveForm */

//$cs = Yii::app()->clientScript;
//$cs->registerScriptFile(Yii::app()->baseUrl . '/css/formatCurrency/jquery.formatCurrency-1.4.0.min.js');

Yii::app()->clientScript->registerScript('optional', "
	$('.optional-button').click(function(){
		$('.optional-form').toggle('slow');
		return false;
	});
	
	//$( \"#" . CHtml::activeId($model, 'min_salary') . "\" ).formatCurrency();
	
	
");
?>


<?php $this->widget('ext.tooltipster.tooltipster'); ?>

<div class="row">
    <div class="col-md-12">

        <?php
        $form = $this->beginWidget('TbActiveForm', [
            'id' => 'h-vacancy-form',
            'enableAjaxValidation' => false,
        ]);
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldGroup($model, 'vacancy_title'); ?>

        <?php
        echo $form->redactorGroup($model, 'vacancy_desc', [
            'htmlOptions' => ['rows' => 5]]);
        ?>

        <?php
        echo $form->redactorGroup($model, 'skill_required', [
            'htmlOptions' => ['rows' => 5]]);
        ?>


        <?php //echo $form->textFieldGroup($model,'industry_tag',array('class'=>'span4 tooltipster','title'=>'Please use coma to separate between tag'));   ?>
        <?php echo $form->dropDownListGroup($model, 'industry_tag', ['widgetOptions' => [
            'data' => sParameter::itemsWithName("cRecruitmentSpec")
        ]]); ?>

        <?php //echo $form->textFieldGroup($model,'for_level',array('class'=>'col-md-4')); ?>
        <?php
        echo $form->dropDownListGroup($model, 'for_level', ['widgetOptions' => [
            'data' => [
                'Pelaksana' => 'Pelaksana',
                'Officer/Senior Officer' => 'Officer/Senior Officer',
                'Supervisor' => 'Supervisor',
                'Asst. Manager/Manager' => 'Asst. Manager/Manager',
                'General Manager' => 'General Manager',
                'Director' => 'Director',
            ]
        ]]);
        ?>

        <?php echo $form->textFieldGroup($model, 'city'); ?>

    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <?php //echo $form->dropDownListGroup($model,'min_education_level',sParameter::items('EDU'));    ?>
        <?php echo $form->dropDownListGroup($model, 'min_education_level', ['widgetOptions' => [
            'data' => [3 => 'SMA', 6 => 'D3', 8 => 'S1', 9 => 'S2', 10 => 'S3']
        ]]); ?>
    </div>
    <div class="col-md-3">
        <?php echo $form->textFieldGroup($model, 'min_gpa', ['class' => 'col-md-1']); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <?php echo $form->textFieldGroup($model, 'min_working_exp', ['class' => 'col-md-1', 'append' => 'Year']); ?>
    </div>
</div>

<?php echo CHtml::link('Show Optional Form', '#', ['class' => 'optional-button']); ?>
<div class="optional-form" style="display:none">
    <div class="row">
        <div class="col-md-6">
            <?php //echo $form->textFieldGroup($model,'specification_tag',array('class'=>'span4 tooltipster','title'=>'Please use coma to separate between tag'));   ?>
            <?php echo $form->textAreaGroup($model, 'work_address', ['class' => 'col-md-6', 'rows' => 4]); ?>
            <?php //echo $form->textAreaGroup($model,'promotion_content',array('rows'=>15, 'class'=>'col-md-6'));  ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?php echo $form->textFieldGroup($model, 'min_salary', ['class' => 'col-md-2']); ?>
        </div>
        <div class="col-md-3">
            <?php echo $form->textFieldGroup($model, 'max_salary', ['class' => 'col-md-2']); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php echo $form->checkboxGroup($model, 'salary_hide'); ?>
        </div>
    </div>
</div>


<?php //echo $this->renderPartial('_formSch',array('model'=>$modelSch));   ?>
<div class="row">
    <div class="col-md-12">

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
</div><!-- form -->