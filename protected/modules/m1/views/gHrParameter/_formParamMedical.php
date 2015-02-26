<div class="row">

    <?php
    $form = $this->beginWidget('TbActiveForm', [
        'id' => 'g-param-medical-form',
        'enableAjaxValidation' => false,
        'type' => 'horizontal',
    ]);
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->dropDownListGroup($model, 'parent_id', ['widgetOptions' => [
        'data' => gParamMedical::medicalDropDownParent()
    ]]); ?>
    <?php echo $form->textFieldGroup($model, 'sort'); ?>
    <?php echo $form->textFieldGroup($model, 'yearmonth_start'); ?>
    <?php echo $form->dropDownListGroup($model, 'level_id', ['widgetOptions' => [
        'data' => gParamLevel::levelDropDownParent('.:ALL LEVEL:.')
    ]]); ?>
    <?php echo $form->dropDownListGroup($model, 'medical_company_id', ['widgetOptions' => [
        'data' => ['1' => 'Internal', 'Insurance Company']
    ]]); ?>
    <?php echo $form->textFieldGroup($model, 'name'); ?>
    <?php echo $form->numberFieldGroup($model, 'amount', ['widgetOptions' => ['htmlOptions' => ['min' => 0]]]); ?>
    <?php echo $form->textAreaGroup($model, 'formula', ['widgetOptions' => ['htmlOptions' => ['rows' => 4]]]); ?>


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