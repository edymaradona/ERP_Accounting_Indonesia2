<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker', "
$(function() {
		$( \"#" . CHtml::activeId($model, 'cdate') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		
		
});

		");
?>

<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'g-Attendance-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
]);
?>


<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'cdate'); ?>
<?php echo $form->dropDownListGroup($model, 'realpattern_id', ['widgetOptions' => [
    'data' => gParamTimeblock::timeBlockDropDown()
]]); ?>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'in', ['class' => 'col-sm-3 control-label']); ?>
        <div class="col-sm-9">
            <?php
            $this->widget(
                'ext.EJuiDateTimePicker.EJuiDateTimePicker', [
                    'model' => $model,
                    'attribute' => 'in',
                    'options' => [
                        'dateFormat' => 'dd-mm-yy',
                        'timeFormat' => 'hh:mm', //'hh:mm tt' default
                        'defaultValue' => (isset($model->cdate)) ? date('d-m-Y', strtotime($model->cdate)) : date('d-m-Y h:i'),
                        'minDate' => ($model->cdate != null) ? date('d-m-Y', strtotime($model->cdate)) : date('d-m-Y', strtotime('01-' . date("m-Y"))),
                        'maxDate' => ($model->cdate != null) ? date('d-m-Y', strtotime($model->cdate . "1 day")) :
                                date('d-m-Y', strtotime('01-' . date("m-Y", strtotime(date("d-m-Y") . "1 month")) . "-1 day")),
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
        <?php echo $form->labelEx($model, 'out', ['class' => 'col-sm-3 control-label']); ?>
        <div class="col-sm-9">
            <?php
            $this->widget(
                'ext.EJuiDateTimePicker.EJuiDateTimePicker', [
                    'model' => $model,
                    'attribute' => 'out',
                    'options' => [
                        'dateFormat' => 'dd-mm-yy',
                        'timeFormat' => 'hh:mm', //'hh:mm tt' default
                        'defaultValue' => (isset($model->cdate)) ? date('d-m-Y', strtotime($model->cdate)) : date('d-m-Y h:i'),
                        'minDate' => ($model->cdate != null) ? date('d-m-Y', strtotime($model->cdate)) : date('d-m-Y', strtotime('01-' . date("m-Y"))),
                        'maxDate' => ($model->cdate != null) ? date('d-m-Y', strtotime($model->cdate . "1 day")) :
                                date('d-m-Y', strtotime('01-' . date("m-Y", strtotime(date("d-m-Y") . "1 month")) . "-1 day")),
                    ],
                    'htmlOptions' => [
                        'class' => 'form-control'
                    ]
                ]
            );
            ?>
        </div>
    </div>


<?php echo $form->textAreaGroup($model, 'remark', ['rows' => 3, 'class' => 'col-md-4']); ?>
<?php echo $form->textAreaGroup($model, 'notes', ['rows' => 3, 'class' => 'col-md-4']); ?>

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


