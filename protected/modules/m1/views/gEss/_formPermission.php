<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker', "
$(function() {
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).mask('99-99-9999');
		//$( \"#" . CHtml::activeId($model, 'start_date') . "\" ).mask('99-99-9999 99:99');
		$( \"#" . CHtml::activeId($model, 'end_date') . "\" ).mask('99-99-9999 99:99');
		$( \"#" . CHtml::activeId($model, 'number_of_day') . "\" ).mask('9?9');
		
		
});

		");
?>

<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'g-cuti-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'input_date', ['widgetOptions' => [
    'htmlOptions' => ['disabled' => true, 'value' => date("d-m-Y")]
]]); ?>

<?php echo $form->dropDownListGroup($model, 'permission_type_id', ['widgetOptions' => [
    'data' => gParamPermission::model()->permissionDropDown()
]]); ?>

<?php echo $form->textAreaGroup($model, 'permission_reason', ['widgetOptions' => ['htmlOptions' => ['rows' => 4]]]); ?>


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

<?php echo $form->numberFieldGroup($model, 'number_of_day', ['hint' => 'Total days of permission', 'widgetOptions' => ['htmlOptions' => ['min' => 0]]]); ?>



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
