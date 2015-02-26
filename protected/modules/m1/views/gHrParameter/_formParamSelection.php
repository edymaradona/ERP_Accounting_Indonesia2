<div class="row">

    <?php
    $form = $this->beginWidget('TbActiveForm', [
        'id' => 'g-param-selection-form',
        'enableAjaxValidation' => false,
        'type' => 'horizontal',
    ]);
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->dropDownListGroup($model, 'parent_id', ['widgetOptions' => [
        'data' => gParamSelection::levelDropDownParent()
    ]]); ?>
    <?php echo $form->textFieldGroup($model, 'sort'); ?>
    <?php echo $form->textFieldGroup($model, 'name', ['size' => 60, 'maxlength' => 100]); ?>

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

</div><!-- form -->