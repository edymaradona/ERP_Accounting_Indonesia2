<div class="row">
    <div class="col-md-12">

        <?php
        $form = $this->beginWidget('booster.widgets.TbActiveForm', [
            'id' => 'g-education-form',
            'enableAjaxValidation' => false,
            //'type'=>'horizontal',
        ]);
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->dropDownListGroup($model, 'level_id', ['widgetOptions' => [
            'data' => sParameter::items('edu')
        ]]); ?>

        <?php echo $form->textFieldGroup($model, 'school_name'); ?>

        <?php echo $form->textFieldGroup($model, 'interest'); ?>

        <?php echo $form->textFieldGroup($model, 'city'); ?>

        <?php echo $form->textFieldGroup($model, 'graduate'); ?>

        <?php echo $form->textFieldGroup($model, 'ipk'); ?>

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
