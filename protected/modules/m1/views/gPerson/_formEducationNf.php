<div class="row">
    <div class="col-md-12">

        <?php
        $form = $this->beginWidget('TbActiveForm', [
            'id' => 'gperson-education-nf-form',
            'enableAjaxValidation' => false,
            'type' => 'horizontal',
        ]);
        ?>


        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldGroup($model, 'education_name'); ?>

        <?php echo $form->textFieldGroup($model, 'category', []); ?>

        <?php echo $form->textFieldGroup($model, 'start', []); ?>

        <?php echo $form->textFieldGroup($model, 'end', []); ?>

        <?php echo $form->dropDownListGroup($model, 'sertificate', ['widgetOptions' => [
            'data' => ['-1' => 'Yes', '0' => 'No']
        ]]); ?>

        <?php echo $form->textFieldGroup($model, 'country', []); ?>

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
    <!-- form -->
</div><!-- form -->