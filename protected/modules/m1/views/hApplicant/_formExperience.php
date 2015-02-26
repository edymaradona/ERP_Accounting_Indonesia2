<div class="row">
    <div class="col-md-12">


        <?php
        $form = $this->beginWidget('TbActiveForm', [
            'id' => 'g-person-experience-form',
            'enableAjaxValidation' => false,
            'type' => 'horizontal',
        ]);
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldGroup($model, 'company_name'); ?>

        <?php echo $form->textFieldGroup($model, 'industries'); ?>

        <?php echo $form->textFieldGroup($model, 'start_date'); ?>

        <?php echo $form->textFieldGroup($model, 'end_date'); ?>

        <?php echo $form->textFieldGroup($model, 'year_length'); ?>

        <?php echo $form->textFieldGroup($model, 'month_length'); ?>

        <?php echo $form->textFieldGroup($model, 'job_title'); ?>

        <?php echo $form->textAreaGroup($model, 'job_description', ['widgetOptions' => ['htmlOptions' => ['rows' => 10]]]); ?>

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
<!-- form -->
