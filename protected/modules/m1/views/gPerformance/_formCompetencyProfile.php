<div class="row">
    <div class="col-md-12">

        <div class="page-header">
            <h3>New Competency Profile (<?php echo $year ?>)</h3>
        </div>


        <?php
        $form = $this->beginWidget('booster.widgets.TbActiveForm', [
            'id' => 'g-target-setting-form',
            'enableAjaxValidation' => false,
        ]);
        ?>


        <?php //echo $form->dropDownListGroup($model,'year',gTalentPerformance::getTalentPeriod());  ?>


        <?php
        //echo $form->dropDownListGroup($model,'company_id',[],
        //array('class'=>'col-md-5','maxlength'=>50));
        ?>


        <?php echo $form->dropDownListGroup($model, 'potential_template_id', ['widgetOptions' => [
            'data' => gParamCompetency::competencyProfileDropDown()
        ]]);
        ?>

        <?php echo $form->textFieldGroup($model, 'competency_level'); ?>

        <?php echo $form->textAreaGroup($model, 'remark', ['widgetOptions' => ['htmlOptions' => ['rows' => 5]]]); ?>


        <div class="form-group">
            <div class="col-sm-3">
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
