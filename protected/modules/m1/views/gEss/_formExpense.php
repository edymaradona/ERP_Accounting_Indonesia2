<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
Yii::app()->getClientScript()->registerCoreScript('maskedinput');

Yii::app()->clientScript->registerScript('datepicker', "
$(function() {
        $( \"#" . CHtml::activeId($model, 'start_date') . "\" ).datepicker({
        'dateFormat' : 'dd-mm-yy',
    });

    $( \"#" . CHtml::activeId($model, 'process_date') . "\" ).datepicker({
    'dateFormat' : 'dd-mm-yy',
    });

    $( \"#" . CHtml::activeId($model, 'end_date') . "\" ).datepicker({
    'dateFormat' : 'dd-mm-yy',
    });

        
});

        ");
?>

<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'g-expense-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'input_date', ['widgetOptions' => [
    'htmlOptions' => ['disabled' => true, 'value' => date("d-m-Y")]
]]); ?>

<?php echo $form->dropDownListGroup($model, 'expense_type_id', ['widgetOptions' => [
    'data' => gParamExpense::model()->expenseDropDown()
]]); ?>

<?php echo $form->textFieldGroup($model, 'destination'); ?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'start_date', ['class' => 'col-sm-3 control-label']); ?>
    <div class="col-sm-9">
        <?php
        $this->widget(
            'ext.EJuiDateTimePicker.EJuiDateTimePicker', [
                'model' => $model,
                'attribute' => 'start_date',
                'options' => [
                    'dateFormat' => 'dd-mm-yy',
                    'timeFormat' => 'hh:mm', //'hh:mm tt' default
                ],
                'htmlOptions' => [
                    'class' => 'form-control'
                ]
            ]
        );
        ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'end_date', ['class' => 'col-sm-3 control-label']); ?>
    <div class="col-sm-9">
        <?php
        $this->widget(
            'ext.EJuiDateTimePicker.EJuiDateTimePicker', [
                'model' => $model,
                'attribute' => 'end_date',
                'options' => [
                    'dateFormat' => 'dd-mm-yy',
                    'timeFormat' => 'hh:mm', //'hh:mm tt' default
                ],
                'htmlOptions' => [
                    'class' => 'form-control'
                ]
            ]
        );
        ?>
    </div>
</div>

<?php echo $form->textFieldGroup($model, 'number_of_day', ['hint' => 'Total days of travel/return to homebase. It could be 2.0 days, 2.5 days, 3.0 days, and so on', 'widgetOptions' => ['htmlOptions' => ['min' => 1]]]); ?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'transportation_type', ['class' => 'col-sm-3 control-label']); ?>
    <div class="col-sm-9">

        <?php
        $this->widget(
            'booster.widgets.TbSelect2',
            [
                //'asDropDownList' => false,
                'model' => $model,
                'attribute' => 'transportation_type',
                'data' => gParamExpenseDetail::model()->expenseDropDownInitial(),
                'htmlOptions' => [
                    'multiple' => 'multiple',
                ],
                'options' => [
                    'placeholder' => 'You can select more than one or you can complete this later...',
                    'width' => '100%',
                    'tokenSeparators' => [',', ' '],
                    'onclick' => 'js:$.ajax({
                      url: "/",
                      type: "POST",
                      data: (function () {
                        var select = $("#gExpense_transportation_type");
                        var result = {};
                        result[select.attr("name")] = select.val();
                        return result;
                      })() 
                  })'
                ]
            ]
        );
        ?>
    </div>
</div>


<?php echo $form->textAreaGroup($model, 'purpose', ['widgetOptions' => ['htmlOptions' => ['rows' => 4]]]); ?>

<?php echo $form->numberFieldGroup($model, 'advanced_amount', ['widgetOptions' => ['htmlOptions' => ['min' => 0]]]); ?>

<?php echo $form->textAreaGroup($model, 'remark', ['widgetOptions' => ['htmlOptions' => ['rows' => 4]]]); ?>

<?php echo $form->dropDownListGroup($model, 'cost_center_id', ['widgetOptions' => [
    'data' => aOrganization::model()->companyDropDownForExpense()
]]); ?>


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
?>

