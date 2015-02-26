<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'g-medical-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>


<?php echo $form->textFieldGroup($model, 'receipt_date'); ?>

<?php echo $form->dropDownListGroup($model, 'medical_type_id', ['widgetOptions' => [
    'data' => gParamMedical::medicalDropDownAll()
]]); ?>

<?php echo $form->textAreaGroup($model, 'sympthom', ['widgetOptions' => ['htmlOptions' => ['rows' => 4]]]); ?>

<?php echo $form->numberFieldGroup($model, 'original_amount', ['hint' => 'Total original amount', 'widgetOptions' => ['htmlOptions' => ['min' => 1]]]); ?>

<?php //echo $form->numberFieldGroup($model, 'approved_amount', ['class' => 'col-md-2', 'min' => 1], array('hint' => 'Total approved amount')); ?>

<?php echo $form->textAreaGroup($model, 'remark', ['widgetOptions' => ['htmlOptions' => ['rows' => 4]]]); ?>



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
<?php
$this->endWidget();

