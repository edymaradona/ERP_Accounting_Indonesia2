<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'g-expense-detail-form',
    //'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>


<?php echo $form->dropDownListGroup($model, 'expense_id', ['widgetOptions' => [
    'data' => gParamExpenseDetail::model()->expenseDropDown()
]]); ?>

<?php echo $form->textFieldGroup($model, 'company_name', ['hint' => 'Hint: Garuda, Lion Air, Kereta Api Express, Blue Bird, etc...']); ?>

<?php echo $form->numberFieldGroup($model, 'amount'); ?>

<?php echo $form->dropDownListGroup($model, 'payment_source_id', ['widgetOptions' => [
    'data' => sParameter::items('cExpensePaymentSource')
]]); ?>

<?php echo $form->textAreaGroup($model, 'remark'); ?>

<div class="form-group">
        <?php
        $this->widget('booster.widgets.TbButton', [
            'buttonType' => 'submit',
            'context' => 'primary',
            'icon' => 'fa fa-check',
            'label' => $model->isNewRecord ? 'Create' : 'Save',
        ]);
        ?>
</div>
<?php
$this->endWidget();
?>

